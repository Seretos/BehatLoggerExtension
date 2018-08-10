<?php

/**
 * Created by PhpStorm.
 * User: aappen
 * Date: 08.08.18
 * Time: 16:01
 */
namespace seretos\BehatLoggerExtension\Formatter;

use Behat\Behat\EventDispatcher\Event\AfterOutlineTested;
use Behat\Behat\EventDispatcher\Event\AfterScenarioTested;
use Behat\Behat\EventDispatcher\Event\AfterStepTested;
use Behat\Behat\EventDispatcher\Event\BeforeFeatureTested;
use Behat\Behat\EventDispatcher\Event\BeforeOutlineTested;
use Behat\Behat\EventDispatcher\Event\BeforeScenarioTested;
use Behat\Gherkin\Node\BackgroundNode;
use Behat\Gherkin\Node\ScenarioInterface;
use Behat\Gherkin\Node\StepNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Driver\Selenium2Driver;
use Behat\Mink\Mink;
use Behat\Testwork\EventDispatcher\Event\AfterSuiteTested;
use Behat\Testwork\EventDispatcher\Event\BeforeSuiteTested;
use Behat\Testwork\Output\Formatter;
use Behat\Testwork\Output\Printer\OutputPrinter;
use ReflectionClass;
use seretos\BehatLoggerExtension\Entity\BehatFeature;
use seretos\BehatLoggerExtension\Entity\BehatResult;
use seretos\BehatLoggerExtension\Entity\BehatScenario;
use seretos\BehatLoggerExtension\Entity\BehatStep;
use seretos\BehatLoggerExtension\Entity\BehatStepResult;
use seretos\BehatLoggerExtension\Entity\BehatSuite;

class BehatLogFormatter implements Formatter
{
    /**
     * @var BehatSuite
     */
    private $currentSuite;
    /**
     * @var BehatScenario
     */
    private $currentScenario;
    /**
     * @var BehatStepResult[]
     */
    private $currentStepResults;
    /**
     * @var OutputPrinter
     */
    private $printer;
    /**
     * @var string
     */
    private $output;
    /**
     * @var string
     */
    private $browser;
    /**
     * @var Mink
     */
    private $mink;

    public function __construct(Mink $mink,OutputPrinter $printer, string $output, array $parameters)
    {
        $this->currentSuite = null;
        $this->printer = $printer;
        $this->output = rtrim($output, '/').'/';
        $this->mink = $mink;
        $this->browser = $parameters['browser_name'];
    }

    /**
     * @param BeforeSuiteTested $event
     */
    public function onBeforeSuiteTested(BeforeSuiteTested $event) {
        $this->currentSuite = new BehatSuite($event->getSuite()->getName());
    }

    /**
     * @param AfterSuiteTested $event
     */
    public function onAfterSuiteTested(AfterSuiteTested $event) {
        if($event !== null) {
            $file = $this->currentSuite->getName().'.json';
            $this->printer->setOutputPath($this->output.$file);
            $this->printer->write([$this->currentSuite]);
        }
    }

    /**
     * @param BeforeFeatureTested $event
     */
    public function onBeforeFeatureTested(BeforeFeatureTested $event) {
        $feature = new BehatFeature($event->getFeature()->getFile(),
            $event->getFeature()->getTitle(),
            $event->getFeature()->getDescription(),
            $event->getFeature()->getLanguage());
        $this->currentSuite->addFeature($feature);
    }

    /**
     * @param BeforeScenarioTested $event
     * @throws \ReflectionException
     */
    public function onBeforeScenarioTested(BeforeScenarioTested $event) {
        $browser = $this->getBrowser();
        $scenario = new BehatScenario($event->getScenario()->getTitle(),$event->getScenario()->getTags());
        $scenarioResult = new BehatResult($browser);
        $scenario->addResult($scenarioResult);

        $this->importSteps($scenario,
            $event->getScenario(),
            $event->getFeature()->getBackground());

        $feature = $this->currentSuite->getFeature($event->getFeature()->getFile());

        $feature->addScenario($scenario);
        $this->currentScenario = $scenario;
        $this->currentStepResults = [];
    }

    /**
     * @param AfterScenarioTested $event
     * @throws \ReflectionException
     */
    public function onAfterScenarioTested(AfterScenarioTested $event) {
        $browser = $this->getBrowser();
        $result = $this->currentScenario->getResult($browser);
        foreach($this->currentStepResults as $stepResult){
            $result->addStepResult($stepResult);
        }
        $this->currentStepResults = [];
        $this->currentScenario = null;
    }

    /**
     * @param AfterStepTested $event
     */
    public function onAfterStepTested(AfterStepTested $event) {
        $stepResult = new BehatStepResult($event->getStep()->getLine(),$event->getTestResult()->isPassed());
        $this->currentStepResults[] = $stepResult;
    }

    /**
     * @param BeforeOutlineTested $event
     * @throws \ReflectionException
     */
    public function onBeforeOutlineTested(BeforeOutlineTested $event) {
        $browser = $this->getBrowser();
        $scenario = new BehatScenario($event->getOutline()->getTitle(),$event->getOutline()->getTags());
        $scenarioResult = new BehatResult($browser);
        $scenario->addResult($scenarioResult);

        $this->importSteps($scenario,
            $event->getOutline(),
            $event->getFeature()->getBackground());

        $feature = $this->currentSuite->getFeature($event->getFeature()->getFile());

        $feature->addScenario($scenario);
        $this->currentScenario = $scenario;
        $this->currentStepResults = [];
    }

    /**
     * @param AfterOutlineTested $event
     * @throws \ReflectionException
     */
    public function onAfterOutlineTested(AfterOutlineTested $event) {
        $browser = $this->getBrowser();
        $result = new BehatResult($browser);
        foreach($this->currentScenario->getSteps() as $step){
            $stepResult = new BehatStepResult($step->getLine(),$event->getTestResult()->isPassed());
            $result->addStepResult($stepResult);
        }
        $this->currentScenario->addResult($result);
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents(): array
    {
        return array(
//            'tester.exercise_completed.before' => 'onBeforeExercise',
//            'tester.exercise_completed.after' => 'onAfterExercise',
            'tester.suite_tested.before' => 'onBeforeSuiteTested',
            'tester.suite_tested.after' => 'onAfterSuiteTested',
            'tester.feature_tested.before' => 'onBeforeFeatureTested',
            //'tester.feature_tested.after' => 'onAfterFeatureTested',
            'tester.scenario_tested.before' => 'onBeforeScenarioTested',
            'tester.scenario_tested.after' => 'onAfterScenarioTested',
            'tester.outline_tested.before' => 'onBeforeOutlineTested',
            'tester.outline_tested.after' => 'onAfterOutlineTested',
            'tester.step_tested.after' => 'onAfterStepTested',
        );
    }

    /**
     * Returns formatter name.
     *
     * @return string
     */
    public function getName(): string
    {
        return "logger";
    }

    /**
     * Returns formatter description.
     *
     * @return string
     */
    public function getDescription()
    {
        return "log the test results in json format";
    }

    /**
     * Returns formatter output printer.
     *
     * @return OutputPrinter
     */
    public function getOutputPrinter()
    {
        return $this->printer;
    }

    /**
     * Sets formatter parameter.
     *
     * @param string $name
     * @param mixed $value
     */
    public function setParameter($name, $value)
    {
        // TODO: Implement setParameter() method.
    }

    /**
     * Returns parameter name.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getParameter($name)
    {
        return [];
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    private function getBrowser(){
        $browser = $this->browser;
        if(!$this->mink->getSession()->getDriver() instanceof Selenium2Driver){
            $browser = 'unknown';
        }else{
            /* @var $driver Selenium2Driver*/
            $driver = $this->mink->getSession()->getDriver();
            $reflection = new ReflectionClass(Selenium2Driver::class);
            $property = $reflection->getProperty('desiredCapabilities');
            $property->setAccessible(true);
            $values = $property->getValue($driver);
            if(isset($values['version']) && $values['version'] !== ''){
                $browser .= ' '.$values['version'];
            }
        }
        return $browser;
    }

    private function importSteps(BehatScenario $scenario,
                                 ScenarioInterface $scenarioNode,
                                 BackgroundNode $backgroundNode = null){
        if($backgroundNode!==null){
            foreach($backgroundNode->getSteps() as $step){
                $scenario->addStep($this->convertStep($step));
            }
        }
        foreach($scenarioNode->getSteps() as $step){
            $scenario->addStep($this->convertStep($step));
        }
    }

    private function convertStep(StepNode $step){
        $arguments = [];
        foreach ($step->getArguments() as $argument){
            if($argument instanceof TableNode){
                $arguments = $argument->getRows();
            }
        }
        $importStep = new BehatStep($step->getLine(),$step->getText(),$step->getKeyword(),$arguments);
        return $importStep;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: aappen
 * Date: 05.10.18
 * Time: 16:33
 */

namespace seretos\BehatLoggerExtension\Service;


use seretos\BehatLoggerExtension\Entity\BehatFeature;
use seretos\BehatLoggerExtension\Entity\BehatResult;
use seretos\BehatLoggerExtension\Entity\BehatScenario;
use seretos\BehatLoggerExtension\Exception\TestRailException;
use seretos\testrail\api\Configurations;
use seretos\testrail\api\Milestones;
use seretos\testrail\api\Plans;
use seretos\testrail\api\Results;
use seretos\testrail\api\Statuses;
use seretos\testrail\api\Users;
use seretos\testrail\Client;

class TestRailResultImporter extends AbstractTestRail
{
    /**
     * @var Milestones
     */
    private $milestoneApi;
    /**
     * @var Plans
     */
    private $planApi;
    /**
     * @var Configurations
     */
    private $configApi;
    /**
     * @var Statuses
     */
    private $stateApi;
    /**
     * @var Results
     */
    private $resultApi;
    /**
     * @var Users
     */
    private $userApi;
    /**
     * @var string
     */
    private $groupField;

    private $failedStateId;
    private $passedStateId;
    /**
     * @var string
     */
    private $userName;

    public function __construct(Client $client, string $projectName, string $suiteName, array $customFieldConfig, array $priorityConfig, string $identifierRegex, string $identifierField, string $groupField)
    {
        parent::__construct($client, $projectName, $suiteName, $customFieldConfig, $priorityConfig, null,$identifierRegex,$identifierField);
        $this->milestoneApi = $client->milestones();
        $this->planApi = $client->plans();
        $this->configApi = $client->configurations();
        $this->stateApi = $client->statuses();
        $this->resultApi = $client->results();
        $this->userApi = $client->users();
        $this->groupField = $groupField;

        $this->failedStateId = $this->stateApi->findByName('failed')['id'];
        $this->passedStateId = $this->stateApi->findByName('passed')['id'];
        $this->userName = $client->getUser();
    }

    /**
     * @param string $planName
     * @param string|null $description
     * @param string|null $milestoneName
     * @return mixed
     * @throws TestRailException
     */
    public function createPlan(string $planName, string $description = null, string $milestoneName = null){
        $milestoneId = null;
        if($milestoneName !== null){
            $milestone = $this->milestoneApi->findByName($this->projectId,$milestoneName);
            if(!isset($milestone['id'])){
                $milestone = $this->milestoneApi->create($this->projectId,$milestoneName);
            }
            $milestoneId = $milestone['id'];
        }

        $cases = $this->caseApi->all($this->projectId,$this->suiteId,null);
        $caseGroups = [];
        $caseIds = [];
        foreach($cases as $case){
            if($case['type_id'] == $this->typeId){
                $group = $this->fieldApi->findElementNameById($this->groupField,$case[$this->groupField]);
                $caseGroups[$group][] = $case['id'];
                $caseIds[] = $case['id'];
            }
        }

        $runGroup = [];
        $configGroups = [];
        foreach($caseGroups as $group => $val){
            $runGroup[$group] = [];
            $field = $this->configApi->findByGroupName($this->projectId,$group);
            foreach($field["configs"] as $config){
                $runGroup[$group][] = ['include_all' => false,'case_ids' => $val,'config_ids' => [$config['id']]];
                $configGroups[$group][] = $config['id'];
            }
        }

        $plan = $this->planApi->create($this->projectId,$planName,$description,$milestoneId);
        $user = $this->userApi->find($this->userName);
        if(!isset($user['id'])){
            throw new TestRailException('the user '.$this->userName.' not found!');
        }
        foreach($runGroup as $group => $runs){
            $this->planApi->createEntry($plan['id'],$this->suiteId,$group,$configGroups[$group],$runs,null,false,$caseIds,$user['id']);
        }

        return $this->planApi->get($plan['id']);
    }

    public function closePlan(int $planId){
        $this->planApi->close($planId);
    }

    /**
     * @param BehatScenario $scenario
     * @param BehatFeature $feature
     * @param array $plan
     * @throws \seretos\BehatLoggerExtension\Exception\TestRailException
     */
    public function createResult(BehatScenario $scenario, array $plan){
        $case = $this->caseApi->findByField($this->projectId,$this->suiteId,$this->identifierField,$scenario->getTestRailId($this->identifierRegex),null);
        $fields = $this->getCustomFieldValues($scenario->getTags());
        $group = $this->fieldApi->findElementNameById($this->groupField,$fields[$this->groupField]);
        $currentRun = null;
        foreach($scenario->getResults() as $result){
            foreach ($plan['entries'] as $entry){
                if($entry['name'] === $group){
                    foreach ($entry['runs'] as $run){
                        if($run['config'] === $result->getEnvironment()){
                            $currentRun = $run['id'];
                        }
                    }
                }
            }
            if($currentRun === null){
                throw new TestRailException('run for environment '.$result->getEnvironment().' not found!');
            }

            $state = $this->failedStateId;
            if($this->isResultPassed($result)){
                $state = $this->passedStateId;
            }
            $this->resultApi->create($currentRun,$case['id'],$state,['custom_step_results' => $this->getStepResults($scenario,$result),'comment' => $result->getMessage()]);
        }
    }

    private function isResultPassed(BehatResult $result){
        foreach($result->getStepResults() as $stepResult){
            if(!$stepResult->isPassed()){
                return false;
            }
        }
        return true;
    }

    private function getStepResults(BehatScenario $scenario, BehatResult $result){
        $jsonResults = [];
        foreach($result->getStepResults() as $stepResult){
            $step = $scenario->getStep($stepResult->getLine());
            $currentResult = ["content" => $this->getStepText($step), "expected" => "", "actual" => $stepResult->getMessage()];
            $currentResult['status_id'] = $this->failedStateId;
            if($stepResult->isPassed()){
                $currentResult['status_id'] = $this->passedStateId;
            }
            $jsonResults[] = $currentResult;
        }
        return $jsonResults;
    }
}
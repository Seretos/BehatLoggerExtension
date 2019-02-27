<?php
/**
 * Created by PhpStorm.
 * User: aappen
 * Date: 11.08.18
 * Time: 16:34
 */

namespace seretos\BehatLoggerExtension\Service;


use Behat\Gherkin\Keywords\ArrayKeywords;
use Behat\Gherkin\Lexer;
use Behat\Gherkin\Parser;
use seretos\BehatLoggerExtension\Entity\BehatFeature;
use seretos\BehatLoggerExtension\Entity\BehatResult;
use seretos\BehatLoggerExtension\Entity\BehatScenario;
use seretos\BehatLoggerExtension\Entity\BehatStep;
use seretos\BehatLoggerExtension\Entity\BehatStepResult;
use seretos\BehatLoggerExtension\Entity\BehatSuite;

class BehatLoggerFactory
{
    /**
     * @param string $name
     * @return BehatSuite
     */
    public function createSuite(string $name){
        return new BehatSuite($name);
    }

    /**
     * @param string $filename
     * @param string $title
     * @param string|null $description
     * @param string $language
     * @return BehatFeature
     */
    public function createFeature(string $filename, string $title = null, string $description = null, string $language = 'en'){
        return new BehatFeature($filename, $title, $description, $language);
    }

    /**
     * @param string $title
     * @param array $tags
     * @return BehatScenario
     */
    public function createScenario(string $title = null, array $tags = []){
        return new BehatScenario($title, $tags);
    }

    /**
     * @param string $environment
     * @param null|string $message
     * @return BehatResult
     */
    public function createResult(string $environment, string $message = null){
        return new BehatResult($environment, $message);
    }

    /**
     * @param int $line
     * @param bool $passed
     * @param string|null $screenshot
     * @param string|null $message
     * @return BehatStepResult
     */
    public function createStepResult(int $line, bool $passed, string $screenshot = null, string $message = null){
        return new BehatStepResult($line, $passed, $screenshot,$message);
    }

    /**
     * @param int $line
     * @param string $text
     * @param string $keyword
     * @param array $arguments
     * @return BehatStep
     */
    public function createStep(int $line, string $text, string $keyword, array $arguments = []){
        return new BehatStep($line, $text, $keyword, $arguments);
    }

    public function getKeywords(){
        return array (
            'en' =>
                array (
                    'and' => 'And|*',
                    'background' => 'Background',
                    'but' => 'But|*',
                    'examples' => 'Scenarios|Examples',
                    'feature' => 'Business Need|Feature|Ability',
                    'given' => 'Given|*',
                    'name' => 'English',
                    'native' => 'English',
                    'scenario' => 'Scenario',
                    'scenario_outline' => 'Scenario Template|Scenario Outline',
                    'then' => 'Then|*',
                    'when' => 'When|*',
                ),
            'af' =>
                array (
                    'and' => 'En|*',
                    'background' => 'Agtergrond',
                    'but' => 'Maar|*',
                    'examples' => 'Voorbeelde',
                    'feature' => 'Besigheid Behoefte|Funksie|Vermoë',
                    'given' => 'Gegewe|*',
                    'name' => 'Afrikaans',
                    'native' => 'Afrikaans',
                    'scenario' => 'Situasie',
                    'scenario_outline' => 'Situasie Uiteensetting',
                    'then' => 'Dan|*',
                    'when' => 'Wanneer|*',
                ),
            'am' =>
                array (
                    'and' => 'Եվ|*',
                    'background' => 'Կոնտեքստ',
                    'but' => 'Բայց|*',
                    'examples' => 'Օրինակներ',
                    'feature' => 'Ֆունկցիոնալություն|Հատկություն',
                    'given' => 'Դիցուք|*',
                    'name' => 'Armenian',
                    'native' => 'հայերեն',
                    'scenario' => 'Սցենար',
                    'scenario_outline' => 'Սցենարի կառուցվացքը',
                    'then' => 'Ապա|*',
                    'when' => 'Երբ|Եթե|*',
                ),
            'ar' =>
                array (
                    'and' => '*|و',
                    'background' => 'الخلفية',
                    'but' => 'لكن|*',
                    'examples' => 'امثلة',
                    'feature' => 'خاصية',
                    'given' => 'بفرض|*',
                    'name' => 'Arabic',
                    'native' => 'العربية',
                    'scenario' => 'سيناريو',
                    'scenario_outline' => 'سيناريو مخطط',
                    'then' => 'اذاً|ثم|*',
                    'when' => 'عندما|متى|*',
                ),
            'ast' =>
                array (
                    'and' => 'Ya|*|Y',
                    'background' => 'Antecedentes',
                    'but' => 'Peru|*',
                    'examples' => 'Exemplos',
                    'feature' => 'Carauterística',
                    'given' => 'Dada|Daos|Daes|Dáu|*',
                    'name' => 'Asturian',
                    'native' => 'asturianu',
                    'scenario' => 'Casu',
                    'scenario_outline' => 'Esbozu del casu',
                    'then' => 'Entós|*',
                    'when' => 'Cuando|*',
                ),
            'az' =>
                array (
                    'and' => 'Həm|Və|*',
                    'background' => 'Kontekst|Keçmiş',
                    'but' => 'Ancaq|Amma|*',
                    'examples' => 'Nümunələr',
                    'feature' => 'Özəllik',
                    'given' => 'Tutaq ki|Verilir|*',
                    'name' => 'Azerbaijani',
                    'native' => 'Azərbaycanca',
                    'scenario' => 'Ssenari',
                    'scenario_outline' => 'Ssenarinin strukturu',
                    'then' => 'O halda|*',
                    'when' => 'Nə vaxt ki|Əgər|*',
                ),
            'bg' =>
                array (
                    'and' => '*|И',
                    'background' => 'Предистория',
                    'but' => 'Но|*',
                    'examples' => 'Примери',
                    'feature' => 'Функционалност',
                    'given' => 'Дадено|*',
                    'name' => 'Bulgarian',
                    'native' => 'български',
                    'scenario' => 'Сценарий',
                    'scenario_outline' => 'Рамка на сценарий',
                    'then' => 'То|*',
                    'when' => 'Когато|*',
                ),
            'bm' =>
                array (
                    'and' => 'Dan|*',
                    'background' => 'Latar Belakang',
                    'but' => 'Tetapi|Tapi|*',
                    'examples' => 'Contoh',
                    'feature' => 'Fungsi',
                    'given' => 'Diberi|Bagi|*',
                    'name' => 'Malay',
                    'native' => 'Bahasa Melayu',
                    'scenario' => 'Senario|Situasi|Keadaan',
                    'scenario_outline' => 'Garis Panduan Senario|Kerangka Senario|Kerangka Situasi|Kerangka Keadaan',
                    'then' => 'Kemudian|Maka|*',
                    'when' => 'Apabila|*',
                ),
            'bs' =>
                array (
                    'and' => '*|I|A',
                    'background' => 'Pozadina',
                    'but' => 'Ali|*',
                    'examples' => 'Primjeri',
                    'feature' => 'Karakteristika',
                    'given' => 'Dato|*',
                    'name' => 'Bosnian',
                    'native' => 'Bosanski',
                    'scenario' => 'Scenariju|Scenario',
                    'scenario_outline' => 'Scenario-outline|Scenariju-obris',
                    'then' => 'Zatim|*',
                    'when' => 'Kada|*',
                ),
            'ca' =>
                array (
                    'and' => '*|I',
                    'background' => 'Antecedents|Rerefons',
                    'but' => 'Però|*',
                    'examples' => 'Exemples',
                    'feature' => 'Característica|Funcionalitat',
                    'given' => 'Donada|Donat|Atesa|Atès|*',
                    'name' => 'Catalan',
                    'native' => 'català',
                    'scenario' => 'Escenari',
                    'scenario_outline' => 'Esquema de l\'escenari',
                    'then' => 'Aleshores|Cal|*',
                    'when' => 'Quan|*',
                ),
            'cs' =>
                array (
                    'and' => 'A také|*|A',
                    'background' => 'Kontext|Pozadí',
                    'but' => 'Ale|*',
                    'examples' => 'Příklady',
                    'feature' => 'Požadavek',
                    'given' => 'Za předpokladu|Pokud|*',
                    'name' => 'Czech',
                    'native' => 'Česky',
                    'scenario' => 'Scénář',
                    'scenario_outline' => 'Osnova scénáře|Náčrt Scénáře',
                    'then' => 'Pak|*',
                    'when' => 'Když|*',
                ),
            'cy-GB' =>
                array (
                    'and' => '*|A',
                    'background' => 'Cefndir',
                    'but' => 'Ond|*',
                    'examples' => 'Enghreifftiau',
                    'feature' => 'Arwedd',
                    'given' => 'Anrhegedig a|*',
                    'name' => 'Welsh',
                    'native' => 'Cymraeg',
                    'scenario' => 'Scenario',
                    'scenario_outline' => 'Scenario Amlinellol',
                    'then' => 'Yna|*',
                    'when' => 'Pryd|*',
                ),
            'da' =>
                array (
                    'and' => 'Og|*',
                    'background' => 'Baggrund',
                    'but' => 'Men|*',
                    'examples' => 'Eksempler',
                    'feature' => 'Egenskab',
                    'given' => 'Givet|*',
                    'name' => 'Danish',
                    'native' => 'dansk',
                    'scenario' => 'Scenarie',
                    'scenario_outline' => 'Abstrakt Scenario',
                    'then' => 'Så|*',
                    'when' => 'Når|*',
                ),
            'de' =>
                array (
                    'and' => 'Und|*',
                    'background' => 'Grundlage',
                    'but' => 'Aber|*',
                    'examples' => 'Beispiele',
                    'feature' => 'Funktionalität',
                    'given' => 'Gegeben seien|Gegeben sei|Angenommen|*',
                    'name' => 'German',
                    'native' => 'Deutsch',
                    'scenario' => 'Szenario',
                    'scenario_outline' => 'Szenariogrundriss',
                    'then' => 'Dann|*',
                    'when' => 'Wenn|*',
                ),
            'el' =>
                array (
                    'and' => 'Και|*',
                    'background' => 'Υπόβαθρο',
                    'but' => 'Αλλά|*',
                    'examples' => 'Παραδείγματα|Σενάρια',
                    'feature' => 'Δυνατότητα|Λειτουργία',
                    'given' => 'Δεδομένου|*',
                    'name' => 'Greek',
                    'native' => 'Ελληνικά',
                    'scenario' => 'Σενάριο',
                    'scenario_outline' => 'Περιγραφή Σεναρίου',
                    'then' => 'Τότε|*',
                    'when' => 'Όταν|*',
                ),
            'em' =>
                array (
                    'and' => '😂<|*',
                    'background' => '💤',
                    'but' => '😔<|*',
                    'examples' => '📓',
                    'feature' => '📚',
                    'given' => '😐<|*',
                    'name' => 'Emoji',
                    'native' => '😀',
                    'scenario' => '📕',
                    'scenario_outline' => '📖',
                    'then' => '🙏<|*',
                    'when' => '🎬<|*',
                ),
            'en-Scouse' =>
                array (
                    'and' => 'An|*',
                    'background' => 'Dis is what went down',
                    'but' => 'Buh|*',
                    'examples' => 'Examples',
                    'feature' => 'Feature',
                    'given' => 'Youse know when youse got|Givun|*',
                    'name' => 'Scouse',
                    'native' => 'Scouse',
                    'scenario' => 'The thing of it is',
                    'scenario_outline' => 'Wharrimean is',
                    'then' => 'Den youse gotta|Dun|*',
                    'when' => 'Youse know like when|Wun|*',
                ),
            'en-au' =>
                array (
                    'and' => 'Too right|*',
                    'background' => 'First off',
                    'but' => 'Yeah nah|*',
                    'examples' => 'You\'ll wanna',
                    'feature' => 'Pretty much',
                    'given' => 'Y\'know|*',
                    'name' => 'Australian',
                    'native' => 'Australian',
                    'scenario' => 'Awww, look mate',
                    'scenario_outline' => 'Reckon it\'s like',
                    'then' => 'But at the end of the day I reckon|*',
                    'when' => 'It\'s just unbelievable|*',
                ),
            'en-lol' =>
                array (
                    'and' => 'AN|*',
                    'background' => 'B4',
                    'but' => 'BUT|*',
                    'examples' => 'EXAMPLZ',
                    'feature' => 'OH HAI',
                    'given' => 'I CAN HAZ|*',
                    'name' => 'LOLCAT',
                    'native' => 'LOLCAT',
                    'scenario' => 'MISHUN',
                    'scenario_outline' => 'MISHUN SRSLY',
                    'then' => 'DEN|*',
                    'when' => 'WEN|*',
                ),
            'en-old' =>
                array (
                    'and' => 'Ond|*|7',
                    'background' => 'Aer|Ær',
                    'but' => 'Ac|*',
                    'examples' => 'Se the|Se þe|Se ðe',
                    'feature' => 'Hwaet|Hwæt',
                    'given' => 'Thurh|Þurh|Ðurh|*',
                    'name' => 'Old English',
                    'native' => 'Englisc',
                    'scenario' => 'Swa',
                    'scenario_outline' => 'Swa hwaer swa|Swa hwær swa',
                    'then' => 'Tha the|Þa þe|Ða ðe|Tha|Þa|Ða|*',
                    'when' => 'Tha|Þa|Ða|*',
                ),
            'en-pirate' =>
                array (
                    'and' => 'Aye|*',
                    'background' => 'Yo-ho-ho',
                    'but' => 'Avast!|*',
                    'examples' => 'Dead men tell no tales',
                    'feature' => 'Ahoy matey!',
                    'given' => 'Gangway!|*',
                    'name' => 'Pirate',
                    'native' => 'Pirate',
                    'scenario' => 'Heave to',
                    'scenario_outline' => 'Shiver me timbers',
                    'then' => 'Let go and haul|*',
                    'when' => 'Blimey!|*',
                ),
            'eo' =>
                array (
                    'and' => 'Kaj|*',
                    'background' => 'Fono',
                    'but' => 'Sed|*',
                    'examples' => 'Ekzemploj',
                    'feature' => 'Trajto',
                    'given' => 'Donitaĵo|Komence|*',
                    'name' => 'Esperanto',
                    'native' => 'Esperanto',
                    'scenario' => 'Scenaro|Kazo',
                    'scenario_outline' => 'Konturo de la scenaro|Kazo-skizo|Skizo',
                    'then' => 'Do|*',
                    'when' => 'Se|*',
                ),
            'es' =>
                array (
                    'and' => '*|Y|E',
                    'background' => 'Antecedentes',
                    'but' => 'Pero|*',
                    'examples' => 'Ejemplos',
                    'feature' => 'Característica',
                    'given' => 'Dados|Dadas|Dada|Dado|*',
                    'name' => 'Spanish',
                    'native' => 'español',
                    'scenario' => 'Escenario',
                    'scenario_outline' => 'Esquema del escenario',
                    'then' => 'Entonces|*',
                    'when' => 'Cuando|*',
                ),
            'et' =>
                array (
                    'and' => 'Ja|*',
                    'background' => 'Taust',
                    'but' => 'Kuid|*',
                    'examples' => 'Juhtumid',
                    'feature' => 'Omadus',
                    'given' => 'Eeldades|*',
                    'name' => 'Estonian',
                    'native' => 'eesti keel',
                    'scenario' => 'Stsenaarium',
                    'scenario_outline' => 'Raamstsenaarium',
                    'then' => 'Siis|*',
                    'when' => 'Kui|*',
                ),
            'fa' =>
                array (
                    'and' => '*|و',
                    'background' => 'زمینه',
                    'but' => 'اما|*',
                    'examples' => 'نمونه ها',
                    'feature' => 'وِیژگی',
                    'given' => 'با فرض|*',
                    'name' => 'Persian',
                    'native' => 'فارسی',
                    'scenario' => 'سناریو',
                    'scenario_outline' => 'الگوی سناریو',
                    'then' => 'آنگاه|*',
                    'when' => 'هنگامی|*',
                ),
            'fi' =>
                array (
                    'and' => 'Ja|*',
                    'background' => 'Tausta',
                    'but' => 'Mutta|*',
                    'examples' => 'Tapaukset',
                    'feature' => 'Ominaisuus',
                    'given' => 'Oletetaan|*',
                    'name' => 'Finnish',
                    'native' => 'suomi',
                    'scenario' => 'Tapaus',
                    'scenario_outline' => 'Tapausaihio',
                    'then' => 'Niin|*',
                    'when' => 'Kun|*',
                ),
            'fr' =>
                array (
                    'and' => 'Et qu\'<|Et que|Et|*',
                    'background' => 'Contexte',
                    'but' => 'Mais qu\'<|Mais que|Mais|*',
                    'examples' => 'Exemples',
                    'feature' => 'Fonctionnalité',
                    'given' => 'Etant donné qu\'<|Étant donné qu\'<|Etant donné que|Étant donné que|Etant données|Étant données|Etant donnée|Etant donnés|Étant donnée|Étant donnés|Etant donné|Étant donné|Soit|*',
                    'name' => 'French',
                    'native' => 'français',
                    'scenario' => 'Scénario',
                    'scenario_outline' => 'Plan du scénario|Plan du Scénario',
                    'then' => 'Alors|*',
                    'when' => 'Lorsqu\'<|Lorsque|Quand|*',
                ),
            'ga' =>
                array (
                    'and' => 'Agus<|*',
                    'background' => 'Cúlra',
                    'but' => 'Ach<|*',
                    'examples' => 'Samplaí',
                    'feature' => 'Gné',
                    'given' => 'Cuir i gcás nach<|Cuir i gcás gur<|Cuir i gcás nár<|Cuir i gcás go<|*',
                    'name' => 'Irish',
                    'native' => 'Gaeilge',
                    'scenario' => 'Cás',
                    'scenario_outline' => 'Cás Achomair',
                    'then' => 'Ansin<|*',
                    'when' => 'Nuair nach<|Nuair nár<|Nuair ba<|Nuair a<|*',
                ),
            'gj' =>
                array (
                    'and' => 'અને|*',
                    'background' => 'બેકગ્રાઉન્ડ',
                    'but' => 'પણ|*',
                    'examples' => 'ઉદાહરણો',
                    'feature' => 'વ્યાપાર જરૂર|ક્ષમતા|લક્ષણ',
                    'given' => 'આપેલ છે|*',
                    'name' => 'Gujarati',
                    'native' => 'ગુજરાતી',
                    'scenario' => 'સ્થિતિ',
                    'scenario_outline' => 'પરિદ્દશ્ય રૂપરેખા|પરિદ્દશ્ય ઢાંચો',
                    'then' => 'પછી|*',
                    'when' => 'ક્યારે|*',
                ),
            'gl' =>
                array (
                    'and' => '*|E',
                    'background' => 'Contexto',
                    'but' => 'Pero|Mais|*',
                    'examples' => 'Exemplos',
                    'feature' => 'Característica',
                    'given' => 'Dados|Dadas|Dada|Dado|*',
                    'name' => 'Galician',
                    'native' => 'galego',
                    'scenario' => 'Escenario',
                    'scenario_outline' => 'Esbozo do escenario',
                    'then' => 'Entón|Logo|*',
                    'when' => 'Cando|*',
                ),
            'he' =>
                array (
                    'and' => 'וגם|*',
                    'background' => 'רקע',
                    'but' => 'אבל|*',
                    'examples' => 'דוגמאות',
                    'feature' => 'תכונה',
                    'given' => 'בהינתן|*',
                    'name' => 'Hebrew',
                    'native' => 'עברית',
                    'scenario' => 'תרחיש',
                    'scenario_outline' => 'תבנית תרחיש',
                    'then' => 'אזי|אז|*',
                    'when' => 'כאשר|*',
                ),
            'hi' =>
                array (
                    'and' => 'तथा|और|*',
                    'background' => 'पृष्ठभूमि',
                    'but' => 'परन्तु|किन्तु|पर|*',
                    'examples' => 'उदाहरण',
                    'feature' => 'रूप लेख',
                    'given' => 'चूंकि|यदि|अगर|*',
                    'name' => 'Hindi',
                    'native' => 'हिंदी',
                    'scenario' => 'परिदृश्य',
                    'scenario_outline' => 'परिदृश्य रूपरेखा',
                    'then' => 'तदा|तब|*',
                    'when' => 'कदा|जब|*',
                ),
            'hr' =>
                array (
                    'and' => '*|I',
                    'background' => 'Pozadina',
                    'but' => 'Ali|*',
                    'examples' => 'Scenariji|Primjeri',
                    'feature' => 'Mogucnost|Mogućnost|Osobina',
                    'given' => 'Zadani|Zadano|Zadan|*',
                    'name' => 'Croatian',
                    'native' => 'hrvatski',
                    'scenario' => 'Scenarij',
                    'scenario_outline' => 'Koncept|Skica',
                    'then' => 'Onda|*',
                    'when' => 'Kada|Kad|*',
                ),
            'ht' =>
                array (
                    'and' => 'Epi|Ak|*|E',
                    'background' => 'Kontèks|Istorik',
                    'but' => 'Men|*',
                    'examples' => 'Egzanp',
                    'feature' => 'Karakteristik|Fonksyonalite|Mak',
                    'given' => 'Sipoze ke|Sipoze Ke|Sipoze|*',
                    'name' => 'Creole',
                    'native' => 'kreyòl',
                    'scenario' => 'Senaryo',
                    'scenario_outline' => 'Senaryo deskripsyon|Senaryo Deskripsyon|Dyagram senaryo|Dyagram Senaryo|Plan senaryo|Plan Senaryo',
                    'then' => 'Le sa a|Lè sa a|*',
                    'when' => 'Le|Lè|*',
                ),
            'hu' =>
                array (
                    'and' => 'És|*',
                    'background' => 'Háttér',
                    'but' => 'De|*',
                    'examples' => 'Példák',
                    'feature' => 'Jellemző',
                    'given' => 'Amennyiben|Adott|*',
                    'name' => 'Hungarian',
                    'native' => 'magyar',
                    'scenario' => 'Forgatókönyv',
                    'scenario_outline' => 'Forgatókönyv vázlat',
                    'then' => 'Akkor|*',
                    'when' => 'Amikor|Majd|Ha|*',
                ),
            'id' =>
                array (
                    'and' => 'Dan|*',
                    'background' => 'Dasar',
                    'but' => 'Tapi|*',
                    'examples' => 'Contoh',
                    'feature' => 'Fitur',
                    'given' => 'Dengan|*',
                    'name' => 'Indonesian',
                    'native' => 'Bahasa Indonesia',
                    'scenario' => 'Skenario',
                    'scenario_outline' => 'Skenario konsep',
                    'then' => 'Maka|*',
                    'when' => 'Ketika|*',
                ),
            'is' =>
                array (
                    'and' => 'Og|*',
                    'background' => 'Bakgrunnur',
                    'but' => 'En|*',
                    'examples' => 'Atburðarásir|Dæmi',
                    'feature' => 'Eiginleiki',
                    'given' => 'Ef|*',
                    'name' => 'Icelandic',
                    'native' => 'Íslenska',
                    'scenario' => 'Atburðarás',
                    'scenario_outline' => 'Lýsing Atburðarásar|Lýsing Dæma',
                    'then' => 'Þá|*',
                    'when' => 'Þegar|*',
                ),
            'it' =>
                array (
                    'and' => '*|E',
                    'background' => 'Contesto',
                    'but' => 'Ma|*',
                    'examples' => 'Esempi',
                    'feature' => 'Funzionalità',
                    'given' => 'Data|Dato|Dati|Date|*',
                    'name' => 'Italian',
                    'native' => 'italiano',
                    'scenario' => 'Scenario',
                    'scenario_outline' => 'Schema dello scenario',
                    'then' => 'Allora|*',
                    'when' => 'Quando|*',
                ),
            'ja' =>
                array (
                    'and' => 'かつ<|*',
                    'background' => '背景',
                    'but' => 'しかし<|ただし<|但し<|*',
                    'examples' => 'サンプル|例',
                    'feature' => 'フィーチャ|機能',
                    'given' => '前提<|*',
                    'name' => 'Japanese',
                    'native' => '日本語',
                    'scenario' => 'シナリオ',
                    'scenario_outline' => 'シナリオアウトライン|シナリオテンプレート|シナリオテンプレ|テンプレ',
                    'then' => 'ならば<|*',
                    'when' => 'もし<|*',
                ),
            'jv' =>
                array (
                    'and' => 'Lan|*',
                    'background' => 'Dasar',
                    'but' => 'Ananging|Nanging|Tapi|*',
                    'examples' => 'Contone|Conto',
                    'feature' => 'Fitur',
                    'given' => 'Nalikaning|Nalika|*',
                    'name' => 'Javanese',
                    'native' => 'Basa Jawa',
                    'scenario' => 'Skenario',
                    'scenario_outline' => 'Konsep skenario',
                    'then' => 'Banjur|Njuk|*',
                    'when' => 'Menawa|Manawa|*',
                ),
            'ka' =>
                array (
                    'and' => 'და<|*',
                    'background' => 'კონტექსტი',
                    'but' => 'მაგ­რამ<|*',
                    'examples' => 'მაგალითები',
                    'feature' => 'თვისება',
                    'given' => 'მოცემული<|*',
                    'name' => 'Georgian',
                    'native' => 'ქართველი',
                    'scenario' => 'სცენარის',
                    'scenario_outline' => 'სცენარის ნიმუში',
                    'then' => 'მაშინ<|*',
                    'when' => 'როდესაც<|*',
                ),
            'kn' =>
                array (
                    'and' => 'ಮತ್ತು|*',
                    'background' => 'ಹಿನ್ನೆಲೆ',
                    'but' => 'ಆದರೆ|*',
                    'examples' => 'ಉದಾಹರಣೆಗಳು',
                    'feature' => 'ಹೆಚ್ಚಳ',
                    'given' => 'ನೀಡಿದ|*',
                    'name' => 'Kannada',
                    'native' => 'ಕನ್ನಡ',
                    'scenario' => 'ಕಥಾಸಾರಾಂಶ',
                    'scenario_outline' => 'ವಿವರಣೆ',
                    'then' => 'ನಂತರ|*',
                    'when' => 'ಸ್ಥಿತಿಯನ್ನು|*',
                ),
            'ko' =>
                array (
                    'and' => '그리고<|*',
                    'background' => '배경',
                    'but' => '하지만<|단<|*',
                    'examples' => '예',
                    'feature' => '기능',
                    'given' => '먼저<|조건<|*',
                    'name' => 'Korean',
                    'native' => '한국어',
                    'scenario' => '시나리오',
                    'scenario_outline' => '시나리오 개요',
                    'then' => '그러면<|*',
                    'when' => '만약<|만일<|*',
                ),
            'lt' =>
                array (
                    'and' => 'Ir|*',
                    'background' => 'Kontekstas',
                    'but' => 'Bet|*',
                    'examples' => 'Pavyzdžiai|Scenarijai|Variantai',
                    'feature' => 'Savybė',
                    'given' => 'Duota|*',
                    'name' => 'Lithuanian',
                    'native' => 'lietuvių kalba',
                    'scenario' => 'Scenarijus',
                    'scenario_outline' => 'Scenarijaus šablonas',
                    'then' => 'Tada|*',
                    'when' => 'Kai|*',
                ),
            'lu' =>
                array (
                    'and' => 'an|*|a',
                    'background' => 'Hannergrond',
                    'but' => 'awer|mä|*',
                    'examples' => 'Beispiller',
                    'feature' => 'Funktionalitéit',
                    'given' => 'ugeholl|*',
                    'name' => 'Luxemburgish',
                    'native' => 'Lëtzebuergesch',
                    'scenario' => 'Szenario',
                    'scenario_outline' => 'Plang vum Szenario',
                    'then' => 'dann|*',
                    'when' => 'wann|*',
                ),
            'lv' =>
                array (
                    'and' => 'Un|*',
                    'background' => 'Konteksts|Situācija',
                    'but' => 'Bet|*',
                    'examples' => 'Piemēri|Paraugs',
                    'feature' => 'Funkcionalitāte|Fīča',
                    'given' => 'Kad|*',
                    'name' => 'Latvian',
                    'native' => 'latviešu',
                    'scenario' => 'Scenārijs',
                    'scenario_outline' => 'Scenārijs pēc parauga',
                    'then' => 'Tad|*',
                    'when' => 'Ja|*',
                ),
            'mk-Cyrl' =>
                array (
                    'and' => '*|И',
                    'background' => 'Контекст|Содржина',
                    'but' => 'Но|*',
                    'examples' => 'Сценарија|Примери',
                    'feature' => 'Функционалност|Бизнис потреба|Можност',
                    'given' => 'Дадена|Дадено|*',
                    'name' => 'Macedonian',
                    'native' => 'Македонски',
                    'scenario' => 'На пример|Сценарио',
                    'scenario_outline' => 'Преглед на сценарија|Концепт|Скица',
                    'then' => 'Тогаш|*',
                    'when' => 'Кога|*',
                ),
            'mk-Latn' =>
                array (
                    'and' => '*|I',
                    'background' => 'Sodrzhina|Kontekst',
                    'but' => 'No|*',
                    'examples' => 'Scenaria|Primeri',
                    'feature' => 'Funkcionalnost|Biznis potreba|Mozhnost',
                    'given' => 'Dadena|Dadeno|*',
                    'name' => 'Macedonian (Latin)',
                    'native' => 'Makedonski (Latinica)',
                    'scenario' => 'Na primer|Scenario',
                    'scenario_outline' => 'Pregled na scenarija|Koncept|Skica',
                    'then' => 'Togash|*',
                    'when' => 'Koga|*',
                ),
            'mn' =>
                array (
                    'and' => 'Тэгээд|Мөн|*',
                    'background' => 'Агуулга',
                    'but' => 'Гэхдээ|Харин|*',
                    'examples' => 'Тухайлбал',
                    'feature' => 'Функционал|Функц',
                    'given' => 'Өгөгдсөн нь|Анх|*',
                    'name' => 'Mongolian',
                    'native' => 'монгол',
                    'scenario' => 'Сценар',
                    'scenario_outline' => 'Сценарын төлөвлөгөө',
                    'then' => 'Үүний дараа|Тэгэхэд|*',
                    'when' => 'Хэрэв|*',
                ),
            'nl' =>
                array (
                    'and' => 'En|*',
                    'background' => 'Achtergrond',
                    'but' => 'Maar|*',
                    'examples' => 'Voorbeelden',
                    'feature' => 'Functionaliteit',
                    'given' => 'Gegeven|Stel|*',
                    'name' => 'Dutch',
                    'native' => 'Nederlands',
                    'scenario' => 'Scenario',
                    'scenario_outline' => 'Abstract Scenario',
                    'then' => 'Dan|*',
                    'when' => 'Wanneer|Als|*',
                ),
            'no' =>
                array (
                    'and' => 'Og|*',
                    'background' => 'Bakgrunn',
                    'but' => 'Men|*',
                    'examples' => 'Eksempler',
                    'feature' => 'Egenskap',
                    'given' => 'Gitt|*',
                    'name' => 'Norwegian',
                    'native' => 'norsk',
                    'scenario' => 'Scenario',
                    'scenario_outline' => 'Abstrakt Scenario|Scenariomal',
                    'then' => 'Så|*',
                    'when' => 'Når|*',
                ),
            'pa' =>
                array (
                    'and' => 'ਅਤੇ|*',
                    'background' => 'ਪਿਛੋਕੜ',
                    'but' => 'ਪਰ|*',
                    'examples' => 'ਉਦਾਹਰਨਾਂ',
                    'feature' => 'ਨਕਸ਼ ਨੁਹਾਰ|ਮੁਹਾਂਦਰਾ|ਖਾਸੀਅਤ',
                    'given' => 'ਜਿਵੇਂ ਕਿ|ਜੇਕਰ|*',
                    'name' => 'Panjabi',
                    'native' => 'ਪੰਜਾਬੀ',
                    'scenario' => 'ਪਟਕਥਾ',
                    'scenario_outline' => 'ਪਟਕਥਾ ਰੂਪ ਰੇਖਾ|ਪਟਕਥਾ ਢਾਂਚਾ',
                    'then' => 'ਤਦ|*',
                    'when' => 'ਜਦੋਂ|*',
                ),
            'pl' =>
                array (
                    'and' => 'Oraz|*|I',
                    'background' => 'Założenia',
                    'but' => 'Ale|*',
                    'examples' => 'Przykłady',
                    'feature' => 'Potrzeba biznesowa|Właściwość|Funkcja|Aspekt',
                    'given' => 'Zakładając, że|Zakładając|Mając|*',
                    'name' => 'Polish',
                    'native' => 'polski',
                    'scenario' => 'Scenariusz',
                    'scenario_outline' => 'Szablon scenariusza',
                    'then' => 'Wtedy|*',
                    'when' => 'Jeżeli|Jeśli|Kiedy|Gdy|*',
                ),
            'pt' =>
                array (
                    'and' => '*|E',
                    'background' => 'Cenario de Fundo|Cenário de Fundo|Contexto|Fundo',
                    'but' => 'Mas|*',
                    'examples' => 'Exemplos|Cenários|Cenarios',
                    'feature' => 'Funcionalidade|Característica|Caracteristica',
                    'given' => 'Dados|Dadas|Dada|Dado|*',
                    'name' => 'Portuguese',
                    'native' => 'português',
                    'scenario' => 'Cenário|Cenario',
                    'scenario_outline' => 'Delineação do Cenário|Delineacao do Cenario|Esquema do Cenário|Esquema do Cenario',
                    'then' => 'Entao|Então|*',
                    'when' => 'Quando|*',
                ),
            'ro' =>
                array (
                    'and' => 'Și|Si|Şi|*',
                    'background' => 'Context',
                    'but' => 'Dar|*',
                    'examples' => 'Exemple',
                    'feature' => 'Functionalitate|Funcționalitate|Funcţionalitate',
                    'given' => 'Date fiind|Dati fiind|Dați fiind|Daţi fiind|Dat fiind|*',
                    'name' => 'Romanian',
                    'native' => 'română',
                    'scenario' => 'Scenariu',
                    'scenario_outline' => 'Structura scenariu|Structură scenariu',
                    'then' => 'Atunci|*',
                    'when' => 'Când|Cand|*',
                ),
            'ru' =>
                array (
                    'and' => 'К тому же|Также|*|И',
                    'background' => 'Предыстория|Контекст',
                    'but' => 'Но|*|А',
                    'examples' => 'Примеры',
                    'feature' => 'Функциональность|Функционал|Свойство|Функция',
                    'given' => 'Допустим|Пусть|Дано|Если|*',
                    'name' => 'Russian',
                    'native' => 'русский',
                    'scenario' => 'Сценарий',
                    'scenario_outline' => 'Структура сценария',
                    'then' => 'Затем|Тогда|То|*',
                    'when' => 'Когда|*',
                ),
            'sk' =>
                array (
                    'and' => 'A taktiež|A zároveň|A tiež|*|A',
                    'background' => 'Pozadie',
                    'but' => 'Ale|*',
                    'examples' => 'Príklady',
                    'feature' => 'Požiadavka|Vlastnosť|Funkcia',
                    'given' => 'Za predpokladu|Pokiaľ|*',
                    'name' => 'Slovak',
                    'native' => 'Slovensky',
                    'scenario' => 'Scenár',
                    'scenario_outline' => 'Osnova Scenára|Náčrt Scenáru|Náčrt Scenára',
                    'then' => 'Potom|Tak|*',
                    'when' => 'Keď|Ak|*',
                ),
            'sl' =>
                array (
                    'and' => 'Ter|In',
                    'background' => 'Kontekst|Osnova|Ozadje',
                    'but' => 'Vendar|Ampak|Toda',
                    'examples' => 'Scenariji|Primeri',
                    'feature' => 'Funkcionalnost|Značilnost|Funkcija|Možnosti|Moznosti|Lastnost',
                    'given' => 'Privzeto|Zaradi|Podano|Dano',
                    'name' => 'Slovenian',
                    'native' => 'Slovenski',
                    'scenario' => 'Scenarij|Primer',
                    'scenario_outline' => 'Struktura scenarija|Oris scenarija|Koncept|Osnutek|Skica',
                    'then' => 'Takrat|Potem|Nato',
                    'when' => 'Kadar|Ko|Ce|Če',
                ),
            'sr-Cyrl' =>
                array (
                    'and' => '*|И',
                    'background' => 'Контекст|Позадина|Основа',
                    'but' => 'Али|*',
                    'examples' => 'Сценарији|Примери',
                    'feature' => 'Функционалност|Могућност|Особина',
                    'given' => 'За дате|За дато|За дати|*',
                    'name' => 'Serbian',
                    'native' => 'Српски',
                    'scenario' => 'Сценарио|Пример',
                    'scenario_outline' => 'Структура сценарија|Концепт|Скица',
                    'then' => 'Онда|*',
                    'when' => 'Када|Кад|*',
                ),
            'sr-Latn' =>
                array (
                    'and' => '*|I',
                    'background' => 'Kontekst|Pozadina|Osnova',
                    'but' => 'Ali|*',
                    'examples' => 'Scenariji|Primeri',
                    'feature' => 'Funkcionalnost|Mogućnost|Mogucnost|Osobina',
                    'given' => 'Za date|Za dato|Za dati|*',
                    'name' => 'Serbian (Latin)',
                    'native' => 'Srpski (Latinica)',
                    'scenario' => 'Scenario|Primer',
                    'scenario_outline' => 'Struktura scenarija|Koncept|Skica',
                    'then' => 'Onda|*',
                    'when' => 'Kada|Kad|*',
                ),
            'sv' =>
                array (
                    'and' => 'Och|*',
                    'background' => 'Bakgrund',
                    'but' => 'Men|*',
                    'examples' => 'Exempel',
                    'feature' => 'Egenskap',
                    'given' => 'Givet|*',
                    'name' => 'Swedish',
                    'native' => 'Svenska',
                    'scenario' => 'Scenario',
                    'scenario_outline' => 'Abstrakt Scenario|Scenariomall',
                    'then' => 'Så|*',
                    'when' => 'När|*',
                ),
            'ta' =>
                array (
                    'and' => 'மற்றும்|மேலும்|*',
                    'background' => 'பின்னணி',
                    'but' => 'ஆனால்|*',
                    'examples' => 'எடுத்துக்காட்டுகள்| நிலைமைகளில்|காட்சிகள்',
                    'feature' => 'வணிக தேவை|அம்சம்|திறன்',
                    'given' => 'கொடுக்கப்பட்ட|*',
                    'name' => 'Tamil',
                    'native' => 'தமிழ்',
                    'scenario' => 'காட்சி',
                    'scenario_outline' => 'காட்சி வார்ப்புரு|காட்சி சுருக்கம்',
                    'then' => 'அப்பொழுது|*',
                    'when' => 'எப்போது|*',
                ),
            'th' =>
                array (
                    'and' => 'และ|*',
                    'background' => 'แนวคิด',
                    'but' => 'แต่|*',
                    'examples' => 'ชุดของเหตุการณ์|ชุดของตัวอย่าง',
                    'feature' => 'ความต้องการทางธุรกิจ|ความสามารถ|โครงหลัก',
                    'given' => 'กำหนดให้|*',
                    'name' => 'Thai',
                    'native' => 'ไทย',
                    'scenario' => 'เหตุการณ์',
                    'scenario_outline' => 'โครงสร้างของเหตุการณ์|สรุปเหตุการณ์',
                    'then' => 'ดังนั้น|*',
                    'when' => 'เมื่อ|*',
                ),
            'tl' =>
                array (
                    'and' => 'మరియు|*',
                    'background' => 'నేపథ్యం',
                    'but' => 'కాని|*',
                    'examples' => 'ఉదాహరణలు',
                    'feature' => 'గుణము',
                    'given' => 'చెప్పబడినది|*',
                    'name' => 'Telugu',
                    'native' => 'తెలుగు',
                    'scenario' => 'సన్నివేశం',
                    'scenario_outline' => 'కథనం',
                    'then' => 'అప్పుడు|*',
                    'when' => 'ఈ పరిస్థితిలో|*',
                ),
            'tlh' =>
                array (
                    'and' => 'latlh|\'ej|*',
                    'background' => 'mo\'',
                    'but' => '\'ach|\'a|*',
                    'examples' => 'ghantoH|lutmey',
                    'feature' => 'poQbogh malja\'|Qu\'meH \'ut|perbogh|Qap|laH',
                    'given' => 'DaH ghu\' bejlu\'|ghu\' noblu\'|*',
                    'name' => 'Klingon',
                    'native' => 'tlhIngan',
                    'scenario' => 'lut',
                    'scenario_outline' => 'lut chovnatlh',
                    'then' => 'vaj|*',
                    'when' => 'qaSDI\'|*',
                ),
            'tr' =>
                array (
                    'and' => 'Ve|*',
                    'background' => 'Geçmiş',
                    'but' => 'Fakat|Ama|*',
                    'examples' => 'Örnekler',
                    'feature' => 'Özellik',
                    'given' => 'Diyelim ki|*',
                    'name' => 'Turkish',
                    'native' => 'Türkçe',
                    'scenario' => 'Senaryo',
                    'scenario_outline' => 'Senaryo taslağı',
                    'then' => 'O zaman|*',
                    'when' => 'Eğer ki|*',
                ),
            'tt' =>
                array (
                    'and' => 'Һәм|Вә|*',
                    'background' => 'Кереш',
                    'but' => 'Ләкин|Әмма|*',
                    'examples' => 'Үрнәкләр|Мисаллар',
                    'feature' => 'Үзенчәлеклелек|Мөмкинлек',
                    'given' => 'Әйтик|*',
                    'name' => 'Tatar',
                    'native' => 'Татарча',
                    'scenario' => 'Сценарий',
                    'scenario_outline' => 'Сценарийның төзелеше',
                    'then' => 'Нәтиҗәдә|*',
                    'when' => 'Әгәр|*',
                ),
            'uk' =>
                array (
                    'and' => 'А також|Та|*|І',
                    'background' => 'Передумова',
                    'but' => 'Але|*',
                    'examples' => 'Приклади',
                    'feature' => 'Функціонал',
                    'given' => 'Припустимо, що|Припустимо|Нехай|Дано|*',
                    'name' => 'Ukrainian',
                    'native' => 'Українська',
                    'scenario' => 'Сценарій',
                    'scenario_outline' => 'Структура сценарію',
                    'then' => 'Тоді|То|*',
                    'when' => 'Коли|Якщо|*',
                ),
            'ur' =>
                array (
                    'and' => 'اور|*',
                    'background' => 'پس منظر',
                    'but' => 'لیکن|*',
                    'examples' => 'مثالیں',
                    'feature' => 'کاروبار کی ضرورت|صلاحیت|خصوصیت',
                    'given' => 'فرض کیا|بالفرض|اگر|*',
                    'name' => 'Urdu',
                    'native' => 'اردو',
                    'scenario' => 'منظرنامہ',
                    'scenario_outline' => 'منظر نامے کا خاکہ',
                    'then' => 'پھر|تب|*',
                    'when' => 'جب|*',
                ),
            'uz' =>
                array (
                    'and' => 'Ва|*',
                    'background' => 'Тарих',
                    'but' => 'Бирок|Лекин|Аммо|*',
                    'examples' => 'Мисоллар',
                    'feature' => 'Функционал',
                    'given' => 'Агар|*',
                    'name' => 'Uzbek',
                    'native' => 'Узбекча',
                    'scenario' => 'Сценарий',
                    'scenario_outline' => 'Сценарий структураси',
                    'then' => 'Унда|*',
                    'when' => 'Агар|*',
                ),
            'vi' =>
                array (
                    'and' => 'Và|*',
                    'background' => 'Bối cảnh',
                    'but' => 'Nhưng|*',
                    'examples' => 'Dữ liệu',
                    'feature' => 'Tính năng',
                    'given' => 'Biết|Cho|*',
                    'name' => 'Vietnamese',
                    'native' => 'Tiếng Việt',
                    'scenario' => 'Tình huống|Kịch bản',
                    'scenario_outline' => 'Khung tình huống|Khung kịch bản',
                    'then' => 'Thì|*',
                    'when' => 'Khi|*',
                ),
            'zh-CN' =>
                array (
                    'and' => '并且<|而且<|同时<|*',
                    'background' => '背景',
                    'but' => '但是<|*',
                    'examples' => '例子',
                    'feature' => '功能',
                    'given' => '假设<|假如<|假定<|*',
                    'name' => 'Chinese simplified',
                    'native' => '简体中文',
                    'scenario' => '场景|剧本',
                    'scenario_outline' => '场景大纲|剧本大纲',
                    'then' => '那么<|*',
                    'when' => '当<|*',
                ),
            'zh-TW' =>
                array (
                    'and' => '並且<|而且<|同時<|*',
                    'background' => '背景',
                    'but' => '但是<|*',
                    'examples' => '例子',
                    'feature' => '功能',
                    'given' => '假設<|假如<|假定<|*',
                    'name' => 'Chinese traditional',
                    'native' => '繁體中文',
                    'scenario' => '場景|劇本',
                    'scenario_outline' => '場景大綱|劇本大綱',
                    'then' => '那麼<|*',
                    'when' => '當<|*',
                ),
        );
    }

    public function createBehatParser(){
        $keywords = new ArrayKeywords($this->getKeywords());
        $lexer  = new Lexer($keywords);
        $parser = new Parser($lexer);
        return $parser;
    }

    public function getRelativePath($base, $path) {
        // Detect directory separator
        $resultPath = $path;
        $separator = substr($base, 0, 1);
        $base = array_slice(explode($separator, rtrim($base,$separator)),1);
        $path = array_slice(explode($separator, rtrim($path,$separator)),1);

        $result = implode($separator, array_slice($path, count($base)));
        if($result === ''){
            $result = $resultPath;
        }
        return $result;
    }
}
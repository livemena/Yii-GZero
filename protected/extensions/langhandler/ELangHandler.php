<?php
class ELangHandler extends CApplicationComponent {
    public $languages = array();
    public $strict = false;
    
    public function init() {
        array_push($this->languages, Yii::app()->getLanguage());
        $this->parseLanguage();
    }

    private function parseLanguage() {
        Yii::app()->urlManager->parseUrl(Yii::app()->getRequest());
        if(!isset($_GET['lang'])) {
            $defaultLang = Yii::app()->getRequest()->getPreferredLanguage();
            if(!$this->strict){
                $tmp = explode('_',$defaultLang);
                $defaultLang = $tmp[0];
            }
            if (in_array($defaultLang, $this->languages))
                Yii::app()->setLanguage($defaultLang);
            else
                Yii::app()->setLanguage($this->languages[0]);
        }elseif($_GET['lang']!=Yii::app()->getLanguage() && in_array($_GET['lang'],$this->languages)) {
            Yii::app()->setLanguage($_GET['lang']);
        }
    }
}
?>
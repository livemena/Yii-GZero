<?php
class ELangCUrlManager extends CUrlManager
{	
    public function createUrl($route,$params=array(),$ampersand='&')
    {
        if (!isset($params['lang']))
            $params['lang']=Yii::app()->GetLanguage();
        return parent::createUrl($route, $params, $ampersand);
    }
}
?>
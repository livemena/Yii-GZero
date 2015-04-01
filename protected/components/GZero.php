<?php

class GZero
{
	public static function langSwitcher($type='link',$htmlOptions=array())
	{
		$lang = Yii::app()->language;

		switch ($lang) {
			case 'en':
				$label = 'عربي';
				$_GET['lang'] = 'ar';
				break;
			case 'ar':
				$label = 'English';
				$_GET['lang'] = 'en';
				break;
		}
		
		$url = Yii::app()->getController()->createUrl(Yii::app()->getController()->id.'/'.Yii::app()->getController()->action->id,$_GET);
		
		switch ($type) {
			case 'link':
				return CHtml::link($label,$url,$htmlOptions);
				break;
			case 'menu':
				return array('label'=>$label,'url'=>$url,'linkOptions'=>$htmlOptions);
				break;
		}
	}
	
	public static function registerOpenGraph($option=array('site_name'=>null,'title'=>null,'description'=>null,'thumbnail'=>null,'url'=>null))
	{
		$cs = Yii::app()->clientScript;

		if($option['site_name'])
			$cs->registerMetaTag($option['site_name'],null,null,array('property'=>'og:site_name'));
		if($option['title'])
			$cs->registerMetaTag($option['title'],null,null,array('property'=>'og:title'));
		if($option['description'])
			$cs->registerMetaTag($option['description'],null,null,array('property'=>'og:description'));
		if($option['thumbnail'])
			$cs->registerMetaTag($option['thumbnail'],null,null,array('property'=>'og:thumbnail'));
		if($option['url'])
			$cs->registerMetaTag($option['url'],null,null,array('property'=>'og:url'));
	}
}
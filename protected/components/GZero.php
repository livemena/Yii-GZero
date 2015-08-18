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
	
	public static function registerOpenGraph(
		$option=array(
			'site_name'=>'MY CIIN',
			'title'=>'MY CIIN - Seen, Loved, Shared',
			'description'=>'Seen, Loved, Shared',
			'image'=>'http://myciin.com/images/ciin-thumb.png',
			'url'=>'http://www.myciin.com'
		))
	{
		
		$option=array_merge(array(
			'site_name'=>'Yii-GZero',
			'title'=>'Yii-GZero',
			'description'=>'Yii-GZero',
			'image'=>'image',
			'url'=>'image'
		),$option);
		
		$cs = Yii::app()->clientScript;

			$cs->registerMetaTag($option['site_name'],null,null,array('property'=>'og:site_name'));

			$cs->registerMetaTag($option['title'],null,null,array('property'=>'og:title'));

			$cs->registerMetaTag($option['description'],null,null,array('property'=>'og:description'));
	
			$cs->registerMetaTag($option['image'],null,null,array('property'=>'og:image'));

			$cs->registerMetaTag($option['url'],null,null,array('property'=>'og:url'));
	}
}
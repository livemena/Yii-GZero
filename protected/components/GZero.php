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
}
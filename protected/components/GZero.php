<?php

class GZero
{
	public static function langSwitcher($type='link',$htmlOptions=array())
	{
		$lang = Yii::app()->language;
		$label = 'عربي';
		$url = $this->createUrl($this->id.'/'.$this->action->id,array('lang'=>'ar'));

		if($lang=='ar'){
			$label = 'English';
			$url = $this->createUrl($this->id.'/'.$this->action->id,array('lang'=>'en'));
		}
		
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
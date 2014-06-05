<?php

class GZero
{
	public function langSwitcher($type='link',$htmlOptions=array())
	{
		$lang = Yii::app()->language;
		$label = 'عربي';
		$url = Yii::app()->getController()->createUrl($this->id.'/'.$this->action->id,array('lang'=>'ar'));

		if($lang=='ar'){
			$label = 'English';
			$url = Yii::app()->getController()->createUrl($this->id.'/'.$this->action->id,array('lang'=>'en'));
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
<?php

class AdminModule extends CWebModule
{
	public function init()
	{
		
		Yii::app()->language = 'en';
		Yii::app()->sourceLanguage = 'en';

		Yii::app()->setComponents(array(
			'errorHandler'=>array(
				'errorAction'=>'/admin/default/error'
			)
		));

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
			if(parent::beforeControllerAction($controller, $action))
			{
							if(!Yii::app()->user->checkAccess('admin'))
											throw new CHttpException(403,'You are not authorized to perform this action.');
							// this method is called before any module controller action is performed
							// you may place customized code here
							return true;
			}
			else
							return false;
	}
}

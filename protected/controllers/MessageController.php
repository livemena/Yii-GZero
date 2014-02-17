<?php

class MessageController extends Controller
{
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	public function accessRules()
	{
		return array(
			// array('allow',  // allow all users to perform 'index' and 'view' actions
				// 'actions'=>array('view'),
				// 'users'=>array('*'),
			// ),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','find'),
				'roles'=>array('admin'),
			),
		);
	}
	
	public function actionIndex()
	{
		$sMessage = new SourceMessage;
		$message = new Message;

		$this->render('index',array(
			'sMessage'=>$sMessage,
			'message'=>$message,
		));
	}

	public function actionFind($term=null)
	{
		$request=trim($term);
		
		if($request!=''){
		
			$model = Message::model()->with('source')->findAll(array("condition"=>"translation like '$request%'"));
			
			$source = $model;
			
			// die(var_dump($model));
			// $translate = $
			
			
			// $data=array();
			// foreach($model as $get){
				// $data[]=$get->translation;
			// }
			
			// $table = '';
			// foreach($model as $m){
				// echo $m->
			// }
			
			// header('Content-type: application/json');
			$this->layout='empty';
			// echo CJavaScript::jsonEncode($data);
			Yii::app()->end();
		}
	}
	/*
	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
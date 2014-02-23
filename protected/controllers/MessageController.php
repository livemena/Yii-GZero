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

	public function actionFind()
	{
		
		$request=trim($_POST['term']);
		
		if($request!=''){
		
			$model = SourceMessage::model()->with('messages')->findAll(array("condition"=>"message like '%$request%' OR messages.translation like '%$request%' "));
			
			if($model){
				$tbody = '';
				foreach($model as $src):
					$messages = SourceMessage::model()->findByAttributes(array('id'=>$src->id));
				
					$tbody .= '<tr>';
						$tbody .= '<td>'.$src->message.'</td>';
						$tbody .= '<td>';
						foreach($messages->messages as $translate):
							$tbody .= '<strong>'.$translate->language.'</strong><br>';
							$tbody .= $translate->translation;
							$tbody .= '<hr>';
						endforeach;
						$tbody .= '</td>';
						$tbody .= '<td><input type="text" class="autoselect form-control" value="Yii::t(\'app\',\''.$src->message.'\')" /></td>';
						$tbody .= '<td></td>';
					$tbody .= '</tr>';
				endforeach;
				
				$this->layout='empty';
					echo $tbody;
				Yii::app()->end();
			}else
				echo '';
		}else
			echo '';
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
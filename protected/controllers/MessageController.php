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
				'actions'=>array('index','find','delete'),
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
				
					$tbody .= '<tr id="'.$src->id.'" >';
						$tbody .= '<td>'.$src->message.'</td>';
						$tbody .= '<td>';
						foreach($messages->messages as $translate):
							$tbody .= '<div><label>'.$translate->language.'</label><br>';
							$tbody .= '<span class="trn">'.$translate->translation.'</span></div>';
							$tbody .= '<hr>';
						endforeach;
						$tbody .= '</td>';
						$tbody .= '<td><input type="text" class="autoselect form-control embed" value="Yii::t(\'app\',\''.$src->message.'\')" /></td>';
						$tbody .= '<td><a class="btn btn-xs btn-danger deleteBtn" title="Delete"><i class="fa fa-trash-o"></i></a></td>';
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
	
	public function actionCreate()
	{
		if(Yii::app()->request->isAjaxRequest && !empty($_POST['en']) || !empty($_POST['ar']))
		{
			$lastId = SourceMessage::model()->findAll(array('limit'=>1,'select'=>'max(id) as id','order'=>'id DESC'));
			$newId = intval($lastId[0]->id)+1;
			
			$msgKey = Text::teaser($_POST['en'],24,'');
			if(SourceMessage::model()->findByAttributes(array('message'=>$msgKey))){
				$msgKey = Text::teaser($_POST['en'],24,'').'_'.rand(10,100);
			}

			$source = new SourceMessage;
			$source->id = $newId;
			$source->message = $msgKey;
			if($source->save())
			{
				if($_POST['en'])
				{
					$msg = new Message;
					$msg->id = $source->id;
					$msg->language = 'en';
					$msg->translation = $_POST['en'];
					$msg->save();
				}
				if($_POST['ar'])
				{
					$msg = new Message;
					$msg->id = $source->id;
					$msg->language = 'ar';
					$msg->translation = $_POST['ar'];
					$msg->save();
				}
				
				echo $msgKey;
				Yii::app()->end();
			}else{
				return false;
			}
		} else
		return false;
	}
	
	public function actionDelete()
	{
		if(Yii::app()->request->isAjaxRequest)
		{
			$source = SourceMessage::model()->findByAttributes(array('id'=>$_POST['id']));
			if($source->delete()){
				return true;
				Yii::app()->end();
			}else{
				die('error');
			}
		}else{
			return false;
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
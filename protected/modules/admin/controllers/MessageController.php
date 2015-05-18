<?php

class MessageController extends Controller
{
	public $layout='/layouts/column2';

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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','find','update','create','delete'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		$sMessage = new TranslateSource;
		$message = new TranslateMessage;

		$this->render('index',array(
			'sMessage'=>$sMessage,
			'message'=>$message,
		));
	}

	public function actionFind()
	{
		
		$request=trim($_POST['term']);
		
		if($request!=''){
		
			$model = TranslateSource::model()->with('messages')->findAll(array("condition"=>"message like '%$request%' OR messages.translation like '%$request%' "));
			
			if($model){
				$tbody = '';
				$i = 1;
				foreach($model as $src):
					$messages = TranslateSource::model()->findByAttributes(array('id'=>$src->id));
				
					$tbody .= '<tr id="'.$src->id.'" >';
						$tbody .= '<td>'.$src->message.'</td>';
						$tbody .= '<td>';
						foreach($messages->messages as $translate):
							$tbody .= '<div><label>'.$translate->language.'</label><br>';
							$tbody .= '<span class="trn '.$translate->language.'">'.$translate->translation.'</span></div>';
							$tbody .= '<hr>';
						endforeach;
						$tbody .= '</td>';
						$tbody .= '<td><input type="text" class="autoselect form-control embed" value="Yii::t(\'app\',\''.$src->message.'\')" /></td>';
						$tbody .= '<td><a class="btn btn-xs btn-default editBtn" title="Edit" type="button" data-toggle="modal" data-target="#updateTest" href="'.$this->createUrl('message/update',array('id'=>$src->id)).'"><i class="fa fa-pencil-square-o"></i></a>';
						$tbody .= '<a class="btn btn-xs btn-danger deleteBtn" title="Delete"><i class="fa fa-trash-o"></i></a>';
						$tbody .= '<div tabindex="-'.$i++.'" class="model" id="update-'.$src->id.'"></div></td></tr>';
				endforeach;
				
				$this->layout='empty';
					echo $tbody;
				Yii::app()->end();
			}else
				echo '';
		}else
			echo '';
	}
	
	public function actionUpdate($id)
	{
		$this->layout = false;
	
		$source = TranslateSource::model()->findByPk($id);
		$msgEn = new TranslateMessage;
		$msgAr = new TranslateMessage;
	
		if(Yii::app()->request->isPostRequest){

			if(isset($_POST['msgEn'])){
				$translateEn = TranslateMessage::model()->findByAttributes(array('id'=>$id,'language'=>'en'));
				if($translateEn){
					$translateEn->translation = $_POST['msgEn'];
					$translateEn->language = 'en';
					$translateEn->save();
				}else{
					$translateEn = new TranslateMessage;
					$translateEn->id = $id;
					$translateEn->language = 'en';
					$translateEn->translation= $_POST['msgEn'];
					$translateEn->save();
				}
			}
			
			if(isset($_POST['msgAr'])){
				$translateAr = TranslateMessage::model()->findByAttributes(array('id'=>$id,'language'=>'ar'));
				if($translateAr){
					$translateAr->translation = $_POST['msgAr'];
					$translateAr->language = 'ar';
					$translateAr->save();
				}else{
					$translateAr = new TranslateMessage;
					$translateAr->id = $id;
					$translateAr->language = 'ar';
					$translateAr->translation = $_POST['msgAr'];
					$translateAr->save();
				}
			}
			return true;
			Yii::app()->end();
			
		} else {

			if(TranslateMessage::model()->findByAttributes(array('id'=>$id,'language'=>'en'))){
				$msgEn = TranslateMessage::model()->findByAttributes(array('id'=>$id,'language'=>'en'));
			}
			if(TranslateMessage::model()->findByAttributes(array('id'=>$id,'language'=>'ar'))){
				$msgAr = TranslateMessage::model()->findByAttributes(array('id'=>$id,'language'=>'ar'));
			}

			$this->render('update',array(
				'source'=>$source,
				'msgEn'=>$msgEn,
				'msgAr'=>$msgAr,
			));
		
		}
	}

	
	public function actionCreate()
	{
		if(Yii::app()->request->isAjaxRequest && !empty($_POST['en']) || !empty($_POST['ar']))
		{
			$lastId = TranslateSource::model()->findAll(array('limit'=>1,'select'=>'max(id) as id','order'=>'id DESC'));
			$newId = intval($lastId[0]->id)+1;

			
			if($_POST['key'])
			{
				$msgKey = $_POST['key'];
				if(TranslateSource::model()->findByAttributes(array('message'=>$msgKey))){
					header("HTTP/1.0 400 Please try another key");
					Yii::app()->end();
				}
			}
			else 
			{
				$msgKey = Text::slug(Text::teaser(strtolower($_POST['en']),24,''));
				if(TranslateSource::model()->findByAttributes(array('message'=>$msgKey))){
					$msgKey = Text::slug(Text::teaser(strtolower($_POST['en']),24,'').'_'.rand(10,100));
				}
			}
			
			$source = new TranslateSource;
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
			$source = TranslateSource::model()->findByAttributes(array('id'=>$_POST['id']));
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
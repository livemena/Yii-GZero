<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('login','register','forgotPassword'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('logout'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin($service=null)
	{
		if(isset($service)){
			Yii::app()->user->authenticate($service);
			Yii::app()->end;
		}
	
		$model=new User;
		$model->setScenario('login');

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->password = md5($model->password);
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	public function actionRegister()
	{
		$model=new User;
		$model->setScenario('register');

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$pass = $model->password;
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->save())
			{
				// $login = new User;
				// $login->email = $model->email;
				// $login->password = $model->password;
				$model->password = $model->password;
				$model->login();
				
				$this->redirect('index');
			}else{
				$model->getErrors();
			}
		}
		// display the login form
		$this->render('register',array('model'=>$model));
	}
	
	public function actionForgotPassword()
	{
		$model=new User;
		$model->setScenario('forgotPassword');

		// collect user input data
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			
			if($model->validate())
			{
				$user = User::model()->findByAttributes(array('email'=>$_POST['User']['email']));
				
				if($user){
					$user->key = md5(rand(10, 9999));
					if($user->save()){
						SimpleMailer::send(
							$user->email,
							'forgot_password',
							array('
								__name__'=>$user->name,
								'__url__'=>$this->createAbsoluteUrl('user/resetPassword',array('key'=>$user->key)))
						);
						Yii::app()->user->setFlash('success','email sent.');
					}else{
						Yii::app()->user->setFlash('error','try agian.');
					}				
				}else{
					Yii::app()->user->setFlash('danger','no email register now');
				}
			}else{
				$model->getErrors();
			}
		}
		// display the login form
		$this->render('forgot_password',array('model'=>$model));
	}
	
	public function actionResetPassword($key=null)
	{
		if($key){
			$model = User::model()->findByAttributes(array('key'=>$key));
			
			if($model){
				$model->setScenario('resetPassword');

				// collect user input data
				if(isset($_POST['User']))
				{
					$model->attributes=$_POST['User'];
					
					if($model->save())
					{
						Yii::app()->user->setFlash('success','Your password has been changed!');
						$this->redirect('user/login');
					}else{
						$model->getErrors();
					}
				}
				// display the login form
				$this->render('forgot_password',array('model'=>$model));
			}
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

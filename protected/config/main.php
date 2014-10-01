<?php
// uncomment the following to define a path alias
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return CMap::mergeArray(
	array(
		'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
		'name'=>'Yii-GZero',
		'language'=>'en',
		'sourceLanguage'=>'en',
		
		// mobile detector
		'onBeginRequest'=>array('Mobile', 'BeginRequest'),

		// preloading 'log' component
		'preload'=>array('log','ELangHandler'),

		// autoloading model and component classes
		'import'=>array(
			'application.models.*',
			'application.components.*',
			'application.components.twitter.*',
			'application.commands.*',
			'application.extensions.redactor.ImperaviRedactorWidget',
		),
		
		'modules' => array(

		),

		// application components
		'components'=>array(
		
			'user'=>array(
				// enable cookie-based authentication
				'allowAutoLogin'=>true,
				'class' => 'WebUser',
			),
			
			'messages'=>array(
				'class'=>'CDbMessageSource',
				'forceTranslation'=>true,
				'sourceMessageTable' => 'gz_source_message',
				'translatedMessageTable' => 'gz_message',
			),
			
			'authManager'=>array(
				'class'=>'CDbAuthManager',
				'assignmentTable'=>'gz_authassignment',
				'itemChildTable'=>'gz_authitemchild',
				'itemTable'=>'gz_authitem',
			),
			
			'urlManager'=>array(
				'urlFormat'=>'path',
				'showScriptName'=>false,
				'class'=>'application.extensions.langhandler.ELangCUrlManager',
				'caseSensitive'=>false,
				'rules'=>array(
					// Custom 
					
					// GZero
					'<lang:(ar|en)>/<_c>/<_a>/' => '<_c>/<_a>',
					'<lang:(ar|en)>/login'=>'user/login',
					'<lang:(ar|en)>/admin'=>'page/admin',
					'gii'=>'/gii',
					'page/<slug:\w+>'=>'page/view',
					'/message/update/<id:\d+>'=>'message/update',
					'<controller:\w+>/<id:\d+>'=>'<controller>/view',
					'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
					'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				),
			),

			// Local database connection
			'db'=>array(
				'connectionString' => 'mysql:host=localhost;dbname=gzero',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
				'tablePrefix' => 'gz_',
			),

			// Language handler
			'ELangHandler' => array (
				'class' => 'ext.langhandler.ELangHandler',
				'languages' => array('en','ar'),
				'strict' => true,
			),
			
     'clientScript' => array(
       'class' => 'ext.yii-EClientScript.EClientScript',
       'combineScriptFiles' => !YII_DEBUG, // By default this is set to true, set this to true if you'd like to combine the script files
       'combineCssFiles' => !YII_DEBUG, // By default this is set to true, set this to true if you'd like to combine the css files
       'optimizeScriptFiles' => !YII_DEBUG,	// @since: 1.1
       'optimizeCssFiles' => !YII_DEBUG, // @since: 1.1
       'optimizeInlineScript' => false, // @since: 1.6, This may case response slower
       'optimizeInlineCss' => false, // @since: 1.6, This may case response slower
     ),

			'errorHandler'=>array(
				// use 'site/error' action to display errors
				'errorAction'=>'site/error',
			)
		),

		// application-level parameters that can be accessed
		// using Yii::app()->params['paramName']
		'params'=>array(
			// this is used in contact page
			'adminEmail'=>'admin@admin.com',
			'facebook'=>array(
				'client_id'=>'417810991650867',
				'client_secret'=>'a5c2d4310e86f5caf29fcd3caf6bfb17' , 
				'redirect_url'=>'/user/login?id=facebook',
				//'key'=>'',
				'scope'=>'email,user_about_me'
			),
			'twitter'=>array(
				'CONSUMER_KEY' => 'wRiylVHT6dBb2RGM97h5pg',
				'CONSUMER_SECRET'=> '29MVfKRj6BxgQrf3PBwLxXForf05IhOw0DRy3csI' ,
				'OAUTH_CALLBACK' => '/user/login?id=twitter'
			),
			'google'=>array(
				'client_id'=>'459370235194.apps.googleusercontent.com',
				'client_secret'=>'ToG6js5zLZPdMyEA2xahpRv8' , 
				'redirect_url'=>'/user/login?id=google',
				'key'=>'AIzaSyBz41c0ynlDj9wlxUPswyGs43YQLCLMSrQ',
				'scope'=>'https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile'
			),
		),
	),
	require(dirname(__FILE__).'/local.php')
);
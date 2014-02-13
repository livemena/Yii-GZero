<?php
// uncomment the following to define a path alias
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return CMap::mergeArray(
	array(
		'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
		'name'=>'Yii Grand-Zero Application',
		'language'=>'en',
		
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
			'application.modules.SimpleMailer.components.*',
			'application.modules.SimpleMailer.models.*',
		),
		
		'modules' => array(
			'SimpleMailer' => array(
				'attachImages' => true, // This is the default value, for attaching the images used into the emails.
				'sendEmailLimit'=> 500, // Also the default value, how much emails should be sent when calling yiic mailer
			),
		),

		// application components
		'components'=>array(
		
			'user'=>array(
				// enable cookie-based authentication
				'allowAutoLogin'=>true,
				'class' => 'WebUser',
			),
			
			'authManager'=>array(
				'class'=>'CDbAuthManager',
			),
			
			'urlManager'=>array(
				'urlFormat'=>'path',
				'showScriptName'=>false,
				// 'caseSensitive'=>false,
				'rules'=>array(
					'/p/<slug:\w+>'=>'page/view',
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
			),

			// Language handler
			'ELangHandler' => array (
				'class' => 'ext.langhandler.ELangHandler',
				'languages' => array('en','ar'),
				'strict' => true,
			),
			// Scripts & CSS optimzation is on
			'clientScript' => array(
			  'class' => 'ext.minify.EClientScript',
				  'combineScriptFiles' => true, // By default this is set to false, set this to true if you'd like to combine the script files
				  'combineCssFiles' => true, // By default this is set to false, set this to true if you'd like to combine the css files
				  'optimizeScriptFiles' => true,	// @since: 1.1
				  'optimizeCssFiles' => true,	// @since: 1.1
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
				'redirect_url'=>'/site/login?id=facebook',
				//'key'=>'',
				'scope'=>'email,user_about_me'
			),
			'twitter'=>array(
				'CONSUMER_KEY' => 'wRiylVHT6dBb2RGM97h5pg',
				'CONSUMER_SECRET'=> '29MVfKRj6BxgQrf3PBwLxXForf05IhOw0DRy3csI' ,
				'OAUTH_CALLBACK' => '/site/login?id=twitter'
			),
			'google'=>array(
				'client_id'=>'459370235194.apps.googleusercontent.com',
				'client_secret'=>'ToG6js5zLZPdMyEA2xahpRv8' , 
				'redirect_url'=>'/site/login?id=google',
				'key'=>'AIzaSyBz41c0ynlDj9wlxUPswyGs43YQLCLMSrQ',
				'scope'=>'https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile'
			),
		),
	),
	require(dirname(__FILE__).'/local.php')
);
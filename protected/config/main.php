<?php
// uncomment the following to define a path alias
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return CMap::mergeArray(
	array(
		'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
		'name'=>'Yii Grand-Zero Application',
		'language'=>'en',
		'theme'=>'bootstrap',
		
		// mobile detector
		'onBeginRequest'=>array('Mobile', 'BeginRequest'),

		// preloading 'log' component
		'preload'=>array('log','ELangHandler'),

		// autoloading model and component classes
		'import'=>array(
			'application.models.*',
			'application.components.*',
			'application.commands.*',
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
				'defaultRoles'=>array('guest'),
			),
			
			'urlManager'=>array(
				'urlFormat'=>'path',
				'showScriptName'=>false,
				'caseSensitive'=>false,
				'rules'=>array(
					'<controller:\w+>/<id:\d+>'=>'<controller>/view',
					'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
					'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				),
			),

			'db'=>array(
				'connectionString' => 'mysql:host=localhost;dbname=testdrive',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
				'schemaCachingDuration' => 3600,
			),
			
			// Bootstrap
			'bootstrap'=>array(
				'class'=>'bootstrap.components.Bootstrap',
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
			),
			'log'=>array(
				'class'=>'CLogRouter',
				'routes'=>array(
					array(
						'class'=>'CFileLogRoute',
						'levels'=>'error, warning',
					),
				),
			),
		),

		// application-level parameters that can be accessed
		// using Yii::app()->params['paramName']
		'params'=>array(
			// this is used in contact page
			'googleAnalyticsId'=>'',
			'adminEmail'=>'admin@admin.com',
		),
	),
	require(dirname(__FILE__).'/local.php')
);
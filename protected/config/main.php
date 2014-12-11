<?php
// uncomment the following to define a path alias
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$params = require(__DIR__ . '/params.php');

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
			'widgetFactory'=>array(
				'widgets'=>array(
					'CLinkPager'=>array(
						'header' => '<div class="pagination">',
						'footer' => '</div>',
						'cssFile' => false,
						'selectedPageCssClass' => 'active',
						'hiddenPageCssClass' => 'disabled',
						'htmlOptions'=>array('class'=>'pagination'),
					),
				),
			),
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
		'params'=>$params,
	),
	require(dirname(__FILE__).'/local.php')
);
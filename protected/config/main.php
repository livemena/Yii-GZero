<?php
$db = require(__DIR__ . '/db.php');
$params = require(__DIR__ . '/params.php');

// uncomment the following to define a path alias
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Yii-GZero',
	'timeZone' => 'Asia/Amman',
	'language'=>'en',
	'sourceLanguage'=>'en',
	
	// mobile detector
	// 'onBeginRequest'=>array('Mobile', 'BeginRequest'),

	// preloading 'log' component
	'preload'=>array('log','ELangHandler'),

	// autoloading model and component classes
	'import'=>array(
		'application.commands.*',
		'application.components.*',
		'application.components.HttpClient',
		'application.models.*',
		'application.helpers.*',
		'ext.redactor.ImperaviRedactorWidget',
	),
	
	'modules'=>array(
		'admin',
		// Gii is enabled locally
		'gii'=>array(
			'class'=>'application.modules.GiiGZero.GiiModule',
			'generatorPaths'=>array(
				'application.modules.GiiGZero.templates',
			),
			'password'=>'123456',
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
	
		'db'=>$db,
	
		/* bootstrap classes */
		'widgetFactory'=>array(
			'widgets'=>array(
				'CListView'=>array(
					'pagerCssClass'=>'pager-wrapper text-center ltr',
				),
				'CLinkPager'=>array(
					'header' => '<div class="pagination">',
					'footer' => '</div>',
					'cssFile' => false,
					'selectedPageCssClass' => 'active',
					'hiddenPageCssClass' => 'disabled',
					'htmlOptions'=>array('class'=>'pagination'),
				),
				'CGridView' => array(
					'htmlOptions' => array(
							'class' => 'table-responsive'
					),
					'pagerCssClass' => 'pager-wrapper',
					'itemsCssClass' => 'table table-striped table-hover',
					'cssFile' => false,
					'summaryCssClass' => '',
					'summaryText' => 'Showing {start} to {end} of {count} entries',
				),
			),
		),

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'WebUser',
		),
		
		'messages'=>array(
			// 'class'=>'CDbMessageSource',
			'forceTranslation'=>true,
			// 'sourceMessageTable' => 'translate_source',
			// 'translatedMessageTable' => 'translate_message',
		),
		
		'authManager'=>array(
			'class'=>'CDbAuthManager',
			'assignmentTable'=>'authassignment',
			'itemChildTable'=>'authitemchild',
			'itemTable'=>'authitem',
		),
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'class'=>'application.extensions.langhandler.ELangCUrlManager',
			'caseSensitive'=>false,
			'rules'=>array(
				// Custom 
				
				// GZero
				'<lang:(ar|en)>/' => 'site/index',
				'<lang:(ar|en)>/<_c>/<_a>/' => '<_c>/<_a>',
				'<lang:(ar|en)>/login'=>'user/login',
				'<lang:(ar|en)>/admin'=>'page/admin',
				'<lang:(ar|en)>/gii'=>'/gii',
				'<lang:(ar|en)>page/<slug:\w+>'=>'page/view',
				'<lang:(ar|en)>/message/update/<id:\d+>'=>'message/update',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				
				'<lang:(ar|en)>/admin/<controller:\w+>/<id:\d+>'=>'admin/<controller>/view',
				'<lang:(ar|en)>/admin/<controller:\w+>/<action:\w+>/<id:\d+>'=>'admin/<controller>/<action>',
				'<lang:(ar|en)>/admin/<controller:\w+>/<action:\w+>'=>'admin/<controller>/<action>',
			),
		),

		// Language handler
		'ELangHandler' => array (
			'class' => 'ext.langhandler.ELangHandler',
			'languages' => array('en','ar'),
			'strict' => true,
		),
		
	 // 'clientScript' => array(
		 // 'class' => 'ext.yii-EClientScript.EClientScript',
		 // 'combineScriptFiles' => !YII_DEBUG, // By default this is set to true, set this to true if you'd like to combine the script files
		 // 'combineCssFiles' => !YII_DEBUG, // By default this is set to true, set this to true if you'd like to combine the css files
		 // 'optimizeScriptFiles' => !YII_DEBUG,	// @since: 1.1
		 // 'optimizeCssFiles' => !YII_DEBUG, // @since: 1.1
		 // 'optimizeInlineScript' => false, // @since: 1.6, This may case response slower
		 // 'optimizeInlineCss' => false, // @since: 1.6, This may case response slower
	 // ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		)
	),
	'params'=>$params,
);
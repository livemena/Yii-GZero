<?php
$db = require(__DIR__ . '/db.php');
$params = require(__DIR__ . '/params.php');

// uncomment the following to define a path alias
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
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
			'application.commands.*',
			'application.components.*',
			'application.components.facebook.*',
			'application.components.twitter.*',
			'application.models.*',
			'application.helpers.*',
			'ext.redactor.ImperaviRedactorWidget',
			'ext.giix-components.*', // giix components
			'ext.image.*', // giix components
			// 'ext.yii-facebook-opengraph.*',
		),
		
		'modules'=>array(
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
    
      /* bootstrap classes */
			'widgetFactory'=>array(
				'widgets'=>array(
					'CListView'=>array(
            'pagerCssClass'=>'pager-wrapper',
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
			
			'image'=>array(
					'class'=>'ext.image.CImageComponent',
					// GD or ImageMagick
					'driver'=>'GD',
					// ImageMagick setup path
					// 'params'=>array('directory'=>'...'),
			),
			
			'facebook'=>array(
        'class' => '\YiiFacebook\SFacebook',
        'appId'=>'1580261192206957', // needed for JS SDK, Social Plugins and PHP SDK
        'secret'=>'1e8a3aecf5e66f9cb10f2469d745f395', // needed for the PHP SDK
        //'version'=>'v2.2', // Facebook APi version to default to
        //'locale'=>'en_US', // override locale setting (defaults to en_US)
        //'jsSdk'=>true, // include JavaScript SDK on all pages
        //'async'=>true, // load JavaScript SDK asynchronously
        //'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
        //'callbackScripts'=>'', // default JS SDK init callback JavaScript
        //'status'=>false, // JS SDK - check login status
        //'cookie'=>false, // JS SDK - enable cookies to allow the server to access the session
        //'xfbml'=>false,  // JS SDK - parse XFBML / html5 Social Plugins
        //'frictionlessRequests'=>false, // JS SDK - enable frictionless requests for request dialogs
        //'hideFlashCallback'=>null, // JS SDK - A function that is called whenever it is necessary to hide Adobe Flash objects on a page.
        //'html5'=>true,  // use html5 Social Plugins instead of older XFBML
        //'defaultScope'=>array(), // default Facebook Login permissions to request with Login button
        //'redirectUrl'=>null, // default Facebook post-Login redirect URL
        //'expiredSessionCallback'=>null, // PHP callable method to run if expired Facebook session is detected
        //'userFbidAttribute'=>null, // if using FBAuthRequest, declare Facebook ID attribute on user model here
        //'accountLinkUrl'=>null, // if using FBAuthRequest, declare link to user account page here
        //'ogTags'=>array(  // set default OG tags
            //'og:title'=>'MY_WEBSITE_NAME',
            //'og:description'=>'MY_WEBSITE_DESCRIPTION',
            //'og:image'=>'URL_TO_WEBSITE_LOGO',
        //),
			),
			
			'db'=>$db,
			
			'user'=>array(
				// enable cookie-based authentication
				'allowAutoLogin'=>true,
				'class' => 'WebUser',
			),
			
			'messages'=>array(
				'class'=>'CDbMessageSource',
				'forceTranslation'=>true,
				'sourceMessageTable' => 'message_source',
				'translatedMessageTable' => 'message',
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
				),
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
);
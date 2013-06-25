<?php
return array(

	'modules'=>array(
		// Gii is enabled locally
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1234',
			'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths'=>array(
                'bootstrap.gii',
            ),
		),
	),

	'components'=>array(

		// Local database connection
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=gzero',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),

		// Scripts & CSS optimzation is off
		'clientScript' => array(
		  'class' => 'ext.minify.EClientScript',
			  'combineScriptFiles' => false, // By default this is set to false, set this to true if you'd like to combine the script files
			  'combineCssFiles' => false, // By default this is set to false, set this to true if you'd like to combine the css files
			  'optimizeScriptFiles' => false,	// @since: 1.1
			  'optimizeCssFiles' => false,	// @since: 1.1
		),

		// enabel yii debug toolbar
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CWebLogRoute',
				),
				array(
					'class' => 'CWebLogRoute',
					'enabled' =>true ,
					'categories' => 'system.db.*',
					'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
				),
			),
		),
	),
	
);
<?php
$db = require(__DIR__ . '/db.php');

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'GZero Console',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(
		// uncomment the following to use a MySQL database
		'db'=>$db,
		
		'commandMap'=>array(
			'migrate'=>array(
				'class'=>'system.cli.commands.MigrateCommand',
				'migrationPath'=>'application.migrations',
				'migrationTable'=>'migration',
				'connectionID'=>'db',
				'templateFile'=>'application.migrations.template',
			),
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
);
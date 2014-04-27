<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	'import' => array(
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
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=gzero',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'gz_',
		),
		
		'commandMap'=>array(
			'migrate'=>array(
				'class'=>'system.cli.commands.MigrateCommand',
				'migrationPath'=>'application.migrations',
				'migrationTable'=>'gz_migration',
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
<?php
$db = require(__DIR__ . '/db.php');

return array(

	'modules'=>array(
		// Gii is enabled locally
		'gii'=>array(
			'class'=>'application.modules.GiiGZero.GiiModule',
			'generatorPaths'=>array(
        'application.modules.GiiGZero.templates', // a path alias
      ),
			'password'=>'123456',
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	'components'=>array(
    // Local database connection
    'db'=>$db,
	),
	
);
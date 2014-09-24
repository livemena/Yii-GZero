<?php
return array(

	'modules'=>array(
		// Gii is enabled locally
		'gii'=>array(
			'class'=>'application.modules.GiiGZero.GiiModule',
			'password'=>'123456',
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array(
                'application.modules.GiiGZero.templates', // a path alias
            ),
		),
	),

	'components'=>array(

	),
	
);
<?php
// DB Connection
return CMap::mergeArray(
	array(
		'connectionString' => 'mysql:host=localhost;dbname=gzero',
		'emulatePrepare' => true,
		'username' => 'root',
		'password' => '',
		'charset' => 'utf8',
	),
	require(dirname(__FILE__).'/db_local.php')
);
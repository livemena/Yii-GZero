<?php
// application-level parameters that can be accessed
// using Yii::app()->params['paramName']
		
return array(
	// this is used in contact page
	'adminEmail'=>'admin@admin.com',
	'facebook'=>array(
		'client_id'=>'1580261192206957',
		'client_secret'=>'1e8a3aecf5e66f9cb10f2469d745f395' , 
		'redirect_url'=>'/user/login?service=facebook',
		'scope'=>'email'
	),
	'twitter'=>array(
		'CONSUMER_KEY' => 'wRiylVHT6dBb2RGM97h5pg',
		'CONSUMER_SECRET'=> '29MVfKRj6BxgQrf3PBwLxXForf05IhOw0DRy3csI' ,
		'OAUTH_CALLBACK' => '/user/login?id=twitter'
	),
	'google'=>array(
		'client_id'=>'459370235194.apps.googleusercontent.com',
		'client_secret'=>'ToG6js5zLZPdMyEA2xahpRv8' , 
		'redirect_url'=>'/user/login?id=google',
		'key'=>'AIzaSyBz41c0ynlDj9wlxUPswyGs43YQLCLMSrQ',
		'scope'=>'https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile'
	),
);
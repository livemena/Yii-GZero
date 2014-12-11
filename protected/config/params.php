<?php
// application-level parameters that can be accessed
// using Yii::app()->params['paramName']
		
return array(
	// this is used in contact page
	'adminEmail'=>'admin@admin.com',
	'facebook'=>array(
		'client_id'=>'417810991650867',
		'client_secret'=>'a5c2d4310e86f5caf29fcd3caf6bfb17' , 
		'redirect_url'=>'/user/login?id=facebook',
		//'key'=>'',
		'scope'=>'email,user_about_me'
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
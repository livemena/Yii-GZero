<?php

// TODO

class WebUser extends CWebUser 
{
	private $_model;
	public $_id;

	public function __get($name)
	{
			if ($this->hasState('__userInfo')) {
					$user=$this->getState('__userInfo',array());
					if (isset($user[$name])) {
							return $user[$name];
					}
			}

			return parent::__get($name);
	}

	public function login($identity, $duration) {
			$this->setState('__userInfo', $identity->getUser());
			parent::login($identity, $duration);
	}
	
	function getModel(){
		return $this->loadUser(Yii::app()->user->id);
	}
	
	function isAdmin(){
		if(Yii::app()->user->checkAccess('admin')){
			return true;
		}else{
			return false;
		}
	}

	public function authenticate($id)
	{
		$access_token = null;
		$use = null;
		$isNewUser  = null;
		
		if($id=='facebook'){
			if(!isset(Yii::app()->session['access_token']))
				$facebook_info = $this->storeAccesstocken('facebook');
				
				$facebook_info = $this->getUserInfo('https://graph.facebook.com/me' ,'access_token='.Yii::app()->session['access_token' ]);
				$user = User::model()->find("facebook_id =?" , array( $facebook_info->id) );
			
				print '<pre>' . print_r($facebook_info,1) . '</pre>';
				die();

			$isNewUser = false;
			if(!isset($user)){
				$isNewUser = true;
				// $userPhoto = file_get_contents('https://graph.facebook.com/'.$facebook_info->id.'/picture?type=large');
				// $images_path = realpath(Yii::app()->basePath . '/../images/user/');
				// file_put_contents($images_path.'/'.$facebook_info->id.'.jpg',$userPhoto);
				
				$user = new User();
				$user->facebook_id  = $facebook_info->id;
				$user->first_name = $facebook_info->first_name;
				$user->last_name = $facebook_info->last_name;
				if($facebook_info->gender == 'male'){
					$user->gender = '0';
					}else{
					$user->gender = '1';
				}
				// $user->photo_uri = $facebook_info->id.'.jpg';
				$user->email = $facebook_info->email;
				$user->country_id = 202;
				// if($facebook_info->location->name){
					// $locations = explode( ',', str_replace(' ', '', $facebook_info->location->name) );
					// $criteria = new CDbCriteria();
					// $criteria->addInCondition("name_en", $locations );
					// $country = Country::model()->findAll($criteria);
					// if($country){
						// $user->country_id = $country[0]->id;
					// }
				// }
				$user->save(false);
			}
		}
		else if($id=='twitter'){
			if(isset($_REQUEST['oauth_verifier'])){
	            $oauth_token= Yii::app()->session['oauth_token'];
	            $oauth_token_secret  = Yii::app()->session['oauth_token_secret'];
	            $consumer_secrit = Yii::app()->params['twitter']['CONSUMER_SECRET'];
	            $consumer_key = Yii::app()->params['twitter']['CONSUMER_KEY'] ;
	            $connection = new TwitterOAuth($consumer_key,  $consumer_secrit, $oauth_token,$oauth_token_secret );
	            $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

	            if (200 == $connection->http_code){
	            	Yii::app()->session['access_token'] = $access_token;
                    $content = $connection->get('account/verify_credentials');
                    $id = $content->id ;
					$user = User::model()->find("twitter_id =?" , array( $id) );
					if(!isset($user)) {
						$user = new User();
						$user->twitter = $id  ;
						$user->first_name = $content ->screen_name;
						$user->email = 'a@a.com';
						$user->save();
					}
	            }
    		}else{
	            $connection = new TwitterOAuth(Yii::app()->params['twitter']['CONSUMER_KEY'], Yii::app()->params['twitter']['CONSUMER_SECRET']);
	            $request_token = $connection->getRequestToken(Yii::app()->controller->createAbsoluteUrl('user/login', array('service'=>'twitter')));

	            Yii::app()->session['oauth_token']  = $request_token['oauth_token'];
	            Yii::app()->session['oauth_token_secret'] = $request_token['oauth_token_secret'];
	            /* If last connection failed don't display authorization link. */
	            switch($connection->http_code){
					case 200:
						/* Build authorize URL and redirect user to Twitter. */
						$url = $connection->getAuthorizeURL($request_token);
						header('Location: ' . $url);
						exit;
						break;
					default:
						/* Show notification if something went wrong. */
						return false;
				}
			}
		}
		else if($id=='google'){
			if(!isset(Yii::app()->session['access_token' ])) $google_info = $this->storeAccesstocken('google') ;

			$key= Yii::app()->params->google['key']; 
			$access_token =  Yii::app()->session['access_token' ] ;

			$google_info = $this->getUserInfo('https://www.googleapis.com/oauth2/v2/userinfo' ,'key='.$key.'&access_token='.$access_token);
			$google_id = $google_info->id;
			$user = User::model()->find("google_id =?" , array( $google_id ) );

			if(!isset($user)) { 
				$user = new User();
				$user->google_id  = $google_id  ;
				$user->first_name = $google_info->name;
				$user->email = $google_info->email;
				print_r($user->save());
				print_r($user->getErrors ());
			}
		}
		
		// $duration= 3600*24*30 ; // 30 days
		// $this->allowAutoLogin = true;
		// $userIdentity = new UserIdentity($user->id ,$access_token);
		// Yii::app()->user->login($userIdentity,$duration);
		
		$user->login();
		
		Yii::app()->getController()->redirect(Yii::app()->request->getBaseUrl(true));
		
		// if($isNewUser){
			// header('Location:'.Yii::app()->baseUrl.'/'.Yii::app()->language.'/user/update');
			// exit;
		// }
		// else{
			// Yii::app()->getController()->redirect(Yii::app()->request->getBaseUrl(true));
			// exit;
		// }
	}

	public function storeAccesstocken($network)
	{
		if($network == 'google') {
			$client_id = Yii::app()->params->google['client_id'];
			$client_secret = Yii::app()->params->google['client_secret'];
			$redirect_url= Yii::app()->controller->createAbsoluteUrl('user/login', array('service'=>'google')); 
			$scope= Yii::app()->params->google['scope']; 

			$url = 'https://accounts.google.com/o/oauth2/token';
			$authUrl = 'https://accounts.google.com/o/oauth2/auth?redirect_uri='.$redirect_url.'&response_type=code&client_id='.$client_id .'&approval_prompt=force&scope=' . $scope;

			if (isset($_GET['code'])) {
				$code = $_GET['code'];
				$post_data = 'grant_type=authorization_code&code='. $code. '&client_id='.$client_id.'&client_secret='.$client_secret.'&redirect_uri='.$redirect_url;
				list($info, $content) = HttpClient::postRequest($url, null, $post_data);

				if ($info['code']!=200) {
					throw new Exception('bad response: '.json_encode($info));
				}
				$access_token = '';

				if(isset($content ) ){
					$access_token =   json_decode ( $content )->access_token ;
				} else {
					parse_str($content) ;
				}

				Yii::app()->session['access_token' ] = $access_token ; 
				return $access_token  ;

			} else {
				header ('Location: '.$authUrl);
				exit;
			}
		}
		else if($network == 'facebook') {
			$scope= Yii::app()->params->facebook['scope']; 
			$client_id = Yii::app()->params->facebook['client_id'];
			$client_secret = Yii::app()->params->facebook['client_secret'];
			$redirect_url = Yii::app()->controller->createAbsoluteUrl('user/login', array('service'=>'facebook'));
			$url = 'https://www.facebook.com/dialog/oauth?&scope=' . $scope  ;
			$authUrl = $url ."&app_id=$client_id&redirect_uri=$redirect_url" ;

			$url = "https://graph.facebook.com/oauth/access_token?client_id=$client_id&redirect_uri=$redirect_url&client_secret=$client_secret";
		
			if (isset($_GET['code'])) {
				$code = $_GET['code'];
				//$post_data = 'grant_type=authorization_code&code='. $code. '&client_id='.$client_id.'&client_secret='.$client_secret.'&redirect_uri='.$redirect_url;
				list($info, $content) = HttpClient::getRequest($url  . '&code='. $code);
				if ($info['code']!=200) {
					throw new Exception('bad response: '.json_encode($info));
				}
	  			$json = json_decode ( $content ) ;
				
	  			$access_token = '';
				if(isset($json)){
					$access_token = json_decode($content)->access_token;
				} else {
					parse_str($content) ;
				}

				Yii::app()->session['access_token' ] = $access_token; 
				return $access_token  ;

			} else {
				header ('Location: '.$authUrl);
				exit;
			}
		}
	}

	public function getUserInfo($url , $data=''){
		list($info, $content) = HttpClient::getRequest($url .'?'.$data);
		die(var_dump($content));
		if ($info['code']!=200 || null===($json=json_decode($content))){
			throw new Exception('bad response: '.json_encode($info));
		}
		$json = json_decode($content) ;
		return $json;
	}

}
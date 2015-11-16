<?php

  // General
	$resPath = Yii::app()->baseUrl.'/res' ; // Yii::app()->theme->baseUrl
  $cdn = !YII_DEBUG;
  $fb_app_id = Yii::app()->params['fb_app_id'];
  $google_analytics_id = Yii::app()->params['google_analytics_id'];
  
  $cs = Yii::app()->clientScript;
  $theme = null;
  $lang = Yii::app()->language;
  
  /* ---- jQuery ----- */
  $cs->scriptMap = array(
    'jquery.js' => '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
    'jquery.min.js' => '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
  );
  
  /* ---- Packages ----- */

  $cs->packages = array(
    // Bootstrap
    'bootstrap' => array(
      'basePath' => 'application.themes.'.$theme,
      'baseUrl' => $resPath . '/lib/bootstrap/',
      'js' => array('js/bootstrap.js'),
      'css' => array('css/bootstrap.min.css'),
      'depends' => array('jquery')
    ),
    'bootstrap_cdn' => array(
      'basePath' => 'application.themes.'.$theme,
      'baseUrl' => '//netdna.bootstrapcdn.com/bootstrap/3.3.5/',
      'js' => array('js/bootstrap.min.js' ,),
      'css' => array('css/bootstrap.min.css'),
      'depends' => array('jquery')
    ),
    'bootstrap-rtl' => array(
      'basePath' => 'application.themes.'.$theme,
      'baseUrl' => $resPath . '/lib/bootstrap/',
      'js' => array('js/bootstrap.js'),
      'css' => array('css/bootstrap-rtl.min.css'),
      'depends' => array('jquery')
    ),
    // Font Awesome
    'font_awesome' => array(
      'basePath' => 'application.themes.'.$theme,
      'baseUrl' => $resPath . '/lib/font-awesome/',
      'css' => array('/css/font-awesome.min.css'),
    ),
    'font_awesome_cdn' => array(
      'basePath' => 'application.themes.'.$theme,
      'baseUrl' => '//netdna.bootstrapcdn.com/font-awesome/4.4.0/',
      'css' => array('css/font-awesome.min.css'),
    ),
  );
  
	/* -- Register Packages -- */
	if($cdn):
		$cs->registerPackage('bootstrap_cdn');
		$cs->registerPackage('font_awesome_cdn');
	else:
		if($lang=='ar')
			$cs->registerPackage('bootstrap-rtl');
		else
			$cs->registerPackage('bootstrap');
	
		$cs->registerPackage('font_awesome');
	endif;
  
  /* ---- CSS ----- */
	$cs->registerCSSFile($resPath . '/css/main_'.$lang.'.css');
	
	if($lang=='ar')
		$cs->registerCSSFile($resPath . '/css/rtl-fix.css');
	
  /* ---- JS ----- */
  $cs->registerScriptFile($resPath . '/js/main.js');
	
  /* ---- inline JS ---- */
  
  // Google Analytics
  if ($google_analytics_id) {
    $cs->registerScript('GA', "
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', '{$google_analytics_id}', 'auto');
			ga('send', 'pageview');
    ");
  }
  
	if($fb_app_id){
		$cs->registerScript('facebook-script-'.$fb_app_id,'
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId='.$fb_app_id.'";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, \'script\', \'facebook-jssdk\'));
		');
	}

  /* ---- Other and plugins ---- */
  

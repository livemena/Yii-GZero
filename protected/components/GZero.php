<?php

class GZero
{
	public static function langSwitcher($type='link',$htmlOptions=array())
	{
		$lang = Yii::app()->language;

		switch ($lang) {
			case 'en':
				$label = 'عربي';
				$_GET['lang'] = 'ar';
				break;
			case 'ar':
				$label = 'English';
				$_GET['lang'] = 'en';
				break;
		}
		
		$url = Yii::app()->getController()->createUrl(Yii::app()->getController()->id.'/'.Yii::app()->getController()->action->id,$_GET);
		
		switch ($type) {
			case 'link':
				return CHtml::link($label,$url,$htmlOptions);
				break;
			case 'menu':
				return array('label'=>$label,'url'=>$url,'linkOptions'=>$htmlOptions);
				break;
		}
	}

	public static function registerPackage($cdn=false,$ga_id=false,$packages=array())
	{
		/*
		* Available packages:
		* bootstrap
		* fontawesome (optional)
		* fancybox (optional)
		* GZero::registerPackage(cdn(boolean),$ga_id(Google Analytics ID),$packages = array());
		*/
		$cs = Yii::app()->clientScript;

    $cs->scriptMap = array(
      'jquery.js' => Yii::app()->baseUrl.'/res/lib/jquery-1.11.1/jquery.min.js',
      'jquery.min.js' => Yii::app()->baseUrl.'/res/lib/jquery-1.11.1/jquery.min.js',
    );
    
		if ($cdn):
				$cs->scriptMap = array(
          'jquery.js' => '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',
          'jquery.min.js' => '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',
				);
				$cs->packages = array(
          'bootstrap' => array(
            'basePath' => 'application.res',
            'baseUrl' => '//netdna.bootstrapcdn.com/bootstrap/3.2.0/',
            'js' => array('js/bootstrap.min.js'),
            'css' => array('css/bootstrap.min.css'),
            'depends' => array('jquery')
          ),
          'fontawesome' => array(
            'basePath' => 'application.res',
            'baseUrl' => '//netdna.bootstrapcdn.com/font-awesome/4.3.0/',
            'css' => array('css/font-awesome.min.css'),
          ),
          'bootstrap-rtl' => array(
            'basePath' => 'application.res',
            'baseUrl' => Yii::app()->baseUrl . '/res/lib/bootstrap-rtl/',
            'js' => array('js/bootstrap.js'),
            'css' => array('css/bootstrap.css'),
            'depends' => array('jquery')
          )
				);
		else:
			$cs->packages = array(
        'bootstrap' => array(
          'basePath' => 'application.res',
          'baseUrl' => Yii::app()->baseUrl . '/res/lib/bootstrap/',
          'js' => array('js/bootstrap.js'),
          'css' => array('css/bootstrap.css'),
          'depends' => array('jquery')
        ),
        'fontawesome' => array(
          'basePath' => 'application.res',
          'baseUrl' => Yii::app()->baseUrl . '/res/lib/font-awesome/',
          'css' => array('/css/font-awesome.min.css'),
        ),
        'bootstrap-rtl' => array(
          'basePath' => 'application.res',
          'baseUrl' => Yii::app()->baseUrl . '/res/lib/bootstrap-rtl/',
          'js' => array('js/bootstrap.js'),
          'css' => array('css/bootstrap.css'),
          'depends' => array('jquery')
        )
				);
		endif;

		if (Yii::app()->language == 'ar'){
				$packages[] = 'bootstrap-rtl';
		} else {
				$packages[] = 'bootstrap';
		}
		
		foreach($packages as $pk){
			$cs->registerPackage($pk);
		}
		
		if($ga_id){
			$cs->registerScript('GA',"
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				ga('create', '{$ga_id}', '{$_SERVER['SERVER_NAME']}');
				ga('send', 'pageview');
			");
		}
		
		$cs->registerCSSFile(Yii::app()->baseUrl . '/res/style/main_'.Yii::app()->language.'.css');
		$cs->registerScriptFile(Yii::app()->baseUrl . '/res/js/main.js');
	}
	
	public static function registerOpenGraph($option=array('site_name'=>null,'title'=>null,'description'=>null,'thumbnail'=>null,'url'=>null))
	{
		$cs = Yii::app()->clientScript;

		if($option['site_name'])
			$cs->registerMetaTag($option['site_name'],null,null,array('property'=>'og:site_name'));
		if($option['title'])
			$cs->registerMetaTag($option['title'],null,null,array('property'=>'og:title'));
		if($option['description'])
			$cs->registerMetaTag($option['description'],null,null,array('property'=>'og:description'));
		if($option['thumbnail'])
			$cs->registerMetaTag($option['thumbnail'],null,null,array('property'=>'og:thumbnail'));
		if($option['url'])
			$cs->registerMetaTag($option['url'],null,null,array('property'=>'og:url'));
	}
}
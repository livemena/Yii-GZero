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

		if ($cdn):
				$cs->scriptMap = array(
						'jquery.js' => '//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js',
						'jquery.min.js' => '//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js',
				);
				$cs->packages = array(
						'bootstrap' => array(
								'basePath' => 'application.res',
								'baseUrl' => '//netdna.bootstrapcdn.com/bootstrap/3.1.1/',
								'js' => array('js/bootstrap.min.js'),
								'css' => array('css/bootstrap.min.css'),
								'depends' => array('jquery')
						),
						'fontawesome' => array(
								'basePath' => 'application.res',
								'baseUrl' => '//netdna.bootstrapcdn.com/font-awesome/4.0.0/',
								'css' => array('css/font-awesome.min.css'),
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
					'fancybox' => array(
							'basePath' => 'application.res',
							'baseUrl' => Yii::app()->baseUrl . '/res/lib/fancybox/',
							'js' => array('lib/jquery.mousewheel-3.0.6.pack.js', 'source/jquery.fancybox.pack.js'),
							'css' => array('source/jquery.fancybox.css'),
							'depends' => array('jquery')
					),
					'fancybox-buttons' => array(
							'basePath' => 'application.res',
							'baseUrl' => Yii::app()->baseUrl . '/res/lib/fancybox/source/helpers/',
							'js' => array('jquery.fancybox-buttons.js'),
							'css' => array('jquery.fancybox-buttons.css'),
					),
					'fancybox-thumbs' => array(
							'basePath' => 'application.res',
							'baseUrl' => Yii::app()->baseUrl . '/res/lib/fancybox/source/helpers/',
							'js' => array('jquery.fancybox-thumbs.js'),
							'css' => array('jquery.fancybox-thumbs.css'),
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


		// if ($buttons)
				// $cs->registerPackage('fancybox-buttons');
		// if ($thumbs)
				// $cs->registerPackage('fancybox-thumbs');

		if (Yii::app()->language == 'ar'){
				$cs->registerPackage('bootstrap-rtl');
		} else {
				$cs->registerPackage('bootstrap');
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
}
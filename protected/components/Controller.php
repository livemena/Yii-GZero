<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function config($option)
	{
		$conf = Config::model()->findByPk(array('option'=>$option));
		
		// if(isset($conf) && $option=='skin_name')
		// {
			// $skins = CJSON::decode($conf->value);
			// $skin = array_search('1', $skins);
			// $conf->value = $skin;
		// }
		
		if(isset($conf)){
			return $conf->value;
		}
	}
	
    public function registerDefaults() 
	{
        $cs = Yii::app()->clientScript;

        if ($this->config('settings_cdn')){
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
            );
        } else {
            $cs->packages = array(
                'bootstrap' => array(
                    'basePath' => 'application.res',
                    'baseUrl' => Yii::app()->baseUrl . '/res/lib/bootstrap/',
                    'js' => array('js/bootstrap.js'),
                    'css' => array('css/bootstrap.css'),
                    'depends' => array('jquery')
                ),
            );
        }

        if (Yii::app()->language == 'ar'){
            $cs->packages = array(
                'bootstrap-rtl' => array(
                    'basePath' => 'application.res',
                    'baseUrl' => Yii::app()->baseUrl . '/res/lib/bootstrap-rtl/',
                    'js' => array('js/bootstrap.js'),
                    'css' => array('css/bootstrap.css'),
                    'depends' => array('jquery')
                ),
            );
            $cs->registerPackage('bootstrap-rtl');
        } else {
            $cs->registerPackage('bootstrap');
        }

		$cs->registerCSSFile(Yii::app()->baseUrl . '/res/style/main_'.Yii::app()->language.'.css');
        $cs->registerScriptFile(Yii::app()->baseUrl . '/res/js/main.js');
    }

    public function registerFancybox($buttons = false, $thumbs = false) 
	{
        $cs = Yii::app()->clientScript;

        $cs->packages = array(
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
            )
        );

        $cs->registerPackage('fancybox');
        if ($buttons)
            $cs->registerPackage('fancybox-buttons');
        if ($thumbs)
            $cs->registerPackage('fancybox-thumbs');
    }

    public function registerFontAwesome(){
        // CClientScript::POS_END

        $cs = Yii::app()->clientScript;

        if ($this->config('settings_cdn')):
            $cs->packages = array(
                'fontAwesome' => array(
                    'basePath' => 'application.res',
                    'baseUrl' => '//netdna.bootstrapcdn.com/font-awesome/4.0.0/',
                    'css' => array('css/font-awesome.min.css'),
                )
            );
        else:
            $cs->packages = array(
                'fontAwesome' => array(
                    'basePath' => 'application.res',
                    'baseUrl' => Yii::app()->baseUrl . '/res/lib/font-awesome/',
                    'css' => array('/css/font-awesome.min.css'),
                )
            );
        endif;

        $cs->registerPackage('fontAwesome');
    }
	
	public function registerGoogleAnalytics()
	{
		if($this->config('settings_google_analytics_id')){
			Yii::app()->clientScript->registerScript('GA',"
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				ga('create', '{$this->config('settings_google_analytics_id')}', '{$_SERVER['SERVER_NAME']}');
				ga('send', 'pageview');
			");
		}
	}

}
<?php
/*
  ShareWidget v0.1;

 Usage:
 
  $this->widget('application.widgets.shareWidget.shareWidget', array(
    'page_url'=>'http://livemena.com',
    'buttons' => array(
      'facebook','twitter','linkedin','googleplus',
    ),
    'facebook_app_id'=>'',
    'facebook_options'=>array(
      'data-layout'=>'button_count',
      'data-action'=>'like',
      'data-show-faces'=>'false',
      'data-shere'=>'false',
    ),
    'twitter_options'=>array(
      'data-via'=>'livemena',
    ),
    'linkedin_options'=>array(
      'data-counter'=>'right'
    ),
    'googleplus_options'=>array(
      'data-size'=>'medium'
    ),
    'htmlOptions'=>array()
  ));
  
*/

class shareWidget extends CWidget{

	public $buttons = array(
    'facebook','twitter','linkedin','googleplus',
  );
  
	public $page_url = '';
	public $facebook_app_id = '';
  
  // fb options: https://developers.facebook.com/docs/plugins/like-button
	public $facebook_options = array(
    'data-layout'=>'button_count',
    'data-action'=>'like',
    'data-show-faces'=>'false',
    'data-shere'=>'false',
  );

  // Twitter options: https://about.twitter.com/resources/buttons#tweet
	public $twitter_options = array(
    'data-via'=>'livemena',
  );
  
  // Linkedin options: https://developer.linkedin.com/plugins/share
	public $linkedin_options = array(
    'data-counter'=>'right'
  );
  
  // Google plus options: https://developers.google.com/+/web/+1button/
	public $googleplus_options = array(
    'data-size'=>'medium'
  );
  
  public $htmlOptions = array();

  // Private
  private $facebook_button;
  private $twitter_button;
  private $linkedin_button;
  private $googleplus_button;
  
  private $cssFile;

	public function init(){

		$cssFile = dirname(__FILE__).'/assets/css/style.css';
    $this->cssFile = Yii::app()->getAssetManager()->publish($cssFile);
		Yii::app()->clientScript->registerCssFile($this->cssFile);
    
    foreach($this->buttons as $btn){

      switch ($btn){
        case 'facebook':
          
          $this->facebook_options['data-href']=$this->page_url;
          $this->facebook_options['class']='fb-like pull-left';
          
          $this->facebook_button = CHtml::tag('div', $this->facebook_options,'');
          
          echo CHtml::tag('div', array('id'=>'fb-root'),'');
          
          Yii::app()->clientScript->registerScript('facebook-script-'.$this->facebook_app_id, '
            (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId='.$this->facebook_app_id.'&version=v2.0";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, \'script\', \'facebook-jssdk\'));
          ');
        break;
        case 'twitter':
          
          $this->twitter_button = '<a href="https://twitter.com/share" class="twitter-share-button" data-via="'.$this->twitter_options['data-via'].'">Tweet</a>';

          Yii::app()->clientScript->registerScript('twitter-script', "
            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
          ");
        break;
        case 'linkedin';
        
          $this->linkedin_button = '<script type="IN/Share" data-counter="'.$this->linkedin_options['data-counter'].'"></script>';
          Yii::app()->clientScript->registerScriptFile( '//platform.linkedin.com/in.js', CClientScript::POS_END);
        break;
        case 'googleplus';
        
          $this->googleplus_button = '<div class="g-plusone" data-size="'.$this->googleplus_options['data-size'].'" data-annotation="none" data-href="'.$this->page_url.'"></div>';
          
          Yii::app()->clientScript->registerScriptFile( 'https://apis.google.com/js/platform.js', CClientScript::POS_END);
          
          break;
      }
      
    }

	}

	public function run(){

    $btnsList = "<li class='fb'>{$this->facebook_button}</li>
            <li class='in'>{$this->linkedin_button}</li>
            <li class='plus'>{$this->googleplus_button}</li>
            <li class='tw'>{$this->twitter_button}</li>
        ";
        
    $options = array(
      'class' => 'share-buttons-widget clearfix',
    );
    
    $this->htmlOptions = array_merge($this->htmlOptions,$options);
    
    echo CHtml::tag('ul',$this->htmlOptions,$btnsList);

	}
}
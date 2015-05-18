<?php
	$resPath = Yii::app()->baseUrl.'/res' ;
	$cs = Yii::app()->clientScript;
  $theme = null;
  $lang = 'en';
	
  /* ---- Packages ----- */

  $cs->packages = array(
    // Bootstrap
    'bootstrap' => array(
      'basePath' => 'application.themes.'.$theme,
      'baseUrl' => $resPath . '/lib/bootstrap/',
      'js' => array('js/bootstrap.js'),
      'css' => array('css/bootstrap.css'),
      'depends' => array('jquery')
    ),
    'bootstrap_cdn' => array(
      'basePath' => 'application.themes.'.$theme,
      'baseUrl' => '//netdna.bootstrapcdn.com/bootstrap/3.3.2/',
      'js' => array('js/bootstrap.min.js' ,),
      'css' => array('css/bootstrap.min.css'),
      'depends' => array('jquery')
    ),
    'bootstrap-rtl' => array(
      'basePath' => 'application.themes.'.$theme,
      'baseUrl' => $resPath . '/lib/bootstrap-rtl/',
      'js' => array('js/bootstrap.js'),
      'css' => array('css/bootstrap.css'),
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
      'baseUrl' => '//netdna.bootstrapcdn.com/font-awesome/4.3.0/',
      'css' => array('css/font-awesome.min.css'),
    ),
  );
	
	/* -- Register Packages -- */

	if($lang=='ar')
		$cs->registerPackage('bootstrap-rtl');
	else
		$cs->registerPackage('bootstrap');

	$cs->registerPackage('font_awesome');
	
	$cs->registerCSSFile($resPath . '/css/admin.css');
		
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta name="description" content="ArabSooQ Admin">
	<script type="text/javascript">
		var baseUrl = "<?php echo Yii::app()->request->baseUrl; ?>";
	</script>
</head>
<body>
	<?php $this->renderPartial('/layouts/_header'); ?>
	
	<?php echo $content; ?>
	
	<?php 
		$this->widget('ext.timeago.JTimeAgo', array(
			'selector' => ' .timeago',
		));
	?>
	
</body>
</html>

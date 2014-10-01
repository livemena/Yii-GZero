<?php 
	/* @var $this Controller */ 
	$pageId = $this->id.'-'.$this->action->id;
	
	/*
	* Available packages:
	* bootstrap and main css files
	* fontawesome (optional)
	* fancybox (optional)
	* GZero::registerPackage(cdn(boolean),$ga_id(Google Analytics ID),$packages = array());
	*/
	GZero::registerPackage(!YII_DEBUG,false,array('fontawesome','fancybox'));
	
	GZero::registerOpenGraph(array(
		'site_name'=>Yii::app()->name,
		'title'=>$this->pageTitle,
		'description'=>null,
		'thumbnail'=>null, // uri
		'url'=>null
	));
?>
<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language; ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta name="description" content="">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript">
		var baseUrl = "<?php echo Yii::app()->request->baseUrl; ?>";
	</script>
</head>
<body id="<?php echo $pageId; ?>">

	<?php echo $content; ?>

</body>
</html>

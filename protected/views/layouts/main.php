<?php 
	/* @var $this Controller */ 
	$pageId = $this->id.'/'.$this->action->id;
	
	// Default scripts ( jQuery , Bootstrap , default.css )
	Yii::app()->getController()->registerDefaults();
	Yii::app()->getController()->registerFontAwesome();
	Yii::app()->getController()->registerGoogleAnalytics();
?>
<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta name="description" content="<?php echo $this->config('description'); ?>">
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

<?php if($this->config('skin_background_uri')): ?>
	<style>body{background-image:url("<?php echo $this->config('skin_background_uri'); ?>");}</style>
<?php endif; ?>
</body>
</html>

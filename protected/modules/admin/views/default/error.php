<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
?>

<style>
.error-page{
	padding:40px 20px;
}
.error-page h2{
	font-size:40px;
	margin:0 0 30px
}
.error-page .fa-exclamation-triangle{
	font-size:200px;
	color:#FFEE58
}
.error-page .message{
	margin:20px auto 30px;
}
</style>


<div class="error-page text-center">

	<h2>Error <?php echo $code; ?></h2>
	<i class="fa fa-exclamation-triangle"></i>

	<p class="text-muted message"><?php echo CHtml::encode($message); ?></p>

	<a class="btn btn-default btn-lg" href="<?php echo $this->createUrl('default/index'); ?>"><span class="glyphicon glyphicon-home"></span> Take Me Home</a>

</div>
<?php $this->beginContent('//layouts/main'); ?>

<?php $this->renderPartial('//layouts/_header'); ?>

<div id="content" class="container">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>
	
	<div id="footer">
	<hr>
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	<br>
	</div><!-- footer -->
	
</div><!-- content -->

<?php $this->endContent(); ?>
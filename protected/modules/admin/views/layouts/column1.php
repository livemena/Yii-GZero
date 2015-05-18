<?php $this->beginContent('/layouts/main'); ?>

<div id="content" class="container">
	<div class="text-center" style="color: rgb(204, 204, 204); margin: 20px 0px; text-transform: uppercase;">
		<h1>Admin Dashboard</h1>
	</div>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
			'htmlOptions'=>array('class'=>'breadcrumb'),
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>
	
	<div id="footer">
	<hr>
		Copyright &copy; <?php echo date('Y'); ?> by LiveMena.<br/>
		All Rights Reserved.<br/>
		<a href="https://github.com/livemena/Yii-GZero" title="Yii Grand-Zero Ready-to-code application template">Yii-GZero</a> <?php echo Yii::powered(); ?>
	<br>
	<br>
	</div><!-- footer -->
	
</div><!-- content -->

<?php $this->endContent(); ?>

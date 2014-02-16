<?php $this->beginContent('//layouts/main'); ?>

<?php $this->renderPartial('//layouts/_header'); ?>

<div id="content" class="container">

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
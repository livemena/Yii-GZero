<?php $this->beginContent('//layouts/main'); ?>

<div id="content" class="container">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
			'htmlOptions'=>array('class'=>'breadcrumb'),
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>
	
</div><!-- content -->

<?php $this->endContent(); ?>
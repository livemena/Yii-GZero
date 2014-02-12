<?php $this->beginContent('//layouts/main'); ?>

<?php $this->renderPartial('//layouts/_header'); ?>

<div id="content" class="container">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
			'htmlOptions'=>array('class'=>'breadcrumb'),
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	
	<div class="row">
		<div class="col-md-8">
			<?php echo $content; ?>
		</div>
		
		<div id="sidebar" class="col-md-4">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operations',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		?>
		</div><!-- sidebar -->
	</div>
	
	<div id="footer">
	<hr>
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	<br>
	<br>
	</div><!-- footer -->
	
</div><!-- content -->

<?php $this->endContent(); ?>
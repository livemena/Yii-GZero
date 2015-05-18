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
				'encodeLabel'=>false,
				'htmlOptions'=>array('class'=>'nav nav-pills nav-stacked'),
			));
			$this->endWidget();
		?>
		</div><!-- sidebar -->
	</div>
	
</div><!-- content -->

<?php $this->endContent(); ?>
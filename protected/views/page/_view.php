<?php
/* @var $this PageController */
/* @var $data Page */
?>

<div class='form-horizontal'>

	<div class="form-group">
		<label class="col-sm-2 control-label">Page</label>
		<div class="col-sm-10">
		  <div><?php echo CHtml::link(CHtml::encode($data->title_en), array('view', 'slug'=>$data->slug)); ?></div>
		</div>
    </div>

	<div class="form-group">
		<label for="url" class="col-sm-2 control-label">Page URL</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" name="url" value="<?php echo $this->createUrl('page/view',array('slug'=>$data->slug)); ?>">
		</div>
    </div>
	
	<div class="form-group">
		<label for="htmllink" class="col-sm-2 control-label">HTML Link</label>
		<div class="col-sm-10">
		  <input type="text" class="form-control" name="htmllink" value="&lt;a href='<?php echo $this->createUrl('page/view',array('slug'=>$data->slug)); ?>'&gt;<?php echo CHtml::encode($data->title); ?></a>">
		</div>
    </div>
	
	<div class="form-group">
		<label for="htmllink" class="col-sm-2 control-label">Created</label>
		<div class="col-sm-10">
			<?php echo CHtml::encode($data->created_at); ?>
		</div>
    </div>
</div>
<hr>
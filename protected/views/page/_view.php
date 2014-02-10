<?php
/* @var $this PageController */
/* @var $data Page */
?>

<div class="view">

	<b>Page:</b>
	<?php echo CHtml::link(CHtml::encode($data->title), array('view', 'slug'=>$data->slug)); ?>
	<br />

	<b>Page URL:</b>
		<input type="text" value="<?php echo $this->createUrl('page/view',array('slug'=>$data->slug)); ?>">
	<br />
	
	<b>Html link:</b>
		<input type="text" value="&lt;a href='<?php echo $this->createUrl('page/view',array('slug'=>$data->slug)); ?>'&gt;<?php echo CHtml::encode($data->title); ?></a>">
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />


</div>
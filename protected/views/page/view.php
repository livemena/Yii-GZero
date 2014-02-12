<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'<span class="glyphicon glyphicon-list"></span> List Page', 'url'=>array('index')),
	array('label'=>'<span class="glyphicon glyphicon-plus-sign"></span> Create Page', 'url'=>array('create')),
	array('label'=>'<span class="glyphicon glyphicon-pencil"></span> Update Page', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'<span class="glyphicon glyphicon-trash"></span> Delete Page', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<span class="glyphicon glyphicon-list-alt"></span> Manage Page', 'url'=>array('admin')),
);
?>

<div class="page-header">
  <h1><?php echo $model->title; ?></h1>
</div>

<p>
	<?php echo $model->body; ?>
	
	<br><br>
	
	<?php echo $model->created_at; ?>
</p>

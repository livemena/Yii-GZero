<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'<span class="glyphicon glyphicon-list"></span> List Page', 'url'=>array('index')),
	array('label'=>'<span class="glyphicon glyphicon-plus-sign"></span> Create Page', 'url'=>array('create')),
	array('label'=>'<span class="glyphicon glyphicon-file"></span> View Page', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'<span class="glyphicon glyphicon-list-alt"></span> Manage Page', 'url'=>array('admin')),
);
?>

<h1>Update Page <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
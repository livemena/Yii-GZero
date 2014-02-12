<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'<span class="glyphicon glyphicon-list"></span> List Page', 'url'=>array('index')),
	array('label'=>'<span class="glyphicon glyphicon-list-alt"></span> Manage Page', 'url'=>array('admin')),
);
?>

<h1>Create Page</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
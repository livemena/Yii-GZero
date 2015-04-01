<?php
/* @var $this UserController */
/* @var $model User */

$this->menu=array(
    array('label'=>'List User', 'url'=>array('index')),
    array('label'=>'Create User', 'url'=>array('create')),
);

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'full_name',
		'email',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
		),
	),
)); ?>

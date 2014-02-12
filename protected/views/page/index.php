<?php
/* @var $this PageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pages',
);

$this->menu=array(
	array('label'=>'<span class="glyphicon glyphicon-plus-sign"></span> Create Page', 'url'=>array('create')),
	array('label'=>'<span class="glyphicon glyphicon-list-alt"></span> Manage Page', 'url'=>array('admin')),
);
?>

<h1>Pages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
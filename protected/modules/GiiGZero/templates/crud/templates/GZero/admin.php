<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Manage',
);\n";
?>

$this->menu=array(
	array('label'=>'<span class="glyphicon glyphicon-list"></span> List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'<span class="glyphicon glyphicon-plus"></span> Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
);
?>

<div class="page-header">
	<h1>Manage <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h1>
</div>

<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'htmlOptions' => array(
		'class' => 'table-responsive'
	),
	'pagerCssClass' => 'pager-wrapper',
	'itemsCssClass' => 'table table-striped table-hover',
	'cssFile' => false,
	'summaryCssClass' => '',
	'filter'=>$model,
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t'".$column->name."',\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

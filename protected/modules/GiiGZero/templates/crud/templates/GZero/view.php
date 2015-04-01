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
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn},
);\n";
?>

$this->menu=array(
	array('label'=>'<span class="glyphicon glyphicon-list"></span> List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'<span class="glyphicon glyphicon-plus"></span> Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
	array('label'=>'<span class="glyphicon glyphicon-pencil"></span> Update <?php echo $this->modelClass; ?>', 'url'=>array('update', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>'<span class="glyphicon glyphicon-remove"></span> Delete <?php echo $this->modelClass; ?>', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'<span class="glyphicon glyphicon-th-list"></span> Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>

<div class="page-header">
	<h1>View <?php echo $this->modelClass." #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>
</div>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'htmlOptions' => array('class' => 'table table-hover table-striped'),
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column)
	echo "\t\t'".$column->name."',\n";
?>
	),
)); ?>

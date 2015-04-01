<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $dataProvider CActiveDataProvider */

<?php
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label',
);\n";
?>

$this->menu=array(
	array('label'=>'<span class="glyphicon glyphicon-plus"></span> Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
	array('label'=>'<span class="glyphicon glyphicon-th-list"></span> Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>

<div class="page-header">
	<h1><?php echo $label; ?></h1>
</div>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'summaryText'=>false,
	'itemView'=>'_view',
)); ?>

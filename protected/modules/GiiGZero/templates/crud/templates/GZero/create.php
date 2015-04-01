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
	'Create',
);\n";
?>

$this->menu=array(
	array('label'=>'<span class="glyphicon glyphicon-list"></span> List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'<span class="glyphicon glyphicon-th-list"></span> Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>

<div class="page-header">
	<h1>Create <?php echo $this->modelClass; ?></h1>
</div>

<?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>

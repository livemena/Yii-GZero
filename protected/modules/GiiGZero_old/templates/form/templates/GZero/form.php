<?php
/**
 * This is the template for generating a form script file.
 * The following variables are available in this template:
 * - $this: the FormCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getModelClass(); ?>Controller */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
?>

<div class="form">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass).'-'.basename($this->viewName)."-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
	'clientOptions'=>array(
		'errorCssClass'=>'has-error',
	),
	'htmlOptions'=>array(
		'class'=>'form-horizontal'
	),
)); ?>\n"; ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo "<?php echo \$form->errorSummary(\$model, '', '', array('class' => 'alert alert-danger')); ?>\n"; ?>

<?php foreach($this->getModelAttributes() as $attribute): ?>
	<div class="form-group">
		<?php echo "<?php echo \$form->labelEx(\$model,'$attribute',array('class'=>'col-sm-2 control-label')); ?>\n"; ?>
		<div class="col-sm-10">
			<?php echo "<?php echo \$form->textField(\$model,'$attribute',array('class'=>'form-control','placeholder'=>\$form->getAttributeLabel('$attribute'))); ?>\n"; ?>
			<?php echo "<?php echo \$form->error(\$model,'$attribute',array('class'=>'help-block')); ?>\n"; ?>
		</div>
	</div>

<?php endforeach; ?>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		<?php echo "<?php echo CHtml::submitButton(Yii::t('app','submit'),array('class'=>'btn btn-primary')); ?>\n"; ?>
		</div>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->
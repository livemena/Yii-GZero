<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
$this->layout='//layouts/column2';
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-register-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'clientOptions'=>array(
		'errorCssClass'=>'has-error',
	),
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-horizontal')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'first_name',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'first_name',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'first_name',array('class'=>'help-block')); ?>
		</div>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'last_name',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'last_name',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'last_name',array('class'=>'help-block')); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'email',array('class'=>'help-block')); ?>
		</div>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'gender',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'gender',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'gender',array('class'=>'help-block')); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'password',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'password',array('class'=>'help-block')); ?>
		</div>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'verifyPassword',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->passwordField($model,'verifyPassword',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'verifyPassword',array('class'=>'help-block')); ?>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->layout='//layouts/column2';

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>

<div class="page-header">
	<h1><?php echo Yii::t('app','contact') ?></h1>
</div>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'errorCssClass'=>'has-error',
	),
	'htmlOptions'=>array('class'=>'form-horizontal')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($model, '', '', array('class' => 'alert alert-danger')); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'name',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'name',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'name',array('class'=>'help-block')); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'subject',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'subject',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'subject',array('class'=>'help-block')); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'body',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textArea($model,'body',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'body',array('class'=>'help-block')); ?>
		</div>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<?php echo $form->labelEx($model,'verifyCode'); ?>
			<div>
			<?php $this->widget('CCaptcha'); ?>
			<?php echo $form->textField($model,'verifyCode',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'verifyCode',array('class'=>'help-block')); ?>
			</div>
			<div class="hint">Please enter the letters as they are shown in the image above.
			<br/>Letters are not case-sensitive.</div>
			
		</div>
	</div>
	<?php endif; ?>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<?php echo CHtml::submitButton(Yii::t('app','submit'),array('class'=>'btn btn-primary')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
$this->layout='//layouts/column1';
?>

<div id="gz-login-form" class="omb_login">
	<h3 class="omb_authTitle">Update <?php echo Yii::app()->user->name; ?></h3>
				
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-update-form',
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
		<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-6">	

				<?php echo $form->errorSummary($model, '', '', array('class' => 'alert alert-danger')); ?>

				<div class="form-group">
					<?php echo $form->labelEx($model,'full_name',array('class'=>'col-sm-3 control-label')); ?>
					<div class="col-sm-9">
						<?php echo $form->textField($model,'full_name',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'full_name',array('class'=>'help-block')); ?>
					</div>
				</div>
				
				<div class="form-group">
					<?php echo $form->labelEx($model,'email',array('class'=>'col-sm-3 control-label')); ?>
					<div class="col-sm-9">
						<?php echo $form->emailField($model,'email',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'email',array('class'=>'help-block')); ?>
					</div>
				</div>
        
				<div class="form-group">
					<?php echo $form->labelEx($model,'password',array('class'=>'col-sm-3 control-label')); ?>
					<div class="col-sm-9">
						<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'password',array('class'=>'help-block')); ?>
					</div>
				</div>
				
				<div class="form-group">
					<?php echo $form->labelEx($model,'verifyPassword',array('class'=>'col-sm-3 control-label')); ?>
					<div class="col-sm-9">
						<?php echo $form->passwordField($model,'verifyPassword',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'verifyPassword',array('class'=>'help-block')); ?>
					</div>
				</div>

				<?php echo CHtml::submitButton('Register',array('class'=>'btn btn-lg btn-primary btn-block')); ?>

			</div>
		</div>
		
		<?php $this->endWidget(); ?>
		
</div>
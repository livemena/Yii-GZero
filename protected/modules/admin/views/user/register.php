<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
$this->layout='//layouts/column1';
?>

<div id="gz-login-form" class="omb_login">
	<h3 class="omb_authTitle">Sign up or <a href="<?php echo $this->createUrl('user/login'); ?>">Login</a></h3>
	<div class="row omb_row-sm-offset-3 omb_socialButtons">
		<div class="col-xs-4 col-sm-2">
			<a href="<?php echo $this->createUrl('user/login',array('service'=>'facebook')); ?>" class="btn btn-lg btn-block omb_btn-facebook">
				<i class="fa fa-facebook visible-xs"></i>
				<span class="hidden-xs">Facebook</span>
			</a>
		</div>
		<div class="col-xs-4 col-sm-2">
			<a href="<?php echo $this->createUrl('user/login',array('service'=>'twitter')); ?>" class="btn btn-lg btn-block omb_btn-twitter">
				<i class="fa fa-twitter visible-xs"></i>
				<span class="hidden-xs">Twitter</span>
			</a>
		</div>	
		<div class="col-xs-4 col-sm-2">
			<a href="#" class="btn btn-lg btn-block omb_btn-google">
				<i class="fa fa-google-plus visible-xs"></i>
				<span class="hidden-xs">Google+</span>
			</a>
		</div>	
	</div>
		<div class="row omb_row-sm-offset-3 omb_loginOr">
			<div class="col-xs-12 col-sm-6">
				<hr class="omb_hrOr">
				<span class="omb_spanOr">or</span>
			</div>
		</div>
				
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
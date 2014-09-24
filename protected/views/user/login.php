<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->layout='//layouts/column1';

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="row">
	<div class="col-md-8">
		<h1>Login</h1>

		<p>Please fill out the following form with your login credentials:</p>

		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
				'errorCssClass'=>'has-error',
			),
		)); ?>

			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<div class="form-group">
				<?php echo $form->labelEx($model,'email'); ?>
				<?php echo $form->textField($model,'email',array('class'=>"form-control",'placeholder'=>"Enter email")); ?>
				<?php echo $form->error($model,'email',array('class'=>'help-block')); ?>
			</div>

			<div class="form-group">
				<?php echo $form->labelEx($model,'password'); ?>
				<?php echo $form->passwordField($model,'password',array('class'=>"form-control",'placeholder'=>"Enter password")); ?>
				<?php echo $form->error($model,'password',array('class'=>'help-block')); ?>
				<p class="hint">
					Hint: You may login with <a href="javascript:;" onClick="$('#User_email').val('admin@admin.com');$('#User_password').val('123456');"><kbd>admin@admin.com</kbd>/<kbd>123456</kbd></a>.
				</p>
			</div>

			<div class="checkbox">
				<label>
					<input type="checkbox" checked value="1" id="User_rememberMe" name="User[rememberMe]"> Remember me next time
				</label>
			</div>

			<div class="buttons">
				<?php echo CHtml::submitButton('Login',array('class'=>'btn btn-primary')); ?>
				<div class="help-block"><a href="<?php echo $this->createUrl('user/forgotPassword'); ?>">Forgot your password ?</a></div>
			</div>

		<?php $this->endWidget(); ?>
		</div><!-- form -->
	</div>
	<div class="col-md-4">
		<p>
			<a href="<?php echo $this->createUrl('user/login',array('service'=>'facebook')); ?>" class="btn btn-facebook"> Login using facebook</a>
			&nbsp;&nbsp;
			<a href="<?php echo $this->createUrl('user/login',array('service'=>'twitter')); ?>" class="btn btn-twitter"> Login using twitter</a>
		</p>
		<p class="text-muted">OR</p>
		<p><a href="<?php echo $this->createUrl('user/register'); ?>">Register from here</a></p>
	</div>
</div>
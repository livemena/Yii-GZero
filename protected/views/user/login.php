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
<div id="gz-login-form" class="omb_login">
	<h3 class="omb_authTitle">Login or <a href="<?php echo $this->createUrl('user/register'); ?>">Sign up</a></h3>
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
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
			'errorCssClass'=>'has-error',
		),
	)); ?>
		<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-6">	

				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<?php echo $form->emailField($model,'email',array('class'=>"form-control",'placeholder'=>"Enter email")); ?>
					</div>
					<?php echo $form->error($model,'email',array('class'=>'help-block')); ?>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<?php echo $form->passwordField($model,'password',array('class'=>"form-control",'placeholder'=>"Enter password")); ?>
					</div>
					<?php echo $form->error($model,'password',array('class'=>'help-block')); ?>
				</div>
				
				<?php if(YII_DEBUG): ?>
				<p class="hint alert alert-info">
					<strong>Hint:</strong> You may login with <a href="javascript:;" onClick="$('#User_email').val('admin@admin.com');$('#User_password').val('123456');"><span class="label label-success">admin@admin.com</span> / <span class="label label-success">123456</span></a>
				</p>
				<?php endif; ?>

				<?php echo CHtml::submitButton('Login',array('class'=>'btn btn-lg btn-primary btn-block')); ?>

			</div>
		</div>
		<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-3">
				<div class="checkbox">
					<label>
						<input type="checkbox" checked value="1" id="User_rememberMe" name="User[rememberMe]"> Remember Me
					</label>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3">
				<p class="omb_forgotPwd">
					<a href="<?php echo $this->createUrl('user/forgotPassword'); ?>">Forgot password ?</a>
				</p>
			</div>
		</div>
		
		<?php $this->endWidget(); ?>
		
</div>

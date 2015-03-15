<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
$this->layout='//layouts/column1';

$this->pageTitle=Yii::app()->name . ' - Forgot Password';
$this->breadcrumbs=array(
	'Forgot Password',
);
?>
<div id="gz-login-form" class="omb_login">
	<h3 class="omb_authTitle">Forgot Password</a></h3>


  <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-forgotpassword-form',
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

  <?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
    }
  ?>

		<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-6">
      
      <?php echo $form->errorSummary($model); ?>

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-user"></i></span>
          <?php echo $form->emailField($model,'email',array('class'=>"form-control",'placeholder'=>"Enter email")); ?>
        </div>
        <?php echo $form->error($model,'email',array('class'=>'help-block')); ?>
      </div>

			<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary btn-block')); ?>

			</div>
		</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
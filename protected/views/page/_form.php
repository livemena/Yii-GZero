<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'clientOptions'=>array(
		'errorCssClass'=>'has-error',
	),
	'htmlOptions'=>array('class'=>'form-horizontal')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($model); ?>

    <ul class="nav nav-tabs" id="myTab">
      <li class="active"><a data-toggle="tab" href="#en">English</a></li>
      <li><a data-toggle="tab" href="#ar">Arabic</a></li>
    </ul>
	
	<br><br>
	
    <div class="tab-content" id="myTabContent">
      <div id="en" class="tab-pane active in fade">

		<div class="form-group">
			<?php echo $form->labelEx($model,'title_en',array('class'=>'col-sm-2 control-label')); ?>
			<div class="col-sm-10">
				<?php echo $form->textField($model,'title_en',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
				<?php echo $form->error($model,'title_en',array('class'=>'help-block')); ?>
			</div>
		</div>
	
		<div class="form-group">
			<?php echo $form->labelEx($model,'body_en',array('class'=>'col-sm-2 control-label')); ?>
			<div class="col-sm-10">
				<?php $this->widget('ImperaviRedactorWidget', array(
						'model'=>$model,
						'attribute'=>'body_en',
						'name' => 'body_en',
						'options'=>array(
							// 'lang'=>'ar',
						),
						'plugins'=>array(
							'fullscreen'=>array('js'=>array('fullscreen.js')),
						)
					)); 
				?>
				<?php echo $form->error($model,'body_en',array('class'=>'help-block')); ?>
			</div>
		</div>
	
      </div>
      <div id="ar" class="tab-pane fade">
	  
		<div class="form-group">
			<?php echo $form->labelEx($model,'title_ar',array('class'=>'col-sm-2 control-label')); ?>
			<div class="col-sm-10">
				<?php echo $form->textField($model,'title_ar',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
				<?php echo $form->error($model,'title_ar',array('class'=>'help-block')); ?>
			</div>
		</div>
	
		<div class="form-group">
			<?php echo $form->labelEx($model,'body_ar',array('class'=>'col-sm-2 control-label')); ?>
			<div class="col-sm-10">
				<?php $this->widget('ImperaviRedactorWidget', array(
						'model'=>$model,
						'attribute'=>'body_ar',
						'options'=>array(
							'direction'=>'rtl'
							// 'lang'=>'ar',
						),
						'plugins'=>array(
							'fullscreen'=>array('js'=>array('fullscreen.js')),
						)
					)); 
				?>
				<?php echo $form->error($model,'body_ar',array('class'=>'help-block')); ?>
			</div>
		</div>
	
      </div>
    </div>

	  <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary')); ?>
		</div>
	  </div>
	  
<?php $this->endWidget(); ?>

</div><!-- form -->
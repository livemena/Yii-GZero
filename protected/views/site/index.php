<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<h1>Hello World!</h1>
<?php if(!Yii::app()->user->isGuest){ ?>
<hr>
<h4>User info</h4>
	<?php echo Yii::app()->user->first_name; ?><br>
	<?php echo Yii::app()->user->email; ?><br>
	<?php echo Yii::app()->user->birth; ?><br>
<?php } ?>

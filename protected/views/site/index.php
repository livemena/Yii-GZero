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
	Is Admin: <?php echo var_dump(Yii::app()->user->checkAccess('admin')); ?><br>
	<hr>
<?php } ?>

<h4>Useful links</h4>
<ul>
	<li><a href="http://bootsnipp.com/" target="_blank" >Bootsnipp</a> Design elements, playground and code snippets for <a href="http://getbootstrap.com" target="_blank">Bootstrap</a> HTML/CSS/JS framework</li>
	<li><a href="http://yiiwheels.2amigos.us/" target="_blank" >YiiWheels</a> Wheels is an extension library for the <a href="http://yiiwheels.2amigos.us/" target="_blank" >YiiStrap</a> extension.</li>
</ul>
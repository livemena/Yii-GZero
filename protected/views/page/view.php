<?php
/* @var $this PageController */
/* @var $model Page */

$this->layout='column1';

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->title,
);
?>

<div class="page-header">
  <h1><?php echo $model->title; ?></h1>
</div>

<p>
	<?php echo $model->body; ?>
	
	<br><br>
	
	<?php echo $model->created_at; ?>
</p>

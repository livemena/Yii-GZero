<div id="header" class="navbar navbar-inverse navbar-static-top" role="navigation">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="#"><?php echo $this->config('name'); ?></a>
	</div>
	<div class="collapse navbar-collapse">
		<?php $this->widget('zii.widgets.CMenu',array(
			'htmlOptions'=>array('class'=>'nav navbar-nav'),
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/p/about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Pages', 'url'=>array('/page/index')),
				array('label'=>'SimpleMailer', 'url'=>array('/SimpleMailer'), 'visible'=>Yii::app()->user->isAdmin()),
				array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!--/.nav-collapse -->
  </div>
</div>
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
			'encodeLabel' => false,
			'items'=>array(
				array('label'=>Yii::t('app','home'), 'url'=>array('/site/index')),
				array('label'=>Yii::t('app','aboutus'), 'url'=>array('/p/about')),
				array('label'=>Yii::t('app','contact'), 'url'=>array('/site/contact')),
				array('label'=>Yii::t('app','admin').' <b class="caret"></b>',
					'itemOptions' => array('class' => 'dropdown'),
					'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
					'url'=>'#',
					'submenuOptions' => array('class' => 'dropdown-menu'),
					'visible'=>Yii::app()->user->isAdmin(),
					'items'=>array(
						array('label'=>'Messages', 'url'=>array('message/index')),
						array('label'=>'Page', 'url'=>array('/page/index')),
						array('label'=>'SimpleMailer', 'url'=>array('/SimpleMailer')),
					)),
				GZero::langSwitcher('menu'),
				array('label'=>Yii::t('app','login'), 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('app','logout').' ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!--/.nav-collapse -->
  </div>
</div>
<div id="header" class="navbar navbar-inverse navbar-static-top" role="navigation">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="<?php echo $this->createUrl('site/index'); ?>"><?php echo Yii::app()->name ?></a>
	</div>
	<div class="collapse navbar-collapse">
		<?php $this->widget('zii.widgets.CMenu',array(
			'htmlOptions'=>array('class'=>'nav navbar-nav'),
			'encodeLabel' => false,
			'items'=>array(
				array('label'=>Yii::t('app','home'), 'url'=>array('site/index')),
				array('label'=>Yii::t('app','documentation'), 'url'=>array('site/documentation')),
				array('label'=>Yii::t('app','aboutus'), 'url'=>array('page/view','slug'=>'about')),
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
						array('label'=>'Gii', 'url'=>array('/gii'),'linkOptions'=>array('target'=>'_blank')),
					)),
				array('label'=>Yii::t('app','user').' <b class="caret"></b>',
					'itemOptions' => array('class' => 'dropdown'),
					'linkOptions' => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'),
					'url'=>'#',
					'submenuOptions' => array('class' => 'dropdown-menu'),
					'visible'=>!Yii::app()->user->isGuest,
					'items'=>array(
						array('label'=>'Update', 'url'=>array('user/update')),
						array('label'=>'Manage', 'url'=>array('user/admin'),'visible'=>Yii::app()->user->isAdmin()),
						array('label'=>'<i class="fa fa-power-off"></i> Logout', 'url'=>array('user/logout')),
					)),
				array('label'=>Yii::t('app','login'), 'url'=>array('user/login'), 'visible'=>Yii::app()->user->isGuest),
				GZero::langSwitcher('menu')
			),
		)); ?>
	</div><!--/.nav-collapse -->
  </div>
</div>
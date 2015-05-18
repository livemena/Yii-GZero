<?php
	/* @var $this SiteController */
	$this->pageTitle=Yii::app()->name;
?>

<?php // echo Yii::app()->facebook->getLoginUrl() ?>
<div class="header clearfix">
	<nav>
		<ul class="nav nav-pills pull-right">
			<li role="presentation" class="active"><a href="<?php echo $this->createUrl('site/index'); ?>">Home</a></li>
			<li role="presentation"><a href="<?php echo $this->createUrl('page/view',array('slug'=>'about')); ?>">About</a></li>
			<li role="presentation"><a href="<?php echo $this->createUrl('site/contact'); ?>">Contact</a></li>
			<?php if(Yii::app()->user->isAdmin()): ?>
			<li role="presentation"><a href="<?php echo $this->createUrl('admin/default'); ?>">Admin</a></li>
			<?php endif; ?>
			<?php if(Yii::app()->user->isGuest): ?>
			<li role="presentation"><a href="<?php echo $this->createUrl('user/login'); ?>">Login</a></li>
			<?php else: ?>
			<li role="presentation"><a href="<?php echo $this->createUrl('user/logout'); ?>">Logout</a></li>
			<?php endif; ?>
		</ul>
	</nav>
	<h3 class="text-muted">Yii-GZero 1.1</h3>
</div>


<div class="jumbotron">
	<h1>Yii-Gzero</h1>
	<h2>Base for your startup's using Yii &amp; Bootstrap</h2>
	<p class="lead">It is simple integration/base of back-end and front-end frameworks<br>for fast start your projects.</p>
	<a class="btn btn-large btn-success" href="<?php echo $this->createUrl('site/documentation'); ?>"><span class="glyphicon glyphicon-chevron-right"></span> Getting Started</a>
</div>

<div class="row marketing">
	<div class="col-lg-6">
		<h4>Auth/Registration</h4>
		<p>Support auth/registration/recovery implemented as a module.</p>

		<h4>User profile</h4>
		<p>Possible for view and edit user profile implemented as a module.</p>

		<h4>Yii RBAC</h4>
		<p>Simple Yii role based access control for web application.</p>
	</div>

	<div class="col-lg-6">
		<h4>Admin panel</h4>
		<p>Base for create own admin panel implemented as a module.</p>

		<h4>E-mail notices</h4>
		<p>Integrated extension YiiMailer for support E-mail notices.</p>

		<h4>Comfortable architecture</h4>
		<p>Modular architecture for easy development and scaling.</p>
	</div>
</div>

<style>
/* Space out content a bit */
body {
  padding-top: 20px;
  padding-bottom: 20px;
}

/* Everything but the jumbotron gets side spacing for mobile first views */
.header,
.marketing,
.footer {
  padding-right: 15px;
  padding-left: 15px;
}

/* Custom page header */
.header {
  padding-bottom: 20px;
  border-bottom: 1px solid #e5e5e5;
}
/* Make the masthead heading the same height as the navigation */
.header h3 {
  margin-top: 0;
  margin-bottom: 0;
  line-height: 40px;
}

/* Custom page footer */
.footer {
  padding-top: 19px;
  color: #777;
  border-top: 1px solid #e5e5e5;
}

/* Customize container */
@media (min-width: 768px) {
  .container {
    max-width: 730px;
  }
}
.container-narrow > hr {
  margin: 30px 0;
}

/* Main marketing message and sign up button */
.jumbotron {
  text-align: center;
  border-bottom: 1px solid #e5e5e5;
	padding: 40px 35px !important;
	
}
.jumbotron .btn {
  padding: 14px 24px;
  font-size: 21px;
}

/* Supporting marketing content */
.marketing {
  margin-top: 40px;
  margin-bottom: 40px;
}
.marketing p + h4 {
  margin-top: 28px;
}

/* Responsive: Portrait tablets and up */
@media screen and (min-width: 768px) {
  /* Remove the padding we set earlier */
  .header,
  .marketing,
  .footer {
    padding-right: 0;
    padding-left: 0;
  }
  /* Space out the masthead */
  .header {
    margin-bottom: 30px;
  }
  /* Remove the bottom border on the jumbotron for visual effect */
  .jumbotron {
    border-bottom: 0;
  }
}
</style>
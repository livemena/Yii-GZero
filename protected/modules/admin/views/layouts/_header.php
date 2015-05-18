<nav class="navbar navbar-static-top navbar-default sidebar" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li>
					<a href="<?php echo $this->createUrl('default/index'); ?>">Dash <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-tachometer"></span></a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Content <span class="caret"></span> <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-database"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo $this->createUrl('category/admin'); ?>">Categories</a></li>
						<li><a href="<?php echo $this->createUrl('page/index'); ?>">Pages</a></li>
					</ul>
				</li>
				<li>
					<a href="<?php echo $this->createUrl('user/admin'); ?>">Users <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-users"></span></a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">System <span class="caret"></span> <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-cog"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo $this->createUrl('message/index'); ?>">Messages</a></li>
						<li><a target="_blank" href="<?php echo $this->createUrl('/gii'); ?>">Gii</a></li>
					</ul>
				</li>
				<li>
					<a href="<?php echo $this->createUrl('//site/index'); ?>">www <span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-globe"></span></a>
				</li>
				<li>
					<a href="<?php echo $this->createUrl('//user/logout'); ?>">Logout<span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-power-off"></span></a>
				</li>
			</ul>
    </div>
  </div>
</nav>
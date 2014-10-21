<header class="header fixed-top clearfix">
	<div class="brand">
		<?php echo anchor('','<img src="'.$this->admin_theme->path.'/img/logo.png" alt="KuboCMS">', 'class="logo" target="_blank"') ?>
	    <div class="sidebar-toggle-box">
	        <div class="fa fa-bars"></div>
	    </div>
	</div>
	
	<div class="top-nav clearfix">
	    <!--search & user info start-->
	    <ul class="nav pull-right top-menu">
	        <!-- user login dropdown start-->
	        <li class="dropdown">
	            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
	                <img alt="" src="<?php echo $this->admin_theme->path; ?>/img/avatar1_small.png">
	                <span class="username"><?= $this->current_user->username ?></span>
	                <b class="caret"></b>
	            </a>
	            <ul class="dropdown-menu extended logout">
	                <li><a href="admin/profile"><i class=" fa fa-suitcase"></i>Editar perfil</a></li>
	                <li><a href="admin/logout"><i class="fa fa-key"></i>Cerrar sesión</a></li>
	            </ul>
	        </li>
	       
	    </ul>
	    <!--search & user info end-->
	</div>
</header>
<aside>
	<?php file_partial('navigation') ?>
</aside>
<?php if ( ! empty($module_details['sections'])) file_partial('sections') ?>

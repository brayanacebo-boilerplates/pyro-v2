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
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="<?php echo $this->admin_theme->path; ?>/img/avatar1_small.jpg">
                <span class="username"><?= $this->current_user->username ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="edit-profile"><i class=" fa fa-suitcase"></i>Editar perfil</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="admin/logout"><i class="fa fa-key"></i>Cerrar sesión</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
        <li>
            <div class="toggle-right-box">
                <div class="fa fa-bars"></div>
            </div>
        </li>
    </ul>
    <!--search & user info end-->
</div>
</header>
<aside>
	<?php file_partial('navigation') ?>
</aside>
<!-- <noscript>
	<span>PyroCMS requires that JavaScript be turned on for many of the functions to work correctly. Please turn JavaScript on and reload the page.</span>
</noscript> -->

<!-- <div class="topbar" dir=<?php //$vars = $this->load->get_vars(); echo $vars['lang']['direction'] ?>>
	<div class="topbar-inner">
		<div class="wrapper">
			<div id="logo">
				<!-- <?php //echo anchor('', Asset::img('logo.png', 'view site'), 'target="_blank"') ?>
				<?php //echo anchor('','<span id="pyro-logo"></span>', 'target="_blank"') ?>
			</div>
		
			<nav id="primary">
				<?php //file_partial('navigation') ?>
			</nav>
			
			<div class="topbar-form">
				<form class="topbar-search">
					<input type="text" class="search-query" id="nav-search" placeholder="<?php //echo lang("cp:search"); ?>" ontouchstart="">
				</form>
			</div>
			
		</div>
	</div>
	
</div> -->

<!-- <div class="subbar">
	<div class="wrapper">
		<div class="subbar-inner">
			<h2><?php //echo $module_details['name'] ? anchor('admin/'.$module_details['slug'], $module_details['name']) : lang('global:dashboard') ?></h2>
		
			<small>
				<?php //if ( $this->uri->segment(2) ) { echo '<span class="divider">&nbsp; | &nbsp;</span>'; } ?>
				<?php //echo $module_details['description'] ? $module_details['description'] : '' ?>
				<?php //if ( $this->uri->segment(2) ) { echo '<span class="divider">&nbsp; | &nbsp;</span>'; } ?>
				<?php //if($module_details['slug']): ?>
				<?php //echo anchor('admin/help/'.$module_details['slug'], lang('help_label'), array('title' => $module_details['name'].'&nbsp;'.lang('help_label'), 'class' => 'modal')); ?>
				<?php //endif; ?>
			</small>
			
			<?php file_partial('shortcuts') ?>
	
		</div>
	</div>
</div> -->

<?php if ( ! empty($module_details['sections'])) file_partial('sections') ?>

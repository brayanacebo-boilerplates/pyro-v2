<!doctype html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]> <html class="no-js" lang="en"> 		   <![endif]-->

<head>
	<meta charset="utf-8">

	<!-- You can use .htaccess and remove these lines to avoid edge case issues. -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo $template['title'].' - '.lang('cp:admin_title') ?></title>

	<base href="<?php echo base_url(); ?>" />

	<!-- Mobile viewport optimized -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<!-- CSS. No need to specify the media attribute unless specifically targeting a media type, leaving blank implies media=all -->
	<?php echo Asset::css('plugins.css'); ?>
	<?php echo Asset::css('workless/workless.css'); ?>
	<?php echo Asset::css('workless/application.css'); ?>
	<?php echo Asset::css('workless/responsive.css'); ?>
    <?php echo Asset::css('ezmark/css/ezmark.css'); ?>
    
    <?php echo Asset::css('workless/webarch.css'); ?>
    
        <?php
        $vars = $this->load->_ci_cached_vars;
        if ($vars['lang']['direction']=='rtl'){
            echo Asset::css('workless/rtl/rtl.css');
        }
        ?>
	<!-- End CSS-->

	<!-- Load up some favicons -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png">
	<link rel="apple-touch-icon" href="apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" href="apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" href="apple-touch-icon-114x114-precomposed.png">

	<!-- metadata needs to load before some stuff -->
	<?php file_partial('metadata'); ?>
    
    

</head>

<body>
	
    <div class="main-menu">
        <div class="topbar" dir=<?php $vars = $this->load->get_vars(); echo $vars['lang']['direction'] ?>>
            <div class="topbar-inner">
                <div class="wrapper">
                    <div id="logo">
                        <?php echo anchor('', Asset::img('logo-imaginamos-white.png', 'view site'), 'target="_blank"') ?>
                        <!--<?php echo anchor('','<span id="pyro-logo"></span>', 'target="_blank"') ?> -->
                    </div>
                
                    <nav id="primary">
                        <?php file_partial('navigation') ?>
                    </nav>
                    
                    
                </div>
            </div>
            
        </div>
    
    </div>
	
    <div class="main-content">
        <div id="container">
    
            <section id="content">
                
                <header class="hide-on-ckeditor-maximize">
                <?php file_partial('header'); ?>
                </header>
    
                <div id="content-body">
                    <?php file_partial('notices'); ?>
                    <?php echo $template['body']; ?>
                </div>
    
            </section>
    
        </div>
    
        <footer class="clearfix">
            <div class="wrapper">
                <!--<p class="credits">Copyright &copy; <?php echo date('Y'); ?> FireSale &nbsp; <span>Version <?php echo FS_VERSION; ?> &nbsp; Rendered in {elapsed_time} sec. using {memory_usage}.</span></p> -->
    			<div class="footer-autor"><span id="ahorranito2"></span><a href="http://www.imaginamos.com" target="_blank">Diseño Web</a><div>:</div><a href="http://www.imaginamos.com" target="_blank">imagin<span>a</span>mos.com</a></div>
                <ul id="lang">
                    <form action="<?php echo current_url(); ?>" id="change_language" method="get">
                        <select class="chzn" name="lang" onchange="this.form.submit();">
                            <?php foreach(config_item('supported_languages') as $key => $lang): ?>
                                <option value="<?php echo $key; ?>" <?php echo CURRENT_LANGUAGE == $key ? ' selected="selected" ' : ''; ?>>
                                     <?php echo $lang['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </ul>
            </div>
        </footer>
	</div>
    
    <div class="second-nav">
    	<div class="topbar-form">
            <form class="topbar-search">
                <input type="text" class="search-query" id="nav-search" placeholder="<?php echo lang("cp:search"); ?>" ontouchstart="">
            </form>
        </div>
    	<ul class="secondary-nav">
			<?php foreach ($module_details['sections'] as $name => $section): ?>
			<?php if(isset($section['name']) && isset($section['uri'])): ?>
			<li class="<?php if ($name === $active_section) echo 'current' ?>">
				<?php echo anchor($section['uri'], (lang($section['name']) ? lang($section['name']) : $section['name'])); ?>
				<?php if ($name === $active_section): ?>
					<!-- <?php echo Asset::img('admin/section_arrow.png', ''); ?> -->
				<?php endif; ?>
			</li>
			<?php endif; ?>
			<?php endforeach; ?>
		</ul>
        <?php file_partial('shortcuts') ?>
    </div>
    
    <div class="clear"></div>
	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6. chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
	<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->

</body>
</html>
<style>
.sections_bar{
	left: 240px;
	width: 100%;
	background-color: #4C525E;
	border: 0 none;
	height: auto;
	position: fixed;
	right: 0px;
	top: 80px !important;
	display: block;
	margin: 0;
	z-index: 9999;
	border-bottom: 1px solid;
}
.sections_bar ul li{
	display: inline-block;
	padding: 8px 4px; 
	margin: 0 0 -10px 20px;
}
.sections_bar ul li.current a, .sections_bar ul li a:hover{
	color: #FFFFFF;
}
.sections_bar a{
	color: #858585;
}
</style>
<div class="sections_bar">
		<ul>
			<?php foreach ($module_details['sections'] as $name => $section): ?>
			<?php if(isset($section['name']) && isset($section['uri'])): ?>
			<li class="<?php if ($name === $active_section) echo 'current' ?>">
				<?php echo anchor($section['uri'], (lang($section['name']) ? lang($section['name']) : $section['name'])); ?>
				<?php if ($name === $active_section): ?>
			<?php endif; ?>
			</li>
			<?php endif; ?>
			<?php endforeach; ?>
		</ul>
</div>
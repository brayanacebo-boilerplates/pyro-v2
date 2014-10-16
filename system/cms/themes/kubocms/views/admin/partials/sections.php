<!-- Se elimina los campos personalizados del menu secundario del blog -->
<?php unset($module_details['sections']['fields']); ?>
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
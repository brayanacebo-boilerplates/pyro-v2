<div id="sidebar" class="nav-collapse">
	<div class="leftside-navigation">
		<ul class="sidebar-menu" id="nav-accordion">
			<li>
				<a class="active" href="admin">
					<i class="fa fa-dashboard"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<?php 

			// Display the menu items.
			// We have already vetted them for permissions
			// in the Admin_Controller, so we can just
			// display them now.
			foreach ($menu_items as $key => $menu_item)
			{
				if (is_array($menu_item))
				{
					echo '<li class="sub-menu">
					<a href="'.current_url().'#">
					<i class="fa fa-angle-double-right"></i>
					<span>'.lang_label($key).'</span>
					</a>
					<ul class="sub">';

					foreach ($menu_item as $lang_key => $uri)
					{
						echo '<li>
						<a href="'.site_url($uri).'">'.lang_label($lang_key).'</a>
						</li>';

					}

					echo '</ul></li>';

				}
				elseif (is_array($menu_item) and count($menu_item) == 1)
				{
					foreach ($menu_item as $lang_key => $uri)
					{
						echo '<li>
						<a href="'.site_url($menu_item).'">
						<i class="fa fa-angle-double-right"></i>
						<span>'.lang_label($key).'</span>
						</a>
						</li>';
					}
				}
				elseif (is_string($menu_item))
				{
					echo '<li>
					<a href="'.site_url($menu_item).'">
					<i class="fa fa-angle-double-right"></i>
					<span>'.lang_label($key).'</span>
					</a>
					</li>';
				}

			}
			
			?>
		</ul>
	</div>
</div>
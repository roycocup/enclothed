<header class="banner container" role="banner">
  <div class="row">
    <div id="logo"></div>
    <div class="navbar-header">
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<button class="navbar-toggle btn navbar-btn" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			<!-- END RESPONSIVE MENU TOGGLER -->
	</div>
	<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="navbar-collapse collapse">
				<?php
                  if (has_nav_menu('primary_navigation')) :
                    wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
                  endif;
                ?>
		</div>
	<!-- BEGIN TOP NAVIGATION MENU -->
  </div> 
</header>

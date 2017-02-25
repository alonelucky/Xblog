    <body>
        <!--[if lte IE 7]>
            <p class="chromeframe">您在使用老旧浏览器。请到 <a href="http://browsehappy.com/">这里</a> 更新，以获得最好的体验。</p>
        <![endif]-->
		<header class="clearfix">
			<div class="container">
				<h1><a href="<?php bloginfo('url');?>"><span class="logo-sapn"><?php bloginfo('name');?></span><img src="<?php bloginfo('stylesheet_directory');?>/img/logo_45.png" alt="<?php bloginfo('name');?>" title="<?php bloginfo('name');?>"></a></h1>
				<h2><?php bloginfo('name');?></h2>
				<p><?php bloginfo('description');?></p>
				
			</div>
		</header>
		<nav class="navar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar">
						<span class="sr-only">折叠菜单</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<?php wp_nav_menu(array(
						'theme_location'  => 'header_menu',
						'container'       => 'div',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'main-navbar',
						'menu_class'      => 'nav navbar-nav center-block',
						'menu_id'         => 'manu-nav',
						'echo'            => ture,
						'fallback_cb'     => 'wp_page_menu',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0,
				));?>
			</div>
		</nav>
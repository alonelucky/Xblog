<div class="wrap">
	<h2><?php _e('Theme Options','Xblog');?></h2>
	<ul class="option-nav">
		<li class="active">基本信息</li>
		<li>站点设置</li>
	</ul>
	<div>
		<div class="content active">
			<form action="options.php" method="post">
				<?php
					$group = 'Xblog_group_1';
					settings_fields($group);
					do_settings_sections($group);
					submit_button(__('Submit','Xblog'));
				?>
			</form>
		</div>
		<div class="content hidden">
			<form action="options.php" method="post">
				<?php
					$group = 'Xblog_group_2';
					settings_fields($group);
					do_settings_sections($group);
					submit_button(__('Submit','Xblog'));
				?>
			</form>
		</div>
	</div>

</div>
<?php
	//获取当前屏幕   appearance_page_Xblog_theme_options
	$screen = get_current_screen();
	if(is_object($screen)&&$screen->id == 'appearance_page_Xblog_theme_options'){
		?>
			<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory');?>/css/options.css">
			<script src="<?php echo get_bloginfo('stylesheet_directory');?>/js/options.js"></script>
		<?php
	}
?>
<?php

	function Xblog_register_options(){
		//注册设置群组,及字段
		register_setting(
			'Xblog_group_1',
			'Xblog_options_1'
		);
		
		register_setting(
			'Xblog_group_2',
			'Xblog_options_2'
		);
	}
	add_action('admin_init','Xblog_register_options');
	function Xblog_theme_options_fun(){
		
		$Xblog_group_1 = 'Xblog_group_1';
		$Xblog_options_1 = 'Xblog_options_1';
		$Xblog_area_1 = 'Xblog_area_1';

		//添加选项区域
		//参数1   选项区域
		add_settings_section(
			$Xblog_area_1,
			'',
			'',
			$Xblog_group_1
		);
		
		//增加选项
		add_settings_field(
			'Xblog_sidebar_name',
			__('Sidebar blogger name','Xblog'),
			'Xblog_sidebar_name_fun',
			$Xblog_group_1,
			$Xblog_area_1
		);
		
		//增加选项
		add_settings_field(
			'Xblog_sidebar_head_img',
			__('Sidebar blogger images','Xblog'),
			'Xblog_sidebar_head_img_fun',
			$Xblog_group_1,
			$Xblog_area_1
		);
		
		//增加选项
		add_settings_field(
			'Xblog_sidebar_description',
			__('Sidebar blogger description','Xblog'),
			'Xblog_sidebar_description_fun',
			$Xblog_group_1,
			$Xblog_area_1
		);
		
		//增加选项
		add_settings_field(
			'Xblog_sidebar_weibo',
			__('Weibo link','Xblog'),
			'Xblog_sidebar_weibo_fun',
			$Xblog_group_1,
			$Xblog_area_1
		);
		
		//增加选项
		add_settings_field(
			'Xblog_sidebar_github',
			__('Github link','Xblog'),
			'Xblog_sidebar_github_fun',
			$Xblog_group_1,
			$Xblog_area_1
		);
		
		//增加选项
		add_settings_field(
			'Xblog_sidebar_facebook',
			__('Facebook link','Xblog'),
			'Xblog_sidebar_facebook_fun',
			$Xblog_group_1,
			$Xblog_area_1
		);
		
		//增加选项
		add_settings_field(
			'Xblog_sidebar_twitter',
			__('Twitter link','Xblog'),
			'Xblog_sidebar_twitter_fun',
			$Xblog_group_1,
			$Xblog_area_1
		);
		
		$Xblog_group_2 = 'Xblog_group_2';
		$Xblog_options_2 = 'Xblog_options_2';
		$Xblog_area_2 = 'Xblog_area_2';
		
		add_settings_section(
			$Xblog_area_2,
			'',
			'',
			$Xblog_group_2
		);
		
		//增加选项
		add_settings_field(
			'Xblog_Analytics',
			__('Analytics','Xblog'),
			'Xblog_Analytics_fun',
			$Xblog_group_2,
			$Xblog_area_2
		);
		
		//增加选项
		add_settings_field(
			'Xblog_self_style',
			__('Self style','Xblog'),
			'Xblog_self_style_fun',
			$Xblog_group_2,
			$Xblog_area_2
		);
		
		//增加选项
		add_settings_field(
			'Xblog_self_script',
			__('Self Script','Xblog'),
			'Xblog_self_script_fun',
			$Xblog_group_2,
			$Xblog_area_2
		);
		
		
		//引入主题视图文件
		include('Xblog_options_views.php');
	}
	
	function Xblog_sidebar_name_fun(){
		?>
		<input type="text" name="Xblog_options_1[sidebar_name]" id="Xblog_options_1[sidebar_name]" value="<?php echo get_option('Xblog_options_1')['sidebar_name'];?>">
		<?php
	}
	
	function Xblog_sidebar_head_img_fun(){
		?>
		<input type="text" class="options_1" name="Xblog_options_1[sidebar_head_img]" id="Xblog_options_1[sidebar_head_img]" value="<?php echo get_option('Xblog_options_1')['sidebar_head_img'];?>">
		<?php
	}
	
	function Xblog_sidebar_description_fun(){
		?>
		<textarea name="Xblog_options_1[sidebar_description]" class="options_1" id="Xblog_options_1[sidebar_description]" cols="50" rows="5"><?php echo get_option('Xblog_options_1')['sidebar_description']?></textarea>
		<?php
	}
	
	function Xblog_sidebar_weibo_fun(){
		?>
		<input type="text" class="options_1" name="Xblog_options_1[weibo]" id="Xblog_options_1[weibo]" value="<?php echo get_option('Xblog_options_1')['weibo'];?>">
		<?php
	}
	
	function Xblog_sidebar_github_fun(){
		?>
		<input type="text" class="options_1" name="Xblog_options_1[github]" id="Xblog_options_1[github]" value="<?php echo get_option('Xblog_options_1')['github'];?>">
		<?php
	}
	
	function Xblog_sidebar_facebook_fun(){
		?>
		<input type="text" class="options_1" name="Xblog_options_1[facebook]" id="Xblog_options_1[facebook]" value="<?php echo get_option('Xblog_options_1')['facebook'];?>">
		<?php
	}
	
	function Xblog_sidebar_twitter_fun(){
		?>
		<input type="text" class="options_1" name="Xblog_options_1[twitter]" id="Xblog_options_1[twitter]" value="<?php echo get_option('Xblog_options_1')['twitter'];?>">
		<?php
	}
	
	function Xblog_Analytics_fun(){
		?>
		<textarea name="Xblog_options_2[Analytics]" class="options_1" id="Xblog_options_2[Analytics]" cols="50" rows="5"><?php echo get_option('Xblog_options_2')['Analytics']?></textarea>
		<?php
	}
	
	function Xblog_self_style_fun(){
		?>
		<textarea name="Xblog_options_2[self_style]" class="options_1" id="Xblog_options_2[self_style]" cols="50" rows="5"><?php echo get_option('Xblog_options_2')['self_style']?></textarea>
		<?php
	}
	
	function Xblog_self_script_fun(){
		?>
		<textarea name="Xblog_options_2[self_script]" class="options_1" id="Xblog_options_2[self_script]" cols="50" rows="5"><?php echo get_option('Xblog_options_2')['self_script']?></textarea>
		<?php
	}

?>

    
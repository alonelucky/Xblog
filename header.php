<?php
	global $post;
	if(!$_COOKIE[$post->ID]){
		setcookie($post->ID,1);
	}
?>
<!doctype html>
<!-- [if lt IE 7]-->
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="zh-CN"></html>
<!-- [endif]-->
<!-- [if IE 7]-->
<html class="no-js lt-ie9 lt-ie8"  lang="zh-CN"></html>
<!-- [endif]-->
<!-- [if IE 8]-->
<html class="no-js lt-ie9"  lang="zh-CN"></html>
<!-- [endif]-->
<!-- [if gt IE 8]--><!-->
<html class="no-js"  lang="zh-CN"></html>
<!-- [endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php Xblog_name();?></title>
        <meta name="keywords" content="<?php  Xblog_keywords();?>" />    
        <meta name="description" content="<?php Xblog_description();?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0，maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="Cache-Control" content="no-siteapp" />		
        <!-- Place favicon.ico in the root directory -->
		<link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>?v1.0">
		<?php 
			if(is_single()){
				?>
				<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/css/single.css">
				<?php
			}
		?>
		<?php
			if(is_page('liuyan')){
				?>
				<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/css/liuyan.css">
				<?php
			}
		?>
		<script src="//cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
		<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<?php wp_head();?>
    </head>
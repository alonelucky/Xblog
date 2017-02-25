<!--侧边展示栏-->
<div class="col-md-3">
<!--个人信息展示栏-->
<?php if(!is_single()||!is_page()){?>
<div class="thumbnail">
	<img src="<?php bloginfo('stylesheet_directory');?>/tile.png" class="img-circle" width="50%" alt="">
	<div class="caption">
		<h3><?php echo get_the_author_meta('nickname');?></h3>
		<p><?php echo get_the_author_meta('description');?></p>
		<p>
			<a href="#" class="btn btn-default">微博</a>
			<a href="#" class="btn btn-default">Github</a>
			<a href="#" class="btn btn-default">微信</a>
		</p>
	</div>
</div>
<?php }?>
<?php 
	if( is_dynamic_sidebar() ) {
		dynamic_sidebar('近期文章');
	}else{
		echo '没有启用小工具栏';
}?>
</div>
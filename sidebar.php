<!--侧边展示栏-->
<div class="col-md-3">
<!--个人信息展示栏-->
<?php 
if(!is_single()||!is_page()){
		$items = get_option('Xblog_options_1');
	?>

<div class="thumbnail">
	<img src="<?php 
		if($items['sidebar_head_img']){
			echo $items['sidebar_head_img'];
		}else{
			echo get_bloginfo('stylesheet_directory').'/tile.png';
		}
	?>" class="img-circle" width="50%" alt="">
	<div class="caption">
		<h3><?php 
			if($items['sidebar_name']){
				echo $items['sidebar_name'];
			}else{
				echo get_bloginfo('name');
			}
		?></h3>
		<p><?php 
			if($items['sidebar_description']){
				echo $items['sidebar_description'];
			}else{
				echo get_bloginfo('description');
			}
		?></p>
		<p>
			<?php 
				if($items['weibo']){
					?>
						<a href="<?php echo $items['weibo'];?>" class="btn btn-default">微博</a>
					<?php
				}
				if($items['github']){
					?>
						<a href="<?php echo $items['github'];?>" class="btn btn-default">github</a>
					<?php
				}
				if($items['facebook']){
					?>
						<a href="<?php echo $items['facebook'];?>" class="btn btn-default">Facebook</a>
					<?php
				}
				if($items['twitter']){
					?>
						<a href="<?php echo $items['twitte'];?>" class="btn btn-default">Twitte</a>
					<?php
				}
			?>
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
<?php get_header();?>
<?php get_header('nav');?>
		<!--主体内容-->
		<main role="main">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<!--博客文章输出-->
						<?php 
							if( have_posts() ){
								global $post;
								while ( have_posts() ){
									the_post();
						?>
						<div class="panel panel-primary">
							<!--博客文章标题-->
							<h3 class="panel-heading post-title">
								<a href="<?php the_permalink();?>">
								<?php 
									the_title();
								?>
								</a>
							</h3>
							<div class="panel-body">
								<div class="media">
									<!--博客文章图片-->
									<a href="<?php the_permalink();?>" class="media-left">
									<?php 
									if( has_post_thumbnail()){
										the_post_thumbnail(array(200,200));
									}else{?>
										 <img src="<?php bloginfo('stylesheet_directory');?>/img/xys.png" width="200" alt="">
									<?php }
									?>
										
									</a>
									<!--博客文章内容-->
									<div class="media-body post-content">
										<?php 
										if( empty(has_excerpt()) ){
											echo '<h5>文章摘要:</h5>';
											echo '<p>'.mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 700,"......").'</p>'; 
										}else{
											echo '<h5>文章摘要:</h5>';
											the_excerpt();
										}

										?>
									</div>
								</div>
							</div>
							<!--博客文章相关内容-->
							<div class="panel-footer">
									<?php _e('Tags :','Xblog');?><span><?php the_category();?></span>
									<a href="<?php the_permalink();?>" class="pull-right"><?php _e('Read more','Xblog');?></a>
							</div>
						</div>
						<?php
								}//文章循环结束
							}else{
								_e('This website is nothing,please contact Admin of this website! ','Xblog');
							}		
						?>
						<!--文章列表分页-->
						<nav class="center-block">
							<ul class="pager">
								<?php 
									Xblog_posts_nav_link('disabled','previous','next');
								?>
							</ul>
						</nav>
					</div>
<?php get_sidebar();?>
				</div>
			</div>
		</main> 
<?php get_footer();?>
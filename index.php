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
								<?php 
									if(get_post_meta(get_the_ID(),'views',true)>20){
										?>
										<span class="glyphicon glyphicon-fire" style="color:white"></span>
										<?php
									}
								?>
								<a href="<?php the_permalink();?>"><?php the_title();?></a>
							</h3>
							<div class="panel-body">
								<div class="media">
									
									<!--博客文章内容-->
									<div class="media-body post-content">
										<!--博客文章图片-->
										<a href="<?php the_permalink();?>" class="media-left">
										<?php 
											//输出文章特色图像 如果没有则输出默认图像
										if( has_post_thumbnail()){
											the_post_thumbnail(array(200,200));
										}else{?>
											<img src="<?php bloginfo('stylesheet_directory');?>/img/xys.png" width="200" alt="">
										<?php }
										?>
											
										</a>
										<h5>文章摘要:</h5>
										<?php 
										// 如果没有文章摘要则截取文章前700字符
										if( empty(has_excerpt()) ){
											echo '<p>'.mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 700,"......").'</p>'; 
										}else{
											the_excerpt();
										}

										?>
									</div>
								</div>
							</div>
							<!--博客文章相关内容-->
							<div class="panel-footer">
									<i class="glyphicon glyphicon-tags"></i> <span> <?php the_category(',');?></span>
									<a href="<?php the_permalink();?>" class="pull-right"><?php _e('Read more','Xblog');?> <i class="glyphicon glyphicon-arrow-right"></i></a> 
							</div>
						</div>
						<?php
								}//文章循环结束
							}else{
								_e('This website is nothing,please contact Admin of this website! ','Xblog');
							}		
						?>
						<!--文章列表分页-->
						<nav class="text-center">
							<ul class="pagination">
								<?php 
									global $wp_query;
									$big = 9999999;
										//参数1   (字符串)连接
										//参数2   (字符串)连接格式
										//参数3   (数值)显示的页数
										//参数4   (数值)当前页数
										//参数5   (布尔值)是否显示所有页数  默认不显示
										//参数6   (数值)首页和尾页附近(含自身)显示的页面数量 ,最少为1
										//参数7   (布尔值)是否显示上一页和下一页 
										//参数8   (字符串)上一页的显示文本
										//参数9   (字符串)下一页的显示文本
										//参数10  (字符串)返回值的格式:'panin':字符串,'array':数组,'list':HTML无序列表
										//参数11  (布尔值)
										//参数12  为连接添加字符串
										//参数13  页面文字前增加字符串
										//参数14  页面文本后增加字符串
									$arr=array(
										'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
										'format'             => '?page=%#%',
										'total'              => $wp_query->max_num_pages,
										'current'            => max( 1, get_query_var('paged') ),
										'show_all'           => False,
										'end_size'           => 1,
										'mid_size'           => 2,
										'prev_next'          => True,
										'prev_text'          => __('« Previous'),
										'next_text'          => __('Next »'),
										'type'               => 'array',
										'add_args'           => False,
										'add_fragment'       => '',
										'before_page_number' => '第 ',
										'after_page_number'  => ' 页'
									);
									$links = paginate_links($arr);
									foreach($links as $link):

									if(strpos($link,'current')){
										?>
											<li class="active"><?php echo $link;?></li>
										<?php
									}else{
										?>
											<li><?php echo $link;?></li>										
										<?php
									}

									endforeach;
								?>
							</ul>
						</nav>
					</div>
<?php get_sidebar();?>
				</div>
			</div>
		</main> 
<?php get_footer();?>
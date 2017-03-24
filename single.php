<?php 
	get_header();
	get_header( 'nav' );
?>
		<!--主体内容-->
		<main role="main">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
                        <!--面包屑导航-->
                        <?php xblog_breadcrumbs();?>
						<!--博客文章输出-->
						<?php
							if(have_posts()){
								while(have_posts()){
									the_post();
						?>
						<div class="panel panel-primary">
							<!--博客文章标题-->
							<h2 class="panel-heading post-title">
								<?php the_title();?>
							</h2>

							<div class="panel-body">
								<div class="media">
									<!--博客文章图片-->
									<?php 
										if( has_post_thumbnail()){
											the_post_thumbnail(array(200,200));
										}else{
											echo '';}
									?>
									<!--博客文章内容-->
									<div class="media-body post-content">
										<?php the_content();?>
									</div>
								</div>
							</div>
							<!--博客文章相关内容-->
							<div class="panel-footer clearfix">
									<i class="glyphicon glyphicon-tags"></i> <?php the_category( ',');?>

								<ul class="author pull-right">
									<li><i class="glyphicon glyphicon-time"></i> <?php the_time('Y-m-d');?></li>
									<li><i class="glyphicon glyphicon-edit"></i> <?php the_author();?></li>
									<li><i class="glyphicon glyphicon-eye-open"></i> <?php echo get_post_meta(get_the_ID(),'views',true);?></li>
								</ul>
							</div>
						</div>
						<ul class="pager">
							<?php Xblog_post_nav_link('disabled','previous','next');?>
						</ul>
                        <div class="alert alert-default text-center">
                             <a href="javascript:;" class="btn btn-success">很好 <span class="badge"> <?php 
									if(get_post_meta(get_the_ID(),'zan',true)==0){
										echo '0';
									}else{
										echo get_post_meta(get_the_ID(),'zan',true);
									}
							 ?> </span></a>  
                             <a href="javascript:;" class="btn btn-danger">差极了 <span class="badge"> <?php 
									if(get_post_meta(get_the_ID(),'cai',true)==0){
										echo '0';
									}else{
										echo get_post_meta(get_the_ID(),'cai',true);
									}
							 ?> </span></a>
						<?php Xblog_ajax_fun();?>
                        </div>
						<?php		}
							}
							//update_option('Xblog_num',1);
						?>
						<div class="row hidden-xs">
							<?php
								$arr=array(
									'numberposts'=>'3',
									'oederby'=>'rand'
								);
								$posts = get_posts($arr);
								foreach($posts as $post):
							?>
							<div class="col-md-4">
								<div class="thumbnail">
									<a href="<?php the_permalink();?>"><img src="<?php 
													$imglink = wp_get_attachment_image_src(
														get_post_thumbnail_id(get_the_ID()),
														'full'
													);
													echo $imglink[0];
												?>" alt="">
									</a>
									<div class="caption">
										<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
										<p><?php the_excerpt();?></p>
									</div>
								</div>
							</div>
							<?php
								endforeach;
							?>
						</div>
					</div>

					<!--侧边展示栏-->
					<?php get_sidebar();?>
				</div>
			</div>
		</main> 
<?php 

get_footer();

?>

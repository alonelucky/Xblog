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
						<div class="panel panel-primary">
							<!--博客文章标题-->
							<h2 class="panel-heading post-title">
								<?php the_title();?>
							</h2>
							<div class="panel-body text-center">
								<span calss="glyphicon glyphicon-time"></span><?php _e('Update Time','Xblog');?> : <?php the_time('Y-m-d');?>
								<span calss="glyphicon glyphicon-user"></span><?php _e('Author','Xblog');?> : <?php the_author();?>
								<span calss="glyphicon glyphicon-tags"></span><?php _e('Tags','Xblog');?> : <?php the_category( ',');?>
							</div>
							<div class="panel-body">
								<div class="media">
									<!--博客文章图片-->
									
									<img src="<?php bloginfo( 'template_url' );?>/img/xys.png" class="center-block" alt="">
									
									<!--博客文章内容-->
									<div class="media-body post-content">
										<?php the_content();?>
									</div>
								</div>
							</div>
							<!--博客文章相关内容-->
							<div class="panel-footer">
									<?php _e('Tags :','Xblog');?>
							</div>
						</div>
                        <div class="alert alert-default text-center">
                             <a href="javascript(0);" class="btn btn-success">很好 <span class="badge"> 2</span></a>  
                             <a href="javascript(0);" class="btn btn-info">不错 <span class="badge"> 10</span></a>  
                             <a href="javascript(0);" class="btn btn-warning">一般 <span class="badge"> 20</span></a>  
                             <a href="javascript(0);" class="btn btn-danger">差极了 <span class="badge"> 3</span></a>       
                        </div>
					</div>



					<!--侧边展示栏-->
					<?php get_sidebar();?>
				</div>
			</div>
		</main> 
<?php get_footer();?>

<?php 
	get_header();
	get_header( 'nav' );
?>
		<!--主体内容-->
		<main role="main">
			<div class="container">
				<div class="row clearfix">
					<div class="col-md-9">
						<?php comments_template('/comments-page.php');?>					
					</div>
				</div>
			</div>
			<?php Xblog_liuyan_zan_fun();?>
		</main> 
<?php get_footer();?>

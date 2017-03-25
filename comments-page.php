<?php
	$arr=array(
		'id_form'=>'liuyan_id',
		'class_form'=>'',
		'id_submit'=>'liuyan_submit_id',
		'class_submit'=>'btn btn-primary',
		'name_submit'=>'submit',
		'label_submit'=>'发布留言',
		'fields'=>'',
		'comment_field'=>'
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon">留言标题</span>
								<input type="text" name="author" id="author" class="form-control" placeholder="请输入您的意见,建议20字以内">
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon">您的邮箱</span>
								<input type="email" name="email" id="email" class="form-control" placeholder="您的邮箱不会被公开">
							</div>
						</div>
					</div>
					<br>
					<div class="input-group">
					<span class="input-group-addon">内容主体</span>
						<textarea name="comment" id="comment" rows="5" class="form-control" placeholder="这里输入留言信息"></textarea>
					</div><br>
					',
		'comment_notes_before'=>'',
        'comment_notes_after'=>'',
		'title_reply'=>''
	);
	
	comment_form($arr);

	//定义评论列表的输出
	//参数1  控制头像大小
	//参数2  输出的包裹形式div/ul/li
	//参数3  评论回复文本
	//参数4  回调函数	
	$list_arr=array(
		'avatar_size'=>48,
		'style'=>'ul',
		'replay_text'=>'',
		'callback'=>'Xblog_liuyan_fun'
	);
	//定义评论输出框的显示模板
	function Xblog_liuyan_fun($comment){
		//$GLOBAL['comments']=$comment;
		?>
		<div class="col-md-6 col-sm-12">
			<div class="panel panel-success">
				<div class="panel-heading clearfix">
					<strong class="pull-left"><?php 
						$title = get_comment_author();
						if(strlen($title)>20){
							echo wp_trim_words($title,17,'...');
							//echo mb_strimwidth($title,0,18,'...','utf-8');
						}else{
							echo $title;
						}
					?></strong>
					<small class="pull-right"><?php comment_date();?></small>
				</div>
				<div class="panel-body">
					<?php comment_text();?>
					<?php echo get_comment_ID();?>
				</div>
				<div class="panel-footer clearfix">
					<span class="pull-right zan">
						<span class="hidden comment_id"><?php comment_ID();?></span>
						<span class="glyphicon glyphicon-heart <?php 
							$id_check = get_comment_ID().'comment_zan';
							if( substr($_COOKIE[$id_check],0,1)){
								echo 'yes';
							}
						?>"></span> 
						<span class="zan_count"><?php echo get_comment_meta(get_comment_ID(),'zan',true);?></span>
					</span>
				</div>
			</div>
		</div>
		<?php
		
	}
	
	wp_list_comments($list_arr);
	
?>
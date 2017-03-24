<?php
//调用ajax实现文章点踩

add_action('wp_ajax_xblog_ajax_views','Xblog_ajax_views_fun');
add_action('wp_ajax_nopriv_xblog_ajax_views','Xblog_ajax_views_fun');
function Xblog_ajax_fun(){
	?>
	<script>
		jQuery(document).ready(function(){
			var checkCookie = document.cookie;
			$('.alert a.btn-success').click(function(){
				if(!(checkCookie.indexOf('<?php echo get_the_ID();?>zan=1')>0)){
					$.ajax({
						type:'POST',
						data:"zc=z&post=<?php echo get_the_ID();?>&action=xblog_ajax_views",
						url:'<?php bloginfo('url');?>/wp-admin/admin-ajax.php',
						success:function(data){
							$('a.btn-success span').text(data);
							var date = new Date();
							var expires = date.getTime()+3600*24*30*1000;
							document.cookie="<?php echo get_the_ID();?>zan=1,expires="+expires;
						}
					});
				}
			});
			$('.alert a.btn-danger').click(function(){
				if(!(checkCookie.indexOf('<?php echo get_the_ID();?>cai=1')>0)){
					$.ajax({
						type:'POST',
						data:"zc=c&post=<?php echo get_the_ID();?>&action=xblog_ajax_views",
						url:'<?php bloginfo('url');?>/wp-admin/admin-ajax.php',
						success:function(data){
							$('a.btn-danger span').text(data);
							var date = new Date();
							var expires = date.getTime()+3600*24*30*1000;
							document.cookie="<?php echo get_the_ID();?>cai=1,expires="+expires;
						}
					});
				}
			});
		});
	</script>
	<?php
}

function Xblog_ajax_views_fun(){
	
	$post_zc = $_POST['zc'];
	$post = $_POST['post'];
	
	if($post_zc=='z'&&$post){
		$zan = get_post_meta($post,'zan',true);
		if(!update_post_meta($post,'zan',($zan+1))){
			add_post_meta($post,'zan',1,true);
		}
		echo  get_post_meta($post,'zan',true);
	}
	
	if($post_zc=='c'&&$post){
		$cai = get_post_meta($post,'cai',true);
		if(!update_post_meta($post,'cai',($cai+1))){
			add_post_meta($post,'cai',1,true);
		}
		echo get_post_meta($post,'cai',true);
	}
	
	wp_die();
}


//自定义文章浏览次数统计

add_action('wp_head','Xblog_post_views');

function Xblog_post_views(){
	global $post;
	$id= $post->ID;
	if(!$_COOKIE[$id]){
		if(is_single()){
			$views = get_post_meta($id,'views',true);
			if(!update_post_meta($id,'views',($views+1))){
				add_post_meta($id,'views',1,true);
			}
		}	
	}
}
// =======================================================
// 
//                      自定义样式和脚本挂载
// =======================================================
function Xblog_self_style(){
	$style = get_option('Xblog_options_2')['self_style'];
	echo '<style>'.$style.'</style>';
}

function Xblog_self_script(){
	$script = get_option('Xblog_options_2')['self_script'];
	echo '<script>'.$script.'</script>';
}
add_action('wp_head','Xblog_self_style',999);
add_action('wp_footer','Xblog_self_script');

// =======================================================
// 
//                      主题中心
// =======================================================
add_action('admin_menu','Xblog_theme_options');
function Xblog_theme_options(){
	//增加主题设置项
	add_theme_page(
		__('Theme Options','Xblog'),
		__('Theme Settings','Xblog'),
		'administrator',
		'Xblog_theme_options',
		'Xblog_theme_options_fun'	
	);
	//引入主题函数文件
	include('functions/Xblog_options_views_funs.php');
}

// =======================================================
// 
//                      增加特色图像
// =======================================================
add_theme_support('post-thumbnails');

// =======================================================
// 
//                      定义网站title
// =======================================================
function Xblog_name(){
	if(is_home()||is_front_page()){
		//如果是首页则只输出博客名称和描述
		bloginfo( 'name' ).' - '.bloginfo( 'description' );
	}else{
		//否则输出博客名+当前页面名称
		bloginfo( 'name' ).wp_title('-');
	}
}

// =======================================================
// 
//                      定义网站meta关键字标签
// =======================================================
//
function Xblog_description(){
	if(is_home()||is_front_page()){
		//如果是首页则输出博客描述
		$description = bloginfo( 'description' );
		return $description;
	}elseif(is_page()||is_single()){
		//如果是页面或文章则输出摘要内容
		global $post;
		echo $post->post_excerpt;
	}elseif(is_category()){
		$categories = get_the_category();
		$description= '';
		foreach($categories as $category){
			$description = $description.$category->cat_description;
		}
		echo $description;
	}
}
function Xblog_keywords(){
	if(is_home()||is_front_page()){
		//如果是首页则关键词为博客名称
		$keywords = bloginfo( 'name' );
		return $keywords;
	}elseif(is_single()||is_page()){
		//如果是文章页或普通页面,则关键词为分类名称和标签名
		global $post; //获取post内容
		$tags = wp_get_post_tags($post->ID);  //获取当前文章的所有标签
		$categories = get_the_category($post->ID);  //获取当前文章的所有所属分类
		$keywords = '';       //定义变量储存标签名和分类名
		foreach($tags as $tag){
			//循环输出标签名,并储存,以','号分割
			$keywords = $keywords. $tag->name.',';
		}
		foreach($categories as $category){
			//循环输出分类名,并储存,以','号分割
			$keywords = $keywords. $category->cat_name.',';
		}
		echo $keywords; //输出关键词
	}elseif(is_category()){
		echo single_cat_title();
	}elseif(is_tag()){
		echo single_tag_title();
	}else{
		echo wp_title('',0);
	}
}
// =======================================================
// 
//                      主导航注册
// 
// =======================================================
register_nav_menus( array(
	//注册导航栏
	'header_menu'=>__('Main menu','Xblog'),
	'footer_menu'=>__('Footer menu','Xblog')
) );
// =======================================================
// 
//                      多语言支持
// 
// =======================================================
add_action('after_setup_theme', 'Xblog_theme_setup'); //定义在主题调用后启用Xblog_theme_setup函数
function Xblog_theme_setup(){
	//定义函数多语言域,及加载文件夹
    load_theme_textdomain('Xblog', get_template_directory() . '/languages');
}

// =======================================================
// 
//                      添加链接栏目
// 
// =======================================================

add_filter('pre_option_link_manager_enabled','__return_true');
// =======================================================
// 
//                      注册小工具
// 
// =======================================================
$xblog_sidebar1=array(
		'name'=>'近期文章',
		'id'=>'myPost1',
		'description'=>'展示最近的几篇文章',
		'class'=>'myPost',
		'before_widget'=>'<div class="panel panel-primary">',
		'after_widget'=>'</div>',
		'before_title'=>'<div class="panel-heading">',
		'after_title'=>'</div>'
) ;
$xblog_sidebar2=array(
		'name'=>'优秀文章',
		'id'=>'myPost2',
		'description'=>'展示最近的几篇文章',
		'class'=>'myPost',
		'before_widget'=>'<div class="panel panel-primary" id="sidebar2">',
		'after_widget'=>'</div>',
		'before_title'=>'<div class="panel-heading">',
		'after_title'=>'</div>'
) ;
$xblog_footer_bar=array(
		'name'=>'底部小工具栏 %d',
		'id'=>'myPost-%d',
		'description'=>'底部小工具栏',
		'class'=>'myPost',
		'before_widget'=>'<div class="panel panel-primary" id="sidebar-%d">>',
		'after_widget'=>'</div>',
		'before_title'=>'<div class="panel-heading">',
		'after_title'=>'</div>'
) ;
register_sidebar( $xblog_sidebar1 );
register_sidebar( $xblog_sidebar2 );
register_sidebars( 3,$xblog_footer_bar );

// =======================================================
//				分页链接自定义
//				dis_class:禁用时的样式
//				pre_class:上一页样式
// 				next_class:下一页样式
// =======================================================

function Xblog_post_nav_link($dis_class,$pre_class,$next_class)
{
	if( get_previous_post() ){
		echo '<li class="'.$pre_class.'">'.get_previous_post_link('%link','%title',true).'</li>';
	}else{
		echo '<li class="'.$pre_class.' '.$dis_class.'"><a>'.__('This is frist page!','Xblog').'</a></li>';
	}

	if( get_next_post() ){
		echo '<li class="'.$next_class.'">'.get_next_post_link('%link','%title',true).'</li>';
	}else{
		echo '<li class="'.$next_class.' '.$dis_class.'"><a>'.__('This is last page!','Xblog').'</a></li>';
	}

}
// =======================================================
// 
//              注册小工为page添加摘要输入框具
// 
// =======================================================

add_action( 'admin_menu', 'my_page_excerpt_meta_box' );
function my_page_excerpt_meta_box() {
    add_meta_box( 'postexcerpt', __('Excerpt'), 'post_excerpt_meta_box', 'page', 'normal', 'core' );
}
// =======================================================
// 
//              为page添加分类和标签
// 
// =======================================================
class PTCFP{
	function __construct(){
    add_action( 'init', array( $this, 'taxonomies_for_pages' ) );
    /**
     * 确保这些查询修改不会作用于管理后台，防止文章和页面混杂 
     */
    if ( ! is_admin() ) {
      add_action( 'pre_get_posts', array( $this, 'category_archives' ) );
      add_action( 'pre_get_posts', array( $this, 'tags_archives' ) );
    } // ! is_admin
  } // __construct
  /**
   * 为“页面”添加“标签”和“分类”
   *
   * @uses register_taxonomy_for_object_type
   */
  function taxonomies_for_pages() {
      register_taxonomy_for_object_type( 'post_tag', 'page' );
      register_taxonomy_for_object_type( 'category', 'page' );
  } // taxonomies_for_pages
  /**
   * 在标签存档中包含“页面”
   */
  function tags_archives( $wp_query ) {
    if ( $wp_query->get( 'tag' ) )
      $wp_query->set( 'post_type', 'any' );
  } // tags_archives
  /**
   * 在分类存档中包含“页面”
   */
  function category_archives( $wp_query ) {
    if ( $wp_query->get( 'category_name' ) || $wp_query->get( 'cat' ) )
      $wp_query->set( 'post_type', 'any' );
  } // category_archives
} // PTCFP
$ptcfp = new PTCFP();

// =======================================================
/**
 * WordPress 添加面包屑导航 
 * https://www.wpdaxue.com/wordpress-add-a-breadcrumb.html
 */
// =======================================================

function xblog_breadcrumbs() {
	$delimiter = '»'; // 分隔符
	$before = '<li class="active">'; // 在当前链接前插入
	$after = '</li>'; // 在当前链接后插入
	if ( !is_home() && !is_front_page() || is_paged() ) {
		echo '<ol class="breadcrumb" id="crumbs">'.__( 'Where is :' , 'xblog' );
		global $post;
		$homeLink = home_url();
		echo ' <li><a href="' . $homeLink . '">' . __( 'Home' , 'xblog' ) . '</a></li> ' . $delimiter . ' ';
		if ( is_category() ) { // 分类 存档
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0){
				$cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
			}
			echo $before . '' . single_cat_title('', false) . '' . $after;
		} elseif ( is_day() ) { // 天 存档
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) { // 月 存档
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) { // 年 存档
			echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) { // 文章
			if ( get_post_type() != 'post' ) { // 自定义文章类型
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else { // 文章 post
				$cat = get_the_category(); $cat = $cat[0];
				$cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
				echo $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) { // 附件
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo '<a itemprop="breadcrumb" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) { // 页面
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) { // 父级页面
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a itemprop="breadcrumb" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_search() ) { // 搜索结果
			echo $before ;
			printf( __( 'Search result: %s', 'xblog' ),  get_search_query() );
			echo  $after;
		} elseif ( is_tag() ) { //标签 存档
			echo $before ;
			printf( __( 'Post tags: %s', 'xblog' ), single_tag_title( '', false ) );
			echo  $after;
		} elseif ( is_author() ) { // 作者存档
			global $author;
			$userdata = get_userdata($author);
			echo $before ;
			printf( __( 'Author : %s', 'xblog' ),  $userdata->display_name );
			echo  $after;
		} elseif ( is_404() ) { // 404 页面
			echo $before;
			_e( 'Nothing ', 'xblog' );
			echo  $after;
		}
		if ( get_query_var('paged') ) { // 分页
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo sprintf( __( ' Page %s', 'xblog' ), get_query_var('paged') );
		}
		echo '</ol>';
	}
}
?>
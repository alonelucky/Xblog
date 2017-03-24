jQuery(document).ready(function($){
	$('.option-nav > li').on('click',function(){
		var i = $(this).index();
		$(this).addClass('active').siblings().removeClass('active');
		$('div.content').eq(i).removeClass('hidden').addClass('active').siblings().removeClass('active').addClass('hidden');
	});
});
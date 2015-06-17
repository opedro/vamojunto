$(document).ready(function(){
	$('#user-detail').on('click', function(){
		$menu = $('#side-menu');
		if($menu.hasClass('show')){
			$menu.slideUp();
		}else{
			$menu.slideDown();
		}
		$menu.toggleClass('show')
	})
})
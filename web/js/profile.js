$(document).ready(function(){
	$(".animsition").animsition();
	
	$('.nav-tabs-animate .js-tab').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		  var left = $(this).parent().position().left; 
		var width = $(this).css('width');
		  
		  $('.nav-tabs-autoline').css('left', left);
		  $('.nav-tabs-autoline').css('width', width);
		})
	 
});


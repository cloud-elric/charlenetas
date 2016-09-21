$(document).ready(function(){
	$('.card-espejo').on('click', function(e) {
		console.log(e);
		
		if (e.target.className !== '') {
			return;
		}
		var token = $(this).data('token');
		showPostFull(token)
	});
	
});
function cargarFormulario(){
	$.ajax({
		url:'crear-hoy-pense',
		success:function(res){
			$('#js-modal-post .modal-content').html(res);
		}
	});
}

$('body').on('beforeSubmit', '#form-hoypense', function() {
	var form = $(this);
	// return false if form still have some validation errors
	if (form.find('.has-error').length) {
		return false;
	}
	// submit form
	$.ajax({
		url : form.attr('action'),
		type : 'post',
		 data: new FormData( this ),
		 cache: false,
	        contentType: false,
	        processData: false,
		success : function(response) {
			if(response=='success'){
				 $('#js-modal-post').closeModal();
			}else{
				$('#form-hoypense').yiiActiveForm('updateMessages',response, true);
			}
		}
	});
	return false;
});
function cargarFormulario(){
	$.ajax({
		url:'crear-alquimia',
		success:function(res){
			$('#js-modal-post .modal-content').html(res);
		}
	});
}
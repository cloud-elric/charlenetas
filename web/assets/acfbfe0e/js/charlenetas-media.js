function cargarFormulario(){
	$.ajax({
		url:'crear-media',
		success:function(res){
			$('#js-modal-post .modal-content').html(res);
		}
	});
}
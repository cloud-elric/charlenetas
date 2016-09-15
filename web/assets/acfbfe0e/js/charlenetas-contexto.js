function cargarFormulario(){
	$.ajax({
		url:'crear-contexto',
		success:function(res){
			$('#js-modal-post .modal-content').html(res);
		}
	});
}
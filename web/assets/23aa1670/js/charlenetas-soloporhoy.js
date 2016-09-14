function cargarFormulario(){
	$.ajax({
		url:'crear-solo-por-hoy',
		success:function(res){
			$('#js-modal-post .modal-content').html(res);
		}
	});
}
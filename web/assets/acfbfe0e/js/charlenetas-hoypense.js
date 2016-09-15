function cargarFormulario(){
	$.ajax({
		url:'crear-hoy-pense',
		success:function(res){
			$('#js-modal-post .modal-content').html(res);
		}
	});
}
function cargarFormulario(){
	$.ajax({
		url:'crear-verdadazos',
		success:function(res){
			$('#js-modal-post .modal-content').html(res);
		}
	});
}
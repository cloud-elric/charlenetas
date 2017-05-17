function cargarFormulario() {
	$.ajax({
		url : 'formulario-crear-disponibilidad',
		success : function(res) {
			$('#js-modal-post .modal-content').html(res);
		}
	});
}
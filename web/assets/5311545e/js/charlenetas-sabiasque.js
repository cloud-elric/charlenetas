function cargarFormulario(){
	$.ajax({
		url:'crear-sabias-que',
		success:function(res){
			$('#js-modal-post .modal-content').html(res);
		}
	});
}
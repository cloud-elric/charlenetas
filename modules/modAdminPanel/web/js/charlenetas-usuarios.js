function cambioUser(idUser,idTipo){
	//console.log(idUser);
	//console.log(idTipo);
	$.ajax({
		url: basePath + 'adminPanel/admin/cambiar-user?idUser=' + idUser + '&idTipo=' + idTipo,
		method : 'GET',
		success : function(res) {
			//alert("ok");	
		}
	});
}

var pages = 1;
function cargarMasUsuarios(userTotales, numeroUserMostrar) {
	var l = Ladda.create(document.getElementById('js-cargar-mas-usuarios'));
 	l.start();
	 	
	totalUserMostrados = (pages+1)*2;
	totalUsers = userTotales - totalUserMostrados;
	
	var contenedor = $('#js-contenedor-tarjetas');
	var url = basePath+'adminPanel/admin/get-mas-usuarios?page=' + pages;
	
	$.ajax({
		url : url,
		success : function(res) {

			var $items = $(res);

			contenedor.append($items);
			//contenedor.masonry('appended', $items);

			pages++;

			//filtrarPost();
			
			if(totalUsers <= 0){
				//console.log(totalPost);
				$("#js-cargar-mas-usuarios").remove();
			}else{
				$("#js-cargar-mas-usuarios label").text('('+totalUsers+')');
			}
			
			l.stop();
		}
	});

}
/**
 * Charlenetas
 *
 * # author      Damián <@damian>
 * # copyright   Copyright (c) 2016, Charlenetas
 *
 */

/**
 * Document Ready
 */
$(document).ready(function(){

	/**
	 * Click - Card
	 */
	$(".btn-validar").on("click", function(e){

		e.preventDefault();

		var user = $("#form-user").val(),
			pass = $("#form-pass").val(),
			sendDate = true,
			toastError = $('<span class="toast-error">Error</span>'),
			toastSuccess = $('<span class="toast-success">Success</span>');

		if (user.length == 0 || pass.length == 0){
			if (user.length < 2 || pass.length < 2){
				Materialize.toast(toastError, 40000);
				sendDate = false;
			}
			// Materialize.toast(toastError, 4000); // .addClass('toat-error')
			// sendDate = false;
		}


		if(sendDate == true){
			Materialize.toast(toastSuccess, 40000); // 4000 is the duration of the toast
			window.location.href = "http://localhost/2gom/charlenetas/dashboard.php";
		}

		
	});

});

$(window).load(function(){
  // alert("Load");
  $(".loader").fadeOut();
  $(".wrap").delay(1000).fadeIn();
});

/**
 * Variables
 */

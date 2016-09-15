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
	$(".card-edit").on("click", function(){
		$("#modal-form").openModal();
	});

	/**
	 * Click - Boton de check
	 */
	var stat = true;
	$(".btn-check").on("click", function(){
		if(stat){
			$(".card-options-check").show().css("display", "inline-block");
			stat = false;
		} else{
			$(".card-options-check").hide();
			stat = true;
		}
		
	});

	/**
	 * Inicializar modal
	 */
	$('.modal-trigger').leanModal({
		dismissible: true, // Modal can be dismissed by clicking outside of the modal
		opacity: .5, // Opacity of modal background
		in_duration: 300, // Transition in duration
		out_duration: 200, // Transition out duration
		starting_top: '4%', // Starting top style attribute
		ending_top: '10%', // Ending top style attribute
		// ready: function() { alert('Ready'); }, // Callback for Modal open
		// complete: function() { alert('Closed'); } // Callback for Modal close
	});

	/**
	 * Inicializar datepicker
	 */
	$('.datepicker').pickadate({
		selectMonths: true, // Creates a dropdown to control month
		selectYears: 15 // Creates a dropdown of 15 years to control year
	});

	$('select').material_select();

});
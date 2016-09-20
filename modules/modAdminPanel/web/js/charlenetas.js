/**
 * Proyecto
 *
 * # author      Damián <@damian>
 * # copyright   Copyright (c) 2016, Proyecto
 *
 *
 *
 * @param {Object} e The event
 * @param {String} className The class name to check against
 * @return {Boolean}
 */

/**
 * Document Ready
 */
$(document).ready(function(){

	// Dropdown
	$(".dropdown-button").dropdown({
		inDuration: 300,
		outDuration: 225,
		constrain_width: false, // Does not change width of dropdown to that of the activator
		hover: true, // Activate on hover
		gutter: 0, // Spacing from edge
		belowOrigin: false, // Displays dropdown below the button
		alignment: 'left' // Displays dropdown with edge aligned to the left of button
	});

	// Holder.run();

	// Scroll (nav)
    $('.nav').asScrollable();
    // Scroll (nav)
    $('.agenda').asScrollable();

});

$(window).load(function(){
	// alert("Load");
	$(".loader").fadeOut();
	$(".wrap").delay(3000).fadeIn();
});



/**
 * Variables
 */

/**
 * Function
 */
$(".btn-login-register").click(function() {
	var item = $(this).data("account");
	if(item === "singup"){
		$(".account-singup").hide();
		$('.anim-account').animate({left: '-1%'}, 300, function() {
			$(".account-login .animated").animate({ "opacity": "0" }, 0 );
			$(".anim-account").animate({ "left": "2%" }, 350 );
			$(".account-login").show();
			$(".account-login .animated").each(function(index) {$( this ).addClass("delay-"+(index)+" fadeInUp");});
		});
	}
	else if(item === "login"){
		$(".account-login").hide();
		$('.anim-account').animate({left: '50%'}, 300, function() {
			$(".account-singup .animated").animate({ "opacity": "0" }, "slow" );
			$(".anim-account").animate({ "left": "48%" }, 350 );
			$(".account-singup").show();
			$(".account-singup .animated").each(function(index) {$( this ).addClass("delay-"+(index)+" fadeInUp");});
		});
	} else {
		$(".anim-account").css("left", "48%");
		$(".anim-account").css("marginLeft", "-230px");
	}
});
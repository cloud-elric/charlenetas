var preolader = '<div class="progress"><div class="indeterminate"></div></div>';
$(document).ready(function(){

    $('#js_creditos_usuario').on('click', function(e){
		e.preventDefault();
		if(creditos>-1){
			$("#js-modal-creditos").trigger('click');
		}
	});

    $('.js-seleccionar-producto-boton').on('click', function(e){
        e.preventDefault();
        var token = $(this).data('token');

        $("#js-form-pagar-producto").val(token);

        paso2();
        
    });

    $('.js-seleccinar-forma-pago').on('click', function(e){
        var token = $(this).data('token');

        $("#js-form-pagar-formaPago").val(token);

        var data = $('#js-form-pagar').serialize();

        $.ajax({
            url: basePath + 'pagos/generar-orden-compra',
            method: 'POST',
            data: data,
            success: function(resp){
                $('.container-pago').html(resp);
            },
            error: function(jqXHR, status, error){
                console.log('Error');
            }
        });


        paso3();
    });

    $('.js-back-step-1').on('click', function(e){
        e.preventDefault();
        paso1();
    });

      $('.js-back-step-2').on('click', function(e){
        e.preventDefault();
        paso2();
    });
})

function paso1(){

    $(".step").removeClass('active');
    $(".step-1").addClass('active');

    $(".header-label-step").removeClass('active');
    $(".header-label-step-1").addClass('active');
}

function paso2(){
    $(".step").removeClass('active');
    $(".step-2").addClass('active');

    $(".header-label-step").removeClass('active');
    $(".header-label-step-2").addClass('active');

    $('.container-pago').html(preolader);
}

function paso3(){
    $(".step-2").removeClass('active');
    $(".step-3").addClass('active');

    $(".header-label-step").removeClass('active');
    $(".header-label-step-3").addClass('active');
}
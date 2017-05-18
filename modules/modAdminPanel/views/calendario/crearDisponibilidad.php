<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<h4>Agregar <span>horario(s)</span></h4>


 <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s8">
          <input id="js-date" type="text" class="datepicker">
          <label for="js-date">Selecciona una fecha</label>
        </div>
      
        <div class="input-field col s4">
          <input type="number" id="repeat-horario" type="text" class="">
          <label for="repeat-horario">Repeticiones</label>
        </div>
      </div>

      <div class="row">
        <div class="col s12">
            <table class="highlight centered" id="tabla-horarios">
                <thead>
                <tr>
                    <th>Hora inicial</th>
                    <th>Hora final</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>
                        <input value="9:00"  type="text" class="time-picker-inicial">
                    </td>
                    <td><input value="9:30" type="text" class="time-picker-final"></td>
                </tr>
               
                </tbody>
            </table>
            <a class="btn-floating green darken-3 right" id="js-add-horario"><i class="material-icons">add</i></a>
        </div>

      </div>

    </form>
  </div>
<script>

$('.time-picker-inicial').timepicker({
    'minTime': '9:00',
    'maxTime': '21:00',
    'timeFormat': 'H:i' 
});

$('.time-picker-final').timepicker({
      'minTime': '9:30',
    'maxTime': '21:00',
    'timeFormat': 'H:i' 
});

$('.time-picker-inicial').on('changeTime', function() {
  var inicialHora = $(this).val();
  var finalHora = $('.time-picker-final').val();

  if(Date.parse('01/01/2011 '+finalHora) < Date.parse('01/01/2011 '+inicialHora)){
    inicialHora = finalHora;
  }

  $('.time-picker-final').timepicker('remove');

  $('.time-picker-final').timepicker({
      'minTime': inicialHora,
      'maxTime': '21:00',
      'timeFormat': 'H:i' 
  });
});

</script>

<?php
use yii\web\View;

$this->registerJs ( "


		$('.datepicker').pickadate({
		
// 		weekdaysShort: ['D', 'L', 'M', 'Mi', 'J', 'V', 'S'],
// 		monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
// 		monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
// 		weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		today: 'Hoy',
		clear: 'Limpiar',
		close: 'Cerrar',
		container: 'body',
    min: new Date(),
		format: 'dd-mmm-yyyy',
  		formatSubmit: 'yyyy-mm-dd',
		selectMonths: true, // Creates a dropdown to control month
    	selectYears: 15 // Creates a dropdown of 15 years to control year
  });


", View::POS_END );
?>


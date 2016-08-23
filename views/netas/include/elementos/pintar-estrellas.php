<!-- //TODO:: poner el "for2 para por cada numero de calificción total poner las estrellas -->
<span>Calificación Charlenetas</span>
<div class="star-wrapper">
  <i class="icon-star"></i>
  <i class="icon-star"></i>
  <i class="icon-star"></i>
  <i class="icon-star"></i>
  <i class="icon-star"></i><?=$post->entAlquimias->num_calificacion_admin?>
</div>

<span>Los usuarios</span>
<div class="star-wrapper">
  <i class="icon-star"></i>
  <i class="icon-star"></i>
  <i class="icon-star"></i>
  <i class="icon-star-empty"></i>
  <i class="icon-star-empty"></i><?=$post->entAlquimias->num_calificacion_usuario?>
</div>

<span>Tu calificación</span>
<div class="star-wrapper calificable">
  <i class="icon-star calificada"></i>
  <i class="icon-star calificada"></i>
  <i class="icon-star calificada"></i>
  <i class="icon-star-half calificada"></i><?=$post->entAlquimias->num_calificacion_usuario?>
</div>

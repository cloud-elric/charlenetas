<?php
use yii\web\View;
?>


<?=$this->render('//layouts/header')?>

<?=$this->render('//layouts/nav', ['tiposPost'=>$tiposPost])?>


<div class=container-fluid>
 <div class="pins-grid-container">
  <div class="grid" id="js-contenedor-posts-tarjetas">
    <?php
    include 'masPosts.php';
    ?>
  </div>
 </div>
</div>




<div class="more-entries waves-effect waves-light btn" id="js-cargar-mas-posts"
	onclick="cargarMasPosts();">Cargar mas entradas</div>

<div id="js-tmp" style="display: none;"></div>



<div id="backScreen">
	<div id="wrapper">
		<i onclick="hidePostFull()" class="icon-close"></i>
		<div id="js-content" class="full-pin-content"></div>
	</div>
</div>


<!-- Modal Structure -->
<div id="modal-login" class="modal">
	<div class="modal-content">
		<div class="preloader-wrapper big active">
			<div class="spinner-layer spinner-blue">
				<div class="circle-clipper left">
					<div class="circle"></div>
				</div>
				<div class="gap-patch">
					<div class="circle"></div>
				</div>
				<div class="circle-clipper right">
					<div class="circle"></div>
				</div>
			</div>

			<div class="spinner-layer spinner-red">
				<div class="circle-clipper left">
					<div class="circle"></div>
				</div>
				<div class="gap-patch">
					<div class="circle"></div>
				</div>
				<div class="circle-clipper right">
					<div class="circle"></div>
				</div>
			</div>

			<div class="spinner-layer spinner-yellow">
				<div class="circle-clipper left">
					<div class="circle"></div>
				</div>
				<div class="gap-patch">
					<div class="circle"></div>
				</div>
				<div class="circle-clipper right">
					<div class="circle"></div>
				</div>
			</div>

			<div class="spinner-layer spinner-green">
				<div class="circle-clipper left">
					<div class="circle"></div>
				</div>
				<div class="gap-patch">
					<div class="circle"></div>
				</div>
				<div class="circle-clipper right">
					<div class="circle"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<a class="waves-effect waves-light btn modal-trigger" href="#modal-login" style="display:none;"></a>

<?php
if (Yii::$app->user->isGuest) {
$this->registerJs("
  loadLogin();
  // Masonry Grid
  grid = $('.grid').masonry({
     itemSelector: '.pin',
   columnWidth:250,
     gutter: 15,

  });


  ", View::POS_END);

}
?>

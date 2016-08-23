

<div class=container-fluid>
	<div class="pins-grid-container">
		<div class=pins-grid id="js-contenedor-posts-tarjetas">
				<?php
				include 'masPosts.php';
				?>
		</div>
	</div>
</div>


<div class="waves-effect waves-light btn" id="js-cargar-mas-posts"
	onclick="cargarMasPosts();">Cargar mas entradas</div>

<div id="js-tmp" style="display: none;"></div>



<div id="backScreen">
	<div id="wrapper">
		<span class="closeBackScreen" onclick="hidePostFull()">X</span>
		<div id="js-content"></div>

	</div>
</div>



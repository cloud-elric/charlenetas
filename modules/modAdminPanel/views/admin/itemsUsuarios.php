<?php

use app\models\EntComentariosPosts;
use app\models\EntUsuariosFeedbacks;
use yii\helpers\Html;
use app\models\CatTiposUsuarios;

$tipoUsuarios = new CatTiposUsuarios();
$users = $tipoUsuarios->find()->all();

 foreach($usuarios as $usuario){ ?>

		<div class="col s12 m6 l4">
			<div class="card card-user">
				<div class="card-user-cont">
					<div class="row">
						<div class="col s3">
							<div class="card-user-avatar">
								<?= Html::img ( $usuario->getImageProfile())?>
								<!-- <div class="card-user-status card-user-status-deshabilitado"></div> -->
							</div>
  									<!-- <p class="card-user-status">Habilitado</p>
									<p class="card-user-status">Deshabilitado</p> -->
						</div>
						<div class="col s9">
							<p class="card-user-nombre"><?= $usuario->txt_username?></p>
							<p class="card-user-email"><?= $usuario->txt_email?></p>
							<!-- <p class="card-user-tipo-user"><?= $usuario->idTipoUsuario->txt_nombre?></p> -->
							<?php if($usuario->idTipoUsuario->txt_nombre != "Super administrador"){ ?>
							<div class="input-field col s12">
    							<select onChange="cambioUser(<?=$usuario->id_usuario?>,value)">
								    <option value="<?= $usuario->idTipoUsuario->id_tipo_usuario?>"><?= $usuario->idTipoUsuario->txt_nombre?></option>
								    <?php foreach($users as $us){ ?>
								    	<?php if($us->txt_nombre != $usuario->idTipoUsuario->txt_nombre){ ?>
								    			<option value="<?= $us->id_tipo_usuario ?>"><?=$us->txt_nombre ?></option>
								    <?php 	  }
										  }
								    ?>
								</select>
  							</div>
  							<?php }else{?>
  								<p class="card-user-tipo-user"><?= $usuario->idTipoUsuario->txt_nombre?></p>
  							<?php }?>
						</div>
					</div>
				</div>
				<div class="card-user-statistics">
					<p class="card-user-statistics-comentarios">
						<i class="ion ion-android-textsms"></i> <?= count($usuario->entComentariosPosts)?>
					</p>
					<p class="card-user-statistics-feeds">
						<i class="ion ion-ios-list-outline"></i> <?= EntUsuariosFeedbacks::find()->where(['id_usuario'=>$usuario->id_usuario])->count("id_tipo_feedback");?>
					</p>
					<p class="card-user-statistics-creditos">
						<i class="ion ion-cash"></i> 0
					</p>
<!-- 					<p class="card-user-statistics-contracion"> -->
<!-- 						<i class="ion ion-android-playstore"></i> 12 -->
<!-- 					</p> -->
				</div>
			</div>
		</div>
		<?php } ?>
		
		<script>
			$(document).ready(function() {
			    $('select').material_select();
			  });
		</script>
		
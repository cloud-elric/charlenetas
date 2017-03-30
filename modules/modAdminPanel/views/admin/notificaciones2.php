<?php
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\ModUsuariosEntUsuarios;
?>
<?php \yii\widgets\Pjax::begin(); ?>

<div class="container">
	<div class="row">
		<div class="col-s6 offset-s6">
	    		
			<?= GridView::widget([
				'dataProvider' => $dataProvider,
			    'columns' => [
			        [ 	
			        	'attribute' => 'Usuario',
			        	'format' => 'raw',
			        	'value' => function ($data){
			        		return Html::img ( $data->idUsuario2->getImageProfile (), [ 'width' => '50px' ] );
			        	}
			        ],
			        [ 
						'attribute' => 'Descripcion',
						'format' => 'raw',
						'value' => function ($data){
							if($data->id_tipo_post == 1){
								return Html::a ( $data->txt_descripcion, [ 
									'admin/espejo?page=0&token='.$data->txt_token_objeto.'&idNotif='.$data->id_notificacion
								]);
							}else if($data->id_tipo_post == 2){
								return Html::a ( $data->txt_descripcion, [ 
									'admin/alquimia?page=0&token='.$data->txt_token_objeto.'&idNotif='.$data->id_notificacion
								]);
							}else if($data->id_tipo_post == 3){
								return Html::a ( $data->txt_descripcion, [ 
									'admin/verdadazos?page=0&token='.$data->txt_token_objeto.'&idNotif='.$data->id_notificacion
								]);
							}else if($data->id_tipo_post == 4){
								return Html::a ( $data->txt_descripcion, [ 
									'admin/hoy-pense?page=0&token='.$data->txt_token_objeto.'&idNotif='.$data->id_notificacion
								]);
							}else if($data->id_tipo_post == 7){
								return Html::a ( $data->txt_descripcion, [ 
									'admin/solo-por-hoy?page=0&token='.$data->txt_token_objeto.'&idNotif='.$data->id_notificacion
								]);
							}
						} 
					],
			    ],
			]); ?>
			    
		</div>
	</div>
</div>	
<?php \yii\widgets\Pjax::end(); ?>

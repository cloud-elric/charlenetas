<?php
use yii\grid\GridView;
use yii\helpers\Html;
use app\models\ModUsuariosEntUsuarios;
?>

<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-primary">
			<div class="panel-body"></div>
    
		    <?= GridView::widget([
		        'dataProvider' => $dataProvider,
		        'columns' => [
		            ['class' => 'yii\grid\SerialColumn'],
		        	[ 	
		        		'attribute' => 'Usuario',
		        		'format' => 'raw',
		        		'value' => function ($data){
		        			//$user = ModUsuariosEntUsuarios::find()->where(['id_usuario'=>$dat->id_usuario])->one();
		        			return Html::img ( $data->idUsuario2->getImageProfile (), [ 'width' => '50px' ] );
		        		}
		        	],
		        	[ 
						'attribute' => 'Descripcion',
						'format' => 'raw',
						'value' => function ($data){
							if($data->id_tipo_post = 1){
								return Html::a ( $data->txt_descripcion, [ 
									'admin/espejo?page=0&token='.$data->txt_token_objeto.'&idNotif='.$data->id_notificacion
								]);
							}else if($data->id_tipo_post = 2){
								return Html::a ( $data->txt_descripcion, [ 
									'admin/alquimia?page=0&token='.$data->txt_token_objeto.'&idNotif='.$data->id_notificacion
								]);
							}else if($data->id_tipo_post = 3){
								return Html::a ( $data->txt_descripcion, [ 
									'admin/verdadazos?page=0&token='.$data->txt_token_objeto.'&idNotif='.$data->id_notificacion
								]);
							}else if($data->id_tipo_post = 4){
								return Html::a ( $data->txt_descripcion, [ 
									'admin/hoy-pense?page=0&token='.$data->txt_token_objeto.'&idNotif='.$data->id_notificacion
								]);
							}else if($data->id_tipo_post = 7){
								return Html::a ( $data->txt_descripcion, [ 
									'admin/solo-por-hoy?page=0&token='.$data->txt_token_objeto.'&idNotif='.$data->id_notificacion
								]);
							}
						} 
					],
		        ],
		    ]); ?>
		    
			<div class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-center">
				 		
			        </div>
				</div>
			</div>
		</div>
	</div>
</div>

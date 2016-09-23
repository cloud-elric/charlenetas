<?php
use app\models\ConstantesWeb;

?>
	<label for="<?=ConstantesWeb::IMG_YOUTUBE_FULL_SIZE_THUMB?>">Imagen default</label>
	<input id="<?=ConstantesWeb::IMG_YOUTUBE_FULL_SIZE_THUMB?>" type="radio" name='tipo_imagen' value='<?=ConstantesWeb::IMG_YOUTUBE_FULL_SIZE_THUMB?>'/>
	<img
		src='<?=str_replace(['{idVideo}', '{typeImg}'], [$idVideo, ConstantesWeb::IMG_YOUTUBE_FULL_SIZE_THUMB], ConstantesWeb::URL_IMG_VIDEO_YOUTUBE)?>'>

	<label for="<?=ConstantesWeb::IMG_YOUTUBE_FULL_SIZE_THUMB_2?>">Imagen default 2</label>	
	<input id="<?=ConstantesWeb::IMG_YOUTUBE_FULL_SIZE_THUMB_2?>" type="radio" name='tipo_imagen' value='<?=ConstantesWeb::IMG_YOUTUBE_FULL_SIZE_THUMB_2?>'/>
	<img
		src='<?=str_replace(['{idVideo}', '{typeImg}'], [$idVideo, ConstantesWeb::IMG_YOUTUBE_FULL_SIZE_THUMB_2], ConstantesWeb::URL_IMG_VIDEO_YOUTUBE)?>'>
		
	
	<label for="<?=ConstantesWeb::IMG_YOUTUBE_HIGH_RES?>">Imagen de maxima resolución</label>	
	<input id="<?=ConstantesWeb::IMG_YOUTUBE_HIGH_RES?>" type="radio" name='tipo_imagen' value='<?=ConstantesWeb::IMG_YOUTUBE_HIGH_RES?>'/>
	<img
		src='<?=str_replace(['{idVideo}', '{typeImg}'], [$idVideo, ConstantesWeb::IMG_YOUTUBE_HIGH_RES], ConstantesWeb::URL_IMG_VIDEO_YOUTUBE)?>'>
		
	
	<label for="<?=ConstantesWeb::IMG_YOUTUBE_MEDIUM_DEFAULT?>">Imagen mediana</label>	
	<input id="<?=ConstantesWeb::IMG_YOUTUBE_MEDIUM_DEFAULT?>" type="radio" name='tipo_imagen' value='<?=ConstantesWeb::IMG_YOUTUBE_MEDIUM_DEFAULT?>'/>
	<img
		src='<?=str_replace(['{idVideo}', '{typeImg}'], [$idVideo, ConstantesWeb::IMG_YOUTUBE_MEDIUM_DEFAULT], ConstantesWeb::URL_IMG_VIDEO_YOUTUBE)?>'>
		
	
	<label for="<?=ConstantesWeb::IMG_YOUTUBE_SMALL_THUMB?>">Imagen pequeña</label>	
	<input id="<?=ConstantesWeb::IMG_YOUTUBE_SMALL_THUMB?>" type="radio" name='tipo_imagen' value='<?=ConstantesWeb::IMG_YOUTUBE_SMALL_THUMB?>'/>
	<img
		src='<?=str_replace(['{idVideo}', '{typeImg}'], [$idVideo, ConstantesWeb::IMG_YOUTUBE_SMALL_THUMB], ConstantesWeb::URL_IMG_VIDEO_YOUTUBE)?>'>
		
	
	<label for="<?=ConstantesWeb::IMG_YOUTUBE_SMALL_THUMB_2?>">Imagen pequeña 2</label>	
	<input id="<?=ConstantesWeb::IMG_YOUTUBE_SMALL_THUMB_2?>" type="radio" name='tipo_imagen' value='<?=ConstantesWeb::IMG_YOUTUBE_SMALL_THUMB_2?>'/>
	<img
		src='<?=str_replace(['{idVideo}', '{typeImg}'], [$idVideo, ConstantesWeb::IMG_YOUTUBE_SMALL_THUMB_2], ConstantesWeb::URL_IMG_VIDEO_YOUTUBE)?>'>
		
		
	<label for="<?=ConstantesWeb::IMG_YOUTUBE_SMALL_THUMB_3?>">Imagen pequeña 3</label>	
	<input id="<?=ConstantesWeb::IMG_YOUTUBE_SMALL_THUMB_3?>" type="radio" name='tipo_imagen' value='<?=ConstantesWeb::IMG_YOUTUBE_SMALL_THUMB_3?>'/>	
	<img
		src='<?=str_replace(['{idVideo}', '{typeImg}'], [$idVideo, ConstantesWeb::IMG_YOUTUBE_SMALL_THUMB_3], ConstantesWeb::URL_IMG_VIDEO_YOUTUBE)?>'>

<?php

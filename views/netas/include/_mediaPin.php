<?php 
/* @var $post EntPosts*/
?>

<div class="pin pin-media" onclick="showPostFull('<?=$post->txt_token?>')">
	<div class="pin-header"></div>

	<div class=image>
		<img data-src="images/c7002690.image6.jpg">
	</div>
	<div class=description><?=$post->txt_titulo?><br>
<?=$post->txt_url?><br></div>
	<div class=credits>Sample credits</div>

</div>
<!-- 
<div class="pin">
<h1>Media</h1>

</div>

 -->
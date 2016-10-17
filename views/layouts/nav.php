<nav>
	<ul>
	<?php
	foreach ( $tiposPost as $tipoPost ) {
		?>
		<li>
			<a href="#" class="filter-active js-filter-tipo-post" data-value="<?=$tipoPost->id_tipo_post?>">
				<span class="color-solo-por-hoy"></span>
				<p><?=$tipoPost->txt_nombre?></p>
			</a>
		</li>
	<?php
	}
	?>
	</ul>
</nav>

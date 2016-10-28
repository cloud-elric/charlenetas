
<?=$usuario->nombreCompleto?>
<br>
<?=$usuario->txt_imagen?>
<br>
<?=$usuario->txt_email?>
<br>
<a id="button_editar_usuario" class="waves-effect waves-light modal-trigger" onclick="abrirModalEditarUsuario('<?=$usuario->id_usuario?>')" href="#js-modal-user-editar">Editar</a>
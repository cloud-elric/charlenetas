<?php

// Si esta en modo DEBUG
if (YII_ENV_DEV) {
	$params = [ 
			'adminEmail' => 'admin@example.com',
			'modAdmin' => ["path_imagenes_posts"=>"uploads/imagenesPosts/"],
			'modUsuarios' => [
					'pathImageProfile'=>'uploads/profiles/',
					'pathImageDefault'=>'uploads/profiles/imgDefault.png',
					'facebook' => [ 
							'usarLoginFacebook' => true,
							'APP_ID' => '1779986862262300', // Identificador de la aplicación
							'APP_SECRET' => 'b00ca2920c357bf845b8f23aab5eae6e', // Clave secreta de la aplicación
							'CALLBACK_URL' => 'http://notei.com.mx/test/wwwCharlenetas/web/callback-facebook',
							'dataBasic' => true, // Obtiene datos basicos del usuario como nombre, imagen, apellido, email
							'friends' => true, // Visualiza a los amigos que esten usuando la aplicacion
							'permisosForzosos' => 'email, user_friends',
							'permisos' => 'public_profile, email, user_friends' 
					],
					'sesiones' => [ 
							'guardarSesion' => true, // Guardara el registro de sesiones del usuario
							'sesionUnicaPorUsuario' => true, // Solamente habra una sesión por usuario
							'cerrarPrimeraSesion' => true 
					], // Cierra la primera sesion abierta para una nueva sesion
					'mandarCorreoActivacion' => true, // Envia correo electronico para activar la cuenta del usuario
					'email' => [ 
							'emailActivacion' => 'welcome@2gom.com.mx',
							'subjectActivacion' => 'Activar cuenta',
							'emailRecuperarPass' => 'support@charlenetas.com',
							'subjectRecuperarPass' => 'Recuperar contraseña' 
					],
					'recueperarPass' => [ 
							'diasValidos' => 2, // Numero de dias que durara la recuperación de la contraseña
							'validarFechaFinalizacion' => true 
					] 
			] 
	]; // validar si la recuperación de contraseña validara la fecha de expiracion

	
} else {
	$params = [ 
			'adminEmail' => 'admin@example.com',
			'modAdmin' => ["path_imagenes_posts"=>"uploads/imagenesPosts/"],
			'modUsuarios' => [
					'pathImageProfile'=>'uploads/profiles/',
					'pathImageDefault'=>'uploads/profiles/imgDefault.png',
					'facebook' => [ 
							'usarLoginFacebook' => true,
							'APP_ID' => '1779986862262300', // Identificador de la aplicación
							'APP_SECRET' => 'b00ca2920c357bf845b8f23aab5eae6e', // Clave secreta de la aplicación
							'CALLBACK_URL' => 'http://notei.com.mx/test/wwwCharlenetas/web/callback-facebook',
							'dataBasic' => true, // Obtiene datos basicos del usuario como nombre, imagen, apellido, email
							'friends' => true, // Visualiza a los amigos que esten usuando la aplicacion
							'permisosForzosos' => 'email, user_friends',
							'permisos' => 'public_profile, email, user_friends' 
					],
					'sesiones' => [ 
							'guardarSesion' => true, // Guardara el registro de sesiones del usuario
							'sesionUnicaPorUsuario' => true, // Solamente habra una sesión por usuario
							'cerrarPrimeraSesion' => true 
					], // Cierra la primera sesion abierta para una nueva sesion
					'mandarCorreoActivacion' => true, // Envia correo electronico para activar la cuenta del usuario
					'email' => [ 
							'emailActivacion' => 'welcome@2gom.com.mx',
							'subjectActivacion' => 'Activar cuenta',
							'emailRecuperarPass' => 'support@2gom.com.mx',
							'subjectRecuperarPass' => 'Recuperar contraseña' 
					],
					'recueperarPass' => [ 
							'diasValidos' => 2, // Numero de dias que durara la recuperación de la contraseña
							'validarFechaFinalizacion' => true 
					] 
			] 
	]; // validar si la recuperación de contraseña validara la fecha de expiracion

	
}

return $params;

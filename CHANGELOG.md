# Change log Charlenetas
Proyecto tipo red social

## Base de datos
### 2016-08-19 [added]
- Se creo la tabla "ent_usuarios_like_post";
- Agregada vista "view_contador_likes"
- Se creo la tabla "ent_usuarios_calificacion_alquimia"
- Agregada vista "view_calificacion_alquimias"
### 2016-08-19 [changed]
-Se cambio el nombre de la base de datos de pruebas a "charlenetas_geekdb";

### 2016-08-18 [added]
- Se creo la vista "view_contador_feedback_comentarios"

### 2016-08-17 [changed]
- A todas las llaves foraneas de la base de datos se cambiaron para que cuando se borre el padre se eliminen los relacionados
- La tabla "ent_usuarios_subscripciones" se le agrego un campo llamado "b_leido"
- Se agrego el campo "txt_token" a la tabla de "ent_comentarios_posts"

### 2016-08-15 [changed]
- Se agrego la relacion ent_posts con usuarios 
- Se agrego la relación ent_respuestas_espejo con la de usuarios
- A la tabla ent_posts se agrego el campo txt_token que sirve para identificar al post sin dejar la llave primaria a la vista del usuario final
### 2016-08-15 [added]
- Se creo la tabla ent_comentarios_posts
- Creación de tabla cat_tipos_feedback
- Creación de tabla ent_usuarios_feedbacks
- Se agregaron relaciones en la tabla ent_usuarios_feedbacks
 
### 2016-08-11 [changed]
- Cambio de campos de tablas en la base de datos
### 2016-08-11 [added]
- Se agrego la tabla cat_tipos_usuarios
- En tabla mod_ent_usuarios se agrego la relación usuario con tipo de usuario

### 2016-08-10 [added]
- Creación de base de datos
- Generación de tablas y comentarios
### 2016-08-10 [fixed]
- Crear la tabla para el usuario administrador
- Agregarle llave foranea a la tabla "ent_posts" que apunte a una tabla de usuarios administradores
- Agregarle llave foranea a la tabla "ent_respuestas_espejo" que apunte a una tabla de usuarios administradores



## Frontend (Aplicación web)
### 2016-08-23 [changed]
- Se cambio los javascript a un archivo llamado "charlenetas.js"

### 2016-08-22 [added]
- Se creo un modelo llamado "ConstantesWeb.php" que contiene las constantes generales del sistema

### 2016-08-19 [added]
- Se agreo el contador de likes al post
- Creación de modelo "EntUsuariosLikePost"
- Agregada funcionalidad para guardar likes de los usuarios
- Agregada funcionalidad para la Actualizacion el campo "num_likes" de la tabla "ent_posts"
- Creación de modelo "ViewContadorLikes"
- Se agrego la habilidad para cuando el usuario no tiene una foto de perfil utiliza una por default
- En la tarjeta de alquimia las calificaciones se pintan con estrellas dependiendo de la base de datos
- Creación de modelo "ViewCalificacionAlquimias"
- Agregada funcionalidad para guardar calificaciones de los usuarios sobre una alquimia
- Agregada funcionalidad para la actualización el campo "num_calificaciones_usuario" de la tabla "ent_espejos"

### 2016-08-18 [added]
- Se agrego la funcionalidad de que al registrarse se suba una foto
- Permisos para los actions que deben llevar permiso
- Impresiones de los datos que se necesitan del usuario logueado
- Creacion del modelo "EntUsuariosFeedbacks"
- Creacion de modelo "ViewContadorFeedbackComentarios"
- Muestra contador de feedbacks
- Funcionalidad para aumentar un feedback de algún comentario

### 2016-08-17 [added]
- Se agrego la habilidad de subscribirse a una pregunta de espejo
- Se agrego la habilidad de desSubscribirse a una pregunta de espejo

### 2016-08-16 [fixed]
- Se arreglo la habilidad para que el grid se cargue por medio asyncrono 
### 2016-08-16 [changed]
- Se borraron los archivos pins-grid.css, vendor.js y pins-grid.js
### 2016-08-16 [added]
- Se agregaron los archivos pins.min.js y pins.min.css
- Se agregaron los archivos necesarios para las tarjetas full con la información completa (Exepto la tarjeta en contexto)
- Se agrego el proyecto a un repositorio en github

### 2016-08-15 [added]
- En el modelo EntPostsExtend.php se genero el metodo para recuperar un post por el token
- En controlador NetasController.php se agregaron los metodos necesarios para recuperar un post por el token
- Generacion de switch para identificar la tarjeta completa por el tipo
- Generación de vista _alquimiaTarjetaCompleta.php
- En el archivo _alquimiaTarjetaCompleta.php se imprimen los datos que debe de llevar
- Generación de modelo EntComentariosPosts.php
- Se agrego el metodo getEntRespuestasEspejo en EntPostsExtend.php para obtener todas las respuestas de un espejo (solo trae una)
- Generación de vista _espejoTarjetaCompleta.php
- En el archivo _espejoTarjetaCompleta.php se imprimen los datos que debe de llevar
- Se agrego el archivo _comentariosRespuestasPost.php donde estan los comentarios del post
- Generación de vista _verdadazosTarjetaCompleta.php
- En el archivo _verdadazosTarjetaCompleta.php se imprimen los datos que debe de llevar
- Generación de vista _hoyPenseTarjetaCompleta.php
- En el archivo _hoyPenseTarjetaCompleta.php se imprimen los datos que debe de llevar
- Generación de vista _contextoTarjetaCompleta.php
- En el archivo _contextoTarjetaCompleta.php se imprimen los datos que debe de llevar
- Creacion de modal y funcionalidad javascript para cargar la tarjeta full y comentarios asincronos

### 2016-08-11 [added]
- Se crearon los modelos necesarios
- Render para cada tipo de tarjeta
- NetasController para el control principal del sistema
- Creacion de metodos necesarios
- Vista para cada tarjeta

### 2016-08-10 [added]
- Creación de proyecto en yii2
- Se agrego modulo de usuarios
>>>>>>> origin/master

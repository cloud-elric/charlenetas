



<div class="new-comment">
  <!-- TODO implementar la foto del usuario dinamicamente solo si esta logeado -->
  <img src="assets/images/usr-avatar.png" alt="" />
  <form class="add-new-comment" id="">
    <textarea name="comentario" placeholder="Yo opino que..."></textarea>
    <a class="waves-effect waves-light btn btn-primary" href="<?=$post->txt_url?>">Publicar</a>
  </form>
</div>


<div class="comment">


  <div class="comment-header">
    <!-- TODO implementar la foto del usuario dinamicamente -->
    <div class="comment-usr">
      <img src="assets/images/usr-avatar.png" alt="" />
      <h5>Alfie</h5>
    </div>
    <div class="comment-date">
      <h6>3 de Agosto</h6>
    </div>
  </div>


  <div class="comment-body">
    <p>
      Mauris iaculis porttitor posuere. Praesent id metus massa, ut blandit odio. Proin quis tortor orci. Etiam at risus et justo dignissim congue. Donec congue lacinia dui, a porttitor lectus condimentum laoreet. Nunc eu ullamcorper orci. Quisque eget odio ac lectus vestibulum faucibus eget in metus. In pellentesque faucibus vestibulum. Nulla at.
    </p>
  </div>


  <div class="comment-footer">
    <a class="waves-effect waves-light btn btn-secondary">Responder</a>

    <!-- Esto se desoculta cuando vas a responder
    <div class="new-comment">
      <img src="" alt="" />
      <form class="" action="index.html" method="post">
        <textarea name="name" value="">
        <button type="button" name="button"></button>
      </form>
    </div>
    -->

    <div class="comment-feedbacks">
      <div class="feedback">
        <i class="icon icon-thumbs-up"></i>
        <span>345</span>
      </div>
      <div class="feedback">
        <i class="icon icon-thumbs-down"></i>
        <span>45</span>
      </div>
      <div class="feedback did-usr-interact">
        <i class="icon icon-trollface"></i>
        <span>456</span>
      </div>
    </div>

  </div>


  <!--?php

  echo $this->render ( 'elementos/inputComentario', [
      'token' => $post->txt_token
  ] );

  ?-->

  <div class="comment-reply">
    <!--?php

    echo $this->render ( 'elementos/inputComentario', [
        'token' => $post->txt_token
    ] );

    ?-->
  </div>

</div>

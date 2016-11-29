<?php
use yii\helpers\Html;

$this->title = 'Mi perfil';

$user = Yii::$app->user->identity;
?>

 <!-- Page -->
  <div class="page animsition">
    <div class="page-content container-fluid">
      <div class="row">
      
       <div class="col-lg-12 col-md-12  col-xs-12" style="height: 190px;">
          <div class="widget widget-shadow">
            <div class="widget-header padding-30 bg-blue-600 white">
              <a class="avatar avatar-100 img-bordered bg-white pull-right" href="javascript:void(0)">
                 <?=Html::img ( $user->getImageProfile() )?>
              </a>
              <div class="vertical-align height-100 text-truncate">
                <div class="vertical-align-middle">
                  <div class="font-size-20 margin-bottom-5 text-truncate">Andrew Hoffman</div>
                  <div class="font-size-14 text-truncate">Web Designer</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
        <div class="col-md-12 col-xs-12">
          <!-- Panel -->
          <div class="panel">
            <div class="panel-body nav-tabs-animate">
              <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                <li class="active" role="presentation"><a class="js-tab" data-toggle="tab" href="#mensajes" aria-controls="activities"
                  role="tab">Mis mensajes <span class="badge badge-danger">5</span></a></li>
                <li role="presentation"><a class="js-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab">Mis mensajes</a></li>
                <li role="presentation"><a class="js-tab" data-toggle="tab" href="#messages" aria-controls="messages"
                  role="tab">Mis espejos</a></li>
                  <li class="nav-tabs-autoline" style="transition-duration: 0.5s, 1s; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1), cubic-bezier(0.4, 0, 0.2, 1); left: 0px; width: 122px;"></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active animation-slide-left" id="mensajes" role="tabpanel">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <div class="media">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/2.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Ida Fleming
                            <span>posted an updated</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">“Check if it can be corrected with overflow : hidden”</div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/3.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Julius
                            <span>uploaded 4 photos</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">
                            <img class="profile-uploaded" src="../../../global/photos/placeholder.png" alt="...">
                            <img class="profile-uploaded" src="../../../global/photos/placeholder.png" alt="...">
                            <img class="profile-uploaded" src="../../../global/photos/placeholder.png" alt="...">
                            <img class="profile-uploaded" src="../../../global/photos/placeholder.png" alt="...">
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/4.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Owen Hunt
                            <span>posted a new note</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Integer nec odio. Praesent libero. Sed cursus ante
                            dapibus diam. Sed nisi. Nulla quis sem at nibh elementum
                            imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce
                            nec tellus sed augue semper porta. Mauris massa.</div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media media-lg">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/5.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Terrance Arnold
                            <span>posted a new blog</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">
                            <div class="media">
                              <a class="media-left">
                                <img class="media-object" src="../../../global/photos/placeholder.png" alt="...">
                              </a>
                              <div class="media-body padding-left-20">
                                <h4 class="media-heading">Getting Started</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                  elit. Integer nec odio. Praesent libero. Sed
                                  cursus ante dapibus diam. Sed nisi. Nulla quis
                                  sem at nibh elementum imperdiet. Duis sagittis
                                  ipsum. Praesent mauris.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/2.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Ida Fleming
                            <span>posted an new activity comment</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">Cras sit amet nibh libero, in gravida nulla. Nulla vel
                            metus.</div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/3.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Julius
                            <span>posted an updated</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Integer nec odio. Praesent libero. Sed cursus ante
                            dapibus diam.</div>
                        </div>
                      </div>
                    </li>
                  </ul>
                  <a class="btn btn-block btn-default profile-readMore" href="javascript:void(0)"
                  role="button">Show more</a>
                </div>
                <div class="tab-pane animation-slide-left" id="profile" role="tabpanel">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <div class="media media-lg">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/5.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Terrance Arnold
                            <span>posted a new blog</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">
                            <div class="media">
                              <a class="media-left">
                                <img class="media-object" src="../../../global/photos/placeholder.png" alt="...">
                              </a>
                              <div class="media-body padding-left-20">
                                <h4 class="media-heading">Getting Started</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                  elit. Integer nec odio. Praesent libero. Sed
                                  cursus ante dapibus diam. Sed nisi. Nulla quis
                                  sem at nibh elementum imperdiet. Duis sagittis
                                  ipsum. Praesent mauris.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/2.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Ida Fleming
                            <span>posted an updated</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">“Check if it can be corrected with overflow : hidden”</div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/4.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Owen Hunt
                            <span>posted a new note</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Integer nec odio. Praesent libero. Sed cursus ante
                            dapibus diam. Sed nisi. Nulla quis sem at nibh elementum
                            imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce
                            nec tellus sed augue semper porta. Mauris massa.</div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/2.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Ida Fleming
                            <span>posted an new activity comment</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">Cras sit amet nibh libero, in gravida nulla. Nulla vel
                            metus.</div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/3.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Julius
                            <span>uploaded 4 photos</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">
                            <img class="profile-uploaded" src="../../../global/photos/placeholder.png" alt="...">
                            <img class="profile-uploaded" src="../../../global/photos/placeholder.png" alt="...">
                            <img class="profile-uploaded" src="../../../global/photos/placeholder.png" alt="...">
                            <img class="profile-uploaded" src="../../../global/photos/placeholder.png" alt="...">
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="tab-pane animation-slide-left" id="messages" role="tabpanel">
                  <ul class="list-group">
                    <li class="list-group-item">
                      <div class="media">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/2.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Ida Fleming
                            <span>posted an updated</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">“Check if it can be corrected with overflow : hidden”</div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media media-lg">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/5.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Terrance Arnold
                            <span>posted a new blog</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">
                            <div class="media">
                              <a class="media-left">
                                <img class="media-object" src="../../../global/photos/placeholder.png" alt="...">
                              </a>
                              <div class="media-body padding-left-20">
                                <h4 class="media-heading">Getting Started</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing
                                  elit. Integer nec odio. Praesent libero. Sed
                                  cursus ante dapibus diam. Sed nisi. Nulla quis
                                  sem at nibh elementum imperdiet. Duis sagittis
                                  ipsum. Praesent mauris.</p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/4.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Owen Hunt
                            <span>posted a new note</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Integer nec odio. Praesent libero. Sed cursus ante
                            dapibus diam. Sed nisi. Nulla quis sem at nibh elementum
                            imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce
                            nec tellus sed augue semper porta. Mauris massa.</div>
                        </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media">
                        <div class="media-left">
                          <a class="avatar" href="javascript:void(0)">
                            <img class="img-responsive" src="../../../global/portraits/3.jpg" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading">Julius
                            <span>posted an updated</span>
                          </h4>
                          <small>active 14 minutes ago</small>
                          <div class="profile-brief">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Integer nec odio. Praesent libero. Sed cursus ante
                            dapibus diam.</div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- End Panel -->
        </div>
       
      </div>
    </div>
  </div>
  <!-- End Page -->

<?=$usuario->nombreCompleto?>
<br>
<?=$usuario->txt_imagen?>
<br>
<?=$usuario->txt_email?>
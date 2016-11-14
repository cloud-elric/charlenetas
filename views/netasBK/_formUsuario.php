<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\VistaTotalCreditos;
use app\models\EntComentariosPosts;
use app\models\EntPosts;


$this->registerCssFile ( '@web/css/profile-usuario.css', [
		'depends' => [
				\app\assets\AppAsset::className ()
		]
] );

?>


<div class="main-content">
	<div class="container no-padding">
		<div class="row">
			<div class="col-md-3 l-content">
				<div class="profile-pic">
					<div class="pic-bg"><img src="images/profile-avatar.png" class="img-responsive" alt=""></div>
				</div>
				<nav>
				<ul class="navigation">
					<li class="flex-active"><a href="#">Profile <i class="fa fa-user"></i></a></li>
					<li><a href="#">Work <i class="fa fa-briefcase"></i></a></li>
					<li><a href="#">Resume <i class="fa fa-file-text"></i></a></li>
					<li><a href="#">Blog <i class="fa fa-comment"></i></a></li>
					<li><a href="#">Contact <i class="fa fa-envelope"></i></a></li>
				</ul>
				</nav>
			</div>

			<div class="col-md-9 r-content">
				<div class="flexslider" style="height: 0px;">
					<div class="slides">
						<!-- SECTION 1 - HOMEPAGE -->
						<section class="no-display flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 1; display: block; z-index: 2;">
							<div class="profile" id="1">
								<h2 class="animated fadeInDown">Hello, I am <span>Robb Armstrong</span><br>Designer and Front-end Developer</h2>
								<div class="sep1"></div>
								<p class="animated fadeInDown">I have ten years experience as a web/interface designer. I have a love of clean, elegant styling, and I have lots of experience in the production of CSS and (X)HTML for modern websites. I have a reasonable grasp of using JavaScript frameworks, specifically jQuery.</p>
								<div class="personal-info col-md-12 no-padding animated flipInX">
									<h4>Personal Info</h4>
									<div class="sep2"></div>
									<ul>
										<li>
											<div class="p-info"><em>name</em><span>Robb Armstrong</span></div>
										</li>
										<li>
											<div class="p-info"><em>date of birth</em><span>September 06, 1976</span></div>
										</li>
										<li>
											<div class="p-info"><em>e-mail</em><span>info@yourdomain.com</span></div>
										</li>
										<li>
											<div class="p-info"><em>address</em><span>121 King St, Melbourne VIC</span></div>
										</li>
										<li>
											<div class="p-info"><em>phone</em><span>012-3456-7890</span></div>
										</li>
										<li>
											<div class="p-info"><em>website</em><span>www.themeforest.net</span></div>
										</li>
									</ul>
								</div>
								<div class="clearfix"></div>
							</div>
						</section>
						<!-- SECTION 1 - HOMEPAGE -->

						<!-- SECTION 2 - WORKS / PROJECTS / PORTFOLIO -->
						<section class="no-display" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;">
							<div class="works" id="2">
								<div class="page-head animated fadeInDown">
									<div class="row">
										<div class="col-md-5">
											<h3>Portfolio</h3>
										</div>
										<div class="col-md-7">
											<div class="np-main">
												<p>Go to next/previous page</p>
												<div class="np-controls">
													<a href="#" class="previous"><i class="fa fa-arrow-circle-left"></i></a>
													<a href="#" class="next"><i class="fa fa-arrow-circle-right"></i></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="portfolio-wrap">
									<div class="row">
										<ul id="filter-list" class="clearfix">
											<li class="filter active" data-filter="all"><i class="fa fa-th"></i> All</li>
											<li class="filter" data-filter="webdesign">Web Design</li>
											<li class="filter" data-filter="appicon">App Icons</li>
											<li class="filter" data-filter="iosappui">iOS App UI</li>
											<li class="filter" data-filter="illustration">Illustration</li>
										</ul>
										<ul id="portfolio">
											<li class="item col-md-4 webdesign animated flipInX mix_all" style="display: inline-block;  opacity: 1;">
												<a title="Example 1" href="images/projects/1-big.jpg" data-lightbox-gallery="gallery1" class="nivo-lbox">
													<div class="folio-img">
														<img src="images/projects/1.jpg" alt="" class="img-responsive" draggable="false">
														<div class="overlay">
															<div class="overlay-inner">
																<h4>Cool App Design</h4>
																<p>branding, logo</p>
															</div>
														</div>
													</div>
												</a>
											</li>
											<li class="item col-md-4 illustration animated flipInX mix_all" style="display: inline-block;  opacity: 1;">
												<a title="Sample 2" href="https://www.youtube.com/watch?v=L9szn1QQfas" data-lightbox-gallery="gallery1" class="nivo-lbox">
													<div class="folio-img">
														<img src="images/projects/2.jpg" alt="" class="img-responsive" draggable="false">
														<div class="overlay">
															<div class="overlay-inner">
																<h4>Cool App Design</h4>
																<p>branding, logo</p>
															</div>
														</div>
													</div>
												</a>
											</li>
											<li class="item col-md-4 appicon animated flipInX mix_all" style="display: inline-block;  opacity: 1;">
												<a title="i'm Number 3" href="http://vimeo.com/71071717" data-lightbox-gallery="gallery1" class="nivo-lbox">
													<div class="folio-img">
														<img src="images/projects/3.jpg" alt="" class="img-responsive" draggable="false">
														<div class="overlay">
															<div class="overlay-inner">
																<h4>Cool App Design</h4>
																<p>branding, logo</p>
															</div>
														</div>
													</div>
												</a>
											</li>
											<li class="item col-md-4 iosappui animated flipInX mix_all" style="display: inline-block;  opacity: 1;">
												<a title="Example 4" href="images/projects/1-big.jpg" data-lightbox-gallery="gallery1" class="nivo-lbox">
													<div class="folio-img">
														<img src="images/projects/4.jpg" alt="" class="img-responsive" draggable="false">
														<div class="overlay">
															<div class="overlay-inner">
																<h4>Cool App Design</h4>
																<p>branding, logo</p>
															</div>
														</div>
													</div>
												</a>
											</li>
											<li class="item col-md-4 iosappui animated flipInX mix_all" style="display: inline-block;  opacity: 1;">
												<a title="Sample 5" href="images/projects/1-big.jpg" data-lightbox-gallery="gallery1" class="nivo-lbox">
													<div class="folio-img">
														<img src="images/projects/5.jpg" alt="" class="img-responsive" draggable="false">
														<div class="overlay">
															<div class="overlay-inner">
																<h4>Cool App Design</h4>
																<p>branding, logo</p>
															</div>
														</div>
													</div>
												</a>
											</li>
											<li class="item col-md-4 illustration animated flipInX mix_all" style="display: inline-block;  opacity: 1;">
												<a title="Lorem ipsum 6" href="images/projects/1-big.jpg" data-lightbox-gallery="gallery1" class="nivo-lbox">
													<div class="folio-img">
														<img src="images/projects/6.jpg" alt="" class="img-responsive" draggable="false">
														<div class="overlay">
															<div class="overlay-inner">
																<h4>Cool App Design</h4>
																<p>branding, logo</p>
															</div>
														</div>
													</div>
												</a>
											</li>
											<li class="item col-md-4 webdesign animated flipInX mix_all" style="display: inline-block;  opacity: 1;">
												<a title="Example 7" href="images/projects/1-big.jpg" data-lightbox-gallery="gallery1" class="nivo-lbox">
													<div class="folio-img">
														<img src="images/projects/7.jpg" alt="" class="img-responsive" draggable="false">
														<div class="overlay">
															<div class="overlay-inner">
																<h4>Cool App Design</h4>
																<p>branding, logo</p>
															</div>
														</div>
													</div>
												</a>
											</li>
											<li class="item col-md-4 iosappui animated flipInX mix_all" style="display: inline-block;  opacity: 1;">
												<a title="Sample 8" href="images/projects/1-big.jpg" data-lightbox-gallery="gallery1" class="nivo-lbox">
													<div class="folio-img">
														<img src="images/projects/8.jpg" alt="" class="img-responsive" draggable="false">
														<div class="overlay">
															<div class="overlay-inner">
																<h4>Cool App Design</h4>
																<p>branding, logo</p>
															</div>
														</div>
													</div>
												</a>
											</li>
											<li class="item col-md-4 webdesign animated flipInX mix_all" style="display: inline-block;  opacity: 1;">
												<a title="Project 9" href="images/projects/1-big.jpg" data-lightbox-gallery="gallery1" class="nivo-lbox">
													<div class="folio-img">
														<img src="images/projects/9.jpg" alt="" class="img-responsive" draggable="false">
														<div class="overlay">
															<div class="overlay-inner">
																<h4>Cool App Design</h4>
																<p>branding, logo</p>
															</div>
														</div>
													</div>
												</a>
											</li>
											<li class="item col-md-4 illustration animated flipInX mix_all" style="display: inline-block;  opacity: 1;">
												<a title="Example 10" href="images/projects/1-big.jpg" data-lightbox-gallery="gallery1" class="nivo-lbox">
													<div class="folio-img">
														<img src="images/projects/10.jpg" alt="" class="img-responsive" draggable="false">
														<div class="overlay">
															<div class="overlay-inner">
																<h4>Cool App Design</h4>
																<p>branding, logo</p>
															</div>
														</div>
													</div>
												</a>
											</li>
											<li class="item col-md-4 appicon animated flipInX mix_all" style="display: inline-block;  opacity: 1;">
												<a title="Item 11" href="images/projects/1-big.jpg" data-lightbox-gallery="gallery1" class="nivo-lbox">
													<div class="folio-img">
														<img src="images/projects/11.jpg" alt="" class="img-responsive" draggable="false">
														<div class="overlay">
															<div class="overlay-inner">
																<h4>Cool App Design</h4>
																<p>branding, logo</p>
															</div>
														</div>
													</div>
												</a>
											</li>
											<li class="item col-md-4 iosappui animated flipInX mix_all" style="display: inline-block;  opacity: 1;">
												<a title="Sample 12" href="images/projects/1-big.jpg" data-lightbox-gallery="gallery1" class="nivo-lbox">
													<div class="folio-img">
														<img src="images/projects/12.jpg" alt="" class="img-responsive" draggable="false">
														<div class="overlay">
															<div class="overlay-inner">
																<h4>Cool App Design</h4>
																<p>branding, logo</p>
															</div>
														</div>
													</div>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</section>
						<!-- SECTION 2 - WORKS / PROJECTS / PORTFOLIO -->

						<!-- SECTION 3 - CV / RESUME -->
						<section class="no-display" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;">
							<div class="item resume" id="3">
								<div class="page-head animated fadeInDown">
									<div class="row">
										<div class="col-md-5">
											<h3>Resume</h3>
										</div>
										<div class="col-md-7">
											<div class="np-main">
												<p>Go to next/previous page</p>
												<div class="np-controls">
													<a href="#" class="previous"><i class="fa fa-arrow-circle-left"></i></a>
													<a href="#" class="next"><i class="fa fa-arrow-circle-right"></i></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="resume-info animated slideInLeft">
									<h4>Education</h4>
									<div class="sep2"></div>
									<ul>
										<li>
											<h5>Academy of Art University</h5>
											<span class="year"><i class="fa fa-calendar"></i> 2001 - 2004</span>
											<p>Academy of Art University's School of Web Design &amp; New Media is the intersection between traditional design and new technologies.</p>
										</li>
										<li>
											<h5>IT Technical Institute</h5>
											<span class="year"><i class="fa fa-calendar"></i> 2005 - 2008</span>
											<p>Information technology (IT) workers can be found in many types of organizations. According to the U.S. Department of Labor, "In the modern workplace, it is imperative that Information Technology (IT) works both effectively and reliably</p>
										</li>
										<li>
											<h5>Web Design School</h5>
											<span class="year"><i class="fa fa-calendar"></i> 2009 - 2012</span>
											<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat.</p>
										</li>
									</ul>
								</div>
								<div class="skills-info">
									<h4>Skills</h4>
									<div class="sep2"></div>
									<ul>
										<li>
											<p>Wordpress Development <span>71%</span></p>
											<div class="skills-bg"><span class="skill1"></span></div>
										</li>
										<li>
											<p>Photoshop <span>85%</span></p>
											<div class="skills-bg"><span class="skill2"></span></div>
										</li>
										<li>
											<p>HTML5/CSS3 <span>76%</span></p>
											<div class="skills-bg"><span class="skill3"></span></div>
										</li>
										<li>
											<p>Ruby on Rails <span>53%</span></p>
											<div class="skills-bg"><span class="skill4"></span></div>
										</li>
										<li>
											<p>Social Marketing <span>69%</span></p>
											<div class="skills-bg"><span class="skill5"></span></div>
										</li>
									</ul>
								</div>
								<div class="services-info">
									<h4>Services</h4>
									<div class="sep2"></div>
									<ul>
										<li class="animated flipInX">
											<i class="fa fa-cloud"></i>
											<h5>Design</h5>
										</li>
										<li class="animated flipInX">
											<i class="fa fa-smile-o"></i>
											<h5>Coding</h5>
										</li>
										<li class="animated flipInX">
											<i class="fa fa-desktop"></i>
											<h5>Responsive</h5>
										</li>
										<li class="animated flipInX">
											<i class="fa fa-text-width"></i>
											<h5>Planing</h5>
										</li>
										<li class="animated flipInX">
											<i class="fa fa-comment"></i>
											<h5>Wordpress</h5>
										</li>
										<li class="animated flipInX">
											<i class="fa fa-picture-o"></i>
											<h5>Photography</h5>
										</li>
									</ul>
								</div>
								<div class="resume-info animated slideInLeft">
									<h4>Work Experience</h4>
									<div class="sep2"></div>
									<ul>
										<li>
											<h5>Graphic River</h5>
											<span class="year"><i class="fa fa-calendar"></i> 2001 - 2004</span>
											<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.</p>
										</li>
										<li>
											<h5>Video Hive</h5>
											<span class="year"><i class="fa fa-calendar"></i> 2005 - 2008</span>
											<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</p>
										</li>
										<li>
											<h5>Themeforest</h5>
											<span class="year"><i class="fa fa-calendar"></i> 2009 - 2014</span>
											<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor.</p>
										</li>
									</ul>
								</div>
							</div>
						</section>
						<!-- SECTION 3 - CV / RESUME -->

						<!-- SECTION 4 - BLOG / NEWS -->
						<section class="no-display" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;">
							<div class="item blog" id="4">
								<div class="page-head animated fadeInDown">
									<div class="row">
										<div class="col-md-5">
											<h3>Blog</h3>
										</div>
										<div class="col-md-7">
											<div class="np-main">
												<p>Go to next/previous page</p>
												<div class="np-controls">
													<a href="#" class="previous"><i class="fa fa-arrow-circle-left"></i></a>
													<a href="#" class="next"><i class="fa fa-arrow-circle-right"></i></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="blog-wrap">
									<article class="animated flipInX">
										<div class="row">
											<div class="col-md-5">
												<img src="images/blog/1.jpg" class="img-responsive" alt="" draggable="false">
											</div>
											<div class="col-md-7">
												<h3><a href="./blog-single.html">Standard Post with Image</a></h3>
												<div class="post-meta">
													<i class="fa fa-calendar"></i> <a href="#">30 march</a> 
													<i class="fa fa-user"></i> <a href="#">Admin</a> 
													<i class="fa fa-comments"></i> <a href="#">10 Comments</a> 
												</div>
												<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</p>
											</div>
										</div>
									</article>
									<div class="link-post">
										<div class="row">
											<div class="col-md-12">
												<i class="fa fa-link"></i>
												<a href="http://www.themeforest.net" target="_blank">www.themeforest.net</a>
											</div>
										</div>
									</div>
									<article class="animated flipInX">
										<div class="row">
											<div class="col-md-5">
												<img src="images/blog/2.jpg" class="img-responsive" alt="" draggable="false">
											</div>
											<div class="col-md-7">
												<h3><a href="./blog-single.html">Standard Post with Image</a></h3>
												<div class="post-meta">
													<i class="fa fa-calendar"></i> <a href="#">30 march</a> 
													<i class="fa fa-user"></i> <a href="#">Admin</a> 
													<i class="fa fa-comments"></i> <a href="#">10 Comments</a> 
												</div>
												<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</p>
											</div>
										</div>
									</article>
									<div class="quote-post">
										<div class="row">
											<div class="col-md-12">
												<blockquote>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aene.This is photoshop's version f Lorem Ipsum.</blockquote>
												<i class="fa fa-quote-left"></i>
												<span class="author-name">John Smith</span>
											</div>
										</div>
									</div>
									<article class="no-border animated flipInX">
										<div class="row">
											<div class="col-md-5">
												<img src="images/blog/3.jpg" class="img-responsive" alt="" draggable="false">
											</div>
											<div class="col-md-7">
												<h3><a href="./blog-single.html">Standard Post with Image</a></h3>
												<div class="post-meta">
													<i class="fa fa-calendar"></i> <a href="#">30 march</a> 
													<i class="fa fa-user"></i> <a href="#">Admin</a> 
													<i class="fa fa-comments"></i> <a href="#">10 Comments</a> 
												</div>
												<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit.</p>
											</div>
										</div>
									</article>
								</div>
							</div>
						</section>
						<!-- SECTION 4 - BLOG / NEWS -->

						<!-- SECTION 5 - CONTACT -->
						<section class="no-height" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;">
							<div class="item contact" id="5">
								<div class="page-head animated fadeInDown">
									<div class="row">
										<div class="col-md-5">
											<h3>Contact Us</h3>
										</div>
										<div class="col-md-7">
											<div class="np-main">
												<p>Go to next/previous page</p>
												<div class="np-controls">
													<a href="#" class="previous"><i class="fa fa-arrow-circle-left"></i></a>
													<a href="#" class="next"><i class="fa fa-arrow-circle-right"></i></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="map">
									<div class="gmap">
										<div id="map" style="position: relative; overflow: hidden;"><div style="height: 100%; width: 100%; position: absolute; background-color: rgb(229, 227, 223);"><div class="gm-style" style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0; cursor: url(&quot;http://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;) 8 8, default;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);"><div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;"><div style="width: 256px; height: 256px; position: absolute; left: 127px; top: -64px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 127px; top: 192px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 383px; top: -64px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 383px; top: 192px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -129px; top: -64px;"></div><div style="width: 256px; height: 256px; position: absolute; left: -129px; top: 192px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 639px; top: -64px;"></div><div style="width: 256px; height: 256px; position: absolute; left: 639px; top: 192px;"></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;"><div style="position: absolute; left: 0px; top: 0px; z-index: -1;"><div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;"><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 127px; top: -64px;"><canvas draggable="false" height="256" width="256" style="user-select: none; position: absolute; left: 0px; top: 0px; height: 256px; width: 256px;"></canvas></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 127px; top: 192px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 383px; top: -64px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 383px; top: 192px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -129px; top: -64px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -129px; top: 192px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 639px; top: -64px;"></div><div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: 639px; top: 192px;"></div></div></div></div><div style="position: absolute; z-index: 0; left: 0px; top: 0px;"><div style="overflow: hidden;"></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;"><div style="position: absolute; left: 127px; top: -64px; transition: opacity 200ms ease-out;"><img src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i9647!3i12319!4i256!2m3!1e0!2sm!3i367043000!3m14!2ses-419!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5oOiMwMGZmZTZ8cC5zOi0xMDA!4e0&amp;token=52813" draggable="false" alt="" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 127px; top: 192px; transition: opacity 200ms ease-out;"><img src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i9647!3i12320!4i256!2m3!1e0!2sm!3i367043000!3m14!2ses-419!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5oOiMwMGZmZTZ8cC5zOi0xMDA!4e0&amp;token=5361" draggable="false" alt="" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: -129px; top: -64px; transition: opacity 200ms ease-out;"><img src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i9646!3i12319!4i256!2m3!1e0!2sm!3i367043000!3m14!2ses-419!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5oOiMwMGZmZTZ8cC5zOi0xMDA!4e0&amp;token=104785" draggable="false" alt="" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 383px; top: 192px; transition: opacity 200ms ease-out;"><img src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i9648!3i12320!4i256!2m3!1e0!2sm!3i367043072!3m14!2ses-419!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5oOiMwMGZmZTZ8cC5zOi0xMDA!4e0&amp;token=6364" draggable="false" alt="" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 383px; top: -64px; transition: opacity 200ms ease-out;"><img src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i9648!3i12319!4i256!2m3!1e0!2sm!3i367043072!3m14!2ses-419!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5oOiMwMGZmZTZ8cC5zOi0xMDA!4e0&amp;token=53816" draggable="false" alt="" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: -129px; top: 192px; transition: opacity 200ms ease-out;"><img src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i9646!3i12320!4i256!2m3!1e0!2sm!3i367043000!3m14!2ses-419!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5oOiMwMGZmZTZ8cC5zOi0xMDA!4e0&amp;token=57333" draggable="false" alt="" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 639px; top: -64px; transition: opacity 200ms ease-out;"><img src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i9649!3i12319!4i256!2m3!1e0!2sm!3i367043072!3m14!2ses-419!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5oOiMwMGZmZTZ8cC5zOi0xMDA!4e0&amp;token=1844" draggable="false" alt="" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div style="position: absolute; left: 639px; top: 192px; transition: opacity 200ms ease-out;"><img src="http://maps.google.com/maps/vt?pb=!1m5!1m4!1i15!2i9649!3i12320!4i256!2m3!1e0!2sm!3i367043072!3m14!2ses-419!3sUS!5e18!12m1!1e47!12m3!1e37!2m1!1ssmartmaps!12m4!1e26!2m2!1sstyles!2zcC5oOiMwMGZmZTZ8cC5zOi0xMDA!4e0&amp;token=85463" draggable="false" alt="" style="width: 256px; height: 256px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div></div></div></div><div style="position: absolute; left: 0px; top: 0px; z-index: 2; width: 100%; height: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 3; width: 100%; height: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 4; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);"><div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div><div style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div></div></div><div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;"><a target="_blank" href="https://maps.google.com/maps?ll=40.714353,-74.005973&amp;z=15&amp;hl=es-419&amp;gl=US&amp;mapclient=apiv3" title="Haz clic para ver esta área en Google Maps" style="position: static; overflow: visible; float: none; display: inline;"><div style="width: 66px; height: 26px; cursor: pointer;"><img src="http://maps.gstatic.com/mapfiles/api-3/images/google_white5.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 66px; height: 26px; user-select: none; border: 0px; padding: 0px; margin: 0px;"></div></a></div><div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto, Arial, sans-serif; color: rgb(34, 34, 34); box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; z-index: 10000002; display: none; width: 256px; height: 148px; position: absolute; left: 185px; top: 90px;"><div style="padding: 0px 0px 10px; font-size: 16px;">Datos del mapa</div><div style="font-size: 13px;">Datos del mapa ©2016 Google</div><div style="width: 13px; height: 13px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;"><img src="http://maps.gstatic.com/mapfiles/api-3/images/mapcnt6.png" draggable="false" style="position: absolute; left: -2px; top: -336px; width: 59px; height: 492px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div></div><div class="gmnoprint" style="z-index: 1000001; position: absolute; right: 217px; bottom: 0px; width: 148px;"><div draggable="false" class="gm-style-cc" style="user-select: none; height: 14px; line-height: 14px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a style="color: rgb(68, 68, 68); text-decoration: none; cursor: pointer; display: none;">Datos del mapa</a><span>Datos del mapa ©2016 Google</span></div></div></div><div class="gmnoscreen" style="position: absolute; right: 0px; bottom: 0px;"><div style="font-family: Roboto, Arial, sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);">Datos del mapa ©2016 Google</div></div><div class="gmnoprint gm-style-cc" draggable="false" style="z-index: 1000001; user-select: none; height: 14px; line-height: 14px; position: absolute; right: 0px; bottom: 0px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a href="https://www.google.com/intl/es-419_US/help/terms_maps.html" target="_blank" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Condiciones del servicio</a></div></div><div style="width: 25px; height: 25px; overflow: hidden; display: none; margin: 10px 14px; position: absolute; top: 0px; right: 0px;"><img src="http://maps.gstatic.com/mapfiles/api-3/images/sv9.png" draggable="false" class="gm-fullscreen-control" style="position: absolute; left: -52px; top: -86px; width: 164px; height: 175px; user-select: none; border: 0px; padding: 0px; margin: 0px;"></div><div draggable="false" class="gm-style-cc" style="user-select: none; height: 14px; line-height: 14px; display: none; position: absolute; right: 0px; bottom: 0px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a target="_new" title="Informar a Google errores en las imágenes o el mapa de carreteras." href="https://www.google.com/maps/@40.714353,-74.005973,15z/data=!10m1!1e1!12b1?source=apiv3&amp;rapsrc=apiv3" style="font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;">Informar un error en el mapa</a></div></div><div class="gmnoprint gm-bundled-control" draggable="false" controlwidth="28" controlheight="55" style="margin: 10px; user-select: none; position: absolute; left: 0px; top: 0px;"><div class="gmnoprint" controlwidth="28" controlheight="55" style="position: absolute; left: 0px; top: 0px;"><div draggable="false" style="user-select: none; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; border-radius: 2px; cursor: pointer; background-color: rgb(255, 255, 255); width: 28px; height: 55px;"><div title="Acercar" style="position: relative; width: 28px; height: 27px; left: 0px; top: 0px;"><div style="overflow: hidden; position: absolute; width: 15px; height: 15px; left: 7px; top: 6px;"><img src="http://maps.gstatic.com/mapfiles/api-3/images/tmapctrl.png" draggable="false" style="position: absolute; left: 0px; top: 0px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 120px; height: 54px;"></div></div><div style="position: relative; overflow: hidden; width: 67%; height: 1px; left: 16%; background-color: rgb(230, 230, 230); top: 0px;"></div><div title="Alejar" style="position: relative; width: 28px; height: 27px; left: 0px; top: 0px;"><div style="overflow: hidden; position: absolute; width: 15px; height: 15px; left: 7px; top: 6px;"><img src="http://maps.gstatic.com/mapfiles/api-3/images/tmapctrl.png" draggable="false" style="position: absolute; left: 0px; top: -15px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 120px; height: 54px;"></div></div></div></div></div><div class="gmnoprint gm-bundled-control gm-bundled-control-on-bottom" draggable="false" controlwidth="0" controlheight="0" style="margin: 10px; user-select: none; position: absolute; display: none; bottom: 14px; right: 0px;"><div class="gmnoprint" controlwidth="28" controlheight="0" style="display: none; position: absolute;"><div title="Rotar mapa 90 grados" style="width: 28px; height: 28px; overflow: hidden; position: absolute; border-radius: 2px; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; cursor: pointer; background-color: rgb(255, 255, 255); display: none;"><img src="http://maps.gstatic.com/mapfiles/api-3/images/tmapctrl4.png" draggable="false" style="position: absolute; left: -141px; top: 6px; width: 170px; height: 54px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div><div class="gm-tilt" style="width: 28px; height: 28px; overflow: hidden; position: absolute; border-radius: 2px; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; top: 0px; cursor: pointer; background-color: rgb(255, 255, 255);"><img src="http://maps.gstatic.com/mapfiles/api-3/images/tmapctrl4.png" draggable="false" style="position: absolute; left: -141px; top: -13px; width: 170px; height: 54px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div></div></div><div draggable="false" class="gm-style-cc" style="position: absolute; user-select: none; height: 14px; line-height: 14px; right: 120px; bottom: 0px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><span>200 m&nbsp;</span><div style="position: relative; display: inline-block; height: 8px; bottom: -1px; width: 55px;"><div style="width: 100%; height: 4px; position: absolute; left: 0px; top: 0px;"></div><div style="width: 4px; height: 8px; left: 0px; top: 0px; background-color: rgb(255, 255, 255);"></div><div style="width: 4px; height: 8px; position: absolute; background-color: rgb(255, 255, 255); left: 0px; bottom: 0px;"></div><div style="position: absolute; background-color: rgb(102, 102, 102); height: 2px; left: 1px; bottom: 1px; right: 1px;"></div><div style="position: absolute; width: 2px; height: 6px; left: 1px; top: 1px; background-color: rgb(102, 102, 102);"></div><div style="width: 2px; height: 6px; position: absolute; background-color: rgb(102, 102, 102); bottom: 1px; right: 1px;"></div></div></div></div></div></div></div>
									</div>
								</div>
								<div class="contact-info">
									<h4>Contact info</h4>
									<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio.</p>
									<ul>
										<li><i class="fa fa-home"></i> lorem ipsum street</li>
										<li><i class="fa fa-phone"></i> +399 (500) 321 9548</li>
										<li><i class="fa fa-envelope"></i> info@domain.com</li>
									</ul>
								</div>
								<div class="contact-form">
									<h4>Send us a message</h4>
									<form id="contactForm" action="php/contact.php" method="post" class="positioned">
										<div class="row">
											<div class="col-md-4">
												<input type="text" name="senderName" id="senderName" placeholder="name">
												<input type="email" name="senderEmail" id="senderEmail" placeholder="e-mail">
												<input type="text" name="subject" id="subject" placeholder="Subject">
											</div>
											<div class="col-md-8">
												<textarea name="message" id="message" rows="6" placeholder="Message"></textarea>
												<button type="submit">Send Message</button>
											</div>
										</div>
									</form>
									<div id="successMessage" class="successmessage">
										<p><span class="success-ico"></span> Thanks for sending your message! We'll get back to you shortly.</p>
									</div>
									<div id="failureMessage" class="errormessage">
										<p><span class="error-ico"></span> There was a problem sending your message. Please try again.</p>
									</div>
									<div id="incompleteMessage" class="statusMessage">
										<p>Please complete all the fields in the form before sending.</p>
									</div>
								</div>
							</div>
						</section>
						<!-- SECTION 5 - CONTACT -->
					</div>
				</div>

				<!-- FOOTER -->
				<footer>
					<div class="row">
						<div class="col-md-7">
							<p>© 2014 Robb Armstrong. All Rights Reserved</p>
						</div>
						<div class="col-md-5">
							<ul class="social">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							</ul>
						</div>
					</div>
				</footer>
			</div>
		</div>
	</div>
</div>



























	<script type="text/javascript" >
		function showPostFull(token) {
			var background = $('#backScreen');
			var content = $('#js-content');
			var url = 'http://localhost/charlenetas/web/netas/cargar-post?token=' + token;
	
			$('body').css('overflow', 'hidden');
	
			background.show();
			content.load(url, function() {
				//content.html('');
				//cargarComentarios(token, true);
			});
		}
	</script>

<h4><span>Informacion de Usuario</span></h4>

<?php
$form = ActiveForm::begin ( [ 
		'options' => [ 
				'enctype' => 'multipart/form-data' 
		],
 		
		'layout' => 'horizontal',
		'id' => 'editar-usuario',
		'fieldConfig' => [ 
				'template' => "{input}\n{label}\n{error}",
				'horizontalCssClasses' => [ 
						'error' => 'mdl-textfield__error' 
				],
				'labelOptions' => [ 
						'class' => 'mdl-textfield__label '
				],
				'options' => [ 
						'class' => 'input-field col s12 m6' 
				] 
		],
		'errorCssClass' => 'invalid' 
] );

?>
	<div class='row'>

		<?= $form->field($usuario, 'txt_username')->textInput(['maxlength' => true])?>

		<?= $form->field($usuario, 'txt_apellido_paterno')->textInput(['maxlength' => true])?>

		<?= $form->field($usuario, 'txt_apellido_materno')->textInput(['maxlength' => true])?>
		
		<?= $form->field($usuario, 'txt_email')->textInput(['maxlength' => true])?>
		
		<?= $form->field($usuario, 'imageProfile', ['template'=>'<div class="btn"><span>Imagen</span>{input}</div><div class="file-path-wrapper"><input class="file-path validate" type="text"/></div>{error}','options'=>['class'=>'file-field input-field col s12 m6']])->fileInput()?>
		
	</div>

	<?= Html::submitButton('<span class="ladda-label">Crear</span>',['id'=>'js-editar-submit-usuario', 'class'=>'btn btn-submit waves-effect waves-light ladda-button animated delay-3', 'name'=>'boton-usuario', 'data-style'=>'zoom-in'])?>

<?php

ActiveForm::end ();

$idUsuario = Yii::$app->user->identity->id_usuario;

//creditos
$creditosTotales = new VistaTotalCreditos();
$total = $creditosTotales->find()->where(['id_usuario'=>$idUsuario])->one();

//comentarios
$comentarios = new EntComentariosPosts();
$comentariosMostrar = $comentarios->find()->where(['id_usuario'=>$idUsuario])->orderBy('id_comentario_post DESC')->limit(5)->all();

//espejos
$espejos = new EntPosts();
$espejoMostar = $espejos->find()->where(['id_tipo_post'=>1])->andWhere(['id_usuario'=>$idUsuario])->orderBy('id_post DESC')->limit(5)->all();
?>

<p>Numero de creditos disponibles: <?= $total->num_total_creditos?></p>

<p>Ultimos 5 comentarios realizados</p>
<?php 
	foreach($comentariosMostrar as $com){
		echo $com->txt_comentario;
		echo "<br>";
		echo $com->fch_comentario;
		echo "<br>";
		echo "<br>";
	}
?>

<p>Ultimos 5 espejos relizados</p>

<?php 
	foreach($espejoMostar as $esp){
?>		
		<div onClick="showPostFull('<?=$esp->txt_token?>')">
			<?= "Pregunta realizada el dias " . $esp->fch_creacion;?>
			<br>
			<?= $esp->txt_descripcion;?>
			<br>
			<br>
		</div>
<?php } ?>

<div id="js-tmp" style="display: none;"></div>

<div id="backScreen">
	<div id="wrapper" style="height:100%">
		<i onclick="hidePostFull()" class="icon-close"></i>
		<div id="js-content" class="full-pin-content">
			<div style="
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    position: relative;
">
<div class="preloader-wrapper big active">
    <div class="spinner-layer spinner-blue-only">
      <div class="circle-clipper left">
        <div class="circle"></div>
      </div><div class="gap-patch">
        <div class="circle"></div>
      </div><div class="circle-clipper right">
        <div class="circle"></div>
      </div>
    </div>
  </div>

  </div>
		
		</div>
	</div>
</div>
</div>

@extends('front.layouts.app')

@section('title', 'Accueil - COOPROM | Promotion des Artistes & Culture Africaine')

@section('content')
    <!-- Main Slider -->
    <section class="main-slider">
        <div class="rev_slider_wrapper fullwidthbanner-container" id="rev_slider_two_wrapper" data-source="gallery">
            <div class="rev_slider fullwidthabanner" id="rev_slider_two" data-version="5.4.1">
                <ul>
                    <!-- Slide 1: Promotion -->
                    <li data-index="rs-1" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="" data-delay="5000" data-rotate="0" data-saveperformance="off" data-title="Promotion" data-description="">
                        <img src="{{ asset('assets/front/images/main-slider/slide1.jpg') }}" title="Promotion COOPROM" data-bg="p:center top;" data-parallax="off" class="rev-slidebg" data-no-retina>
                        <div class="tp-caption" data-paddingleft="[15,15,15,15]" data-responsive_offset="on" data-type="text" data-height="none" data-width="['1000','900','750','650']" data-voffset="['-100','-100','-120','-120']" data-x="['left','left','center','center']" data-y="['middle','middle','middle','middle']" data-frames='[{"delay":500,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <h2 class="text-white" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8); white-space: nowrap;">PROMOTION ARTISTIQUE</h2>
                        </div>
                        <div class="tp-caption" data-paddingleft="[15,15,15,15]" data-responsive_offset="on" data-type="text" data-height="none" data-width="['1000','900','750','650']" data-voffset="['10','10','10','10']" data-x="['left','left','center','center']" data-y="['middle','middle','middle','middle']" data-frames='[{"delay":500,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="text text-white" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.8); font-weight: 600; background: rgba(0,0,0,0.2); padding: 10px; border-radius: 5px;">Valoriser la culture ivoirienne et africaine partout dans le monde. La COOPROM apporte une assistance technique et matérielle à ses adhérents.</div>
                        </div>
                        @if (!Auth::user())
                            <div class="tp-caption" data-paddingleft="[15,15,15,15]" data-responsive_offset="on" data-type="text" data-height="none" data-width="['650','650','650','250']" data-voffset="['120','120','140','140']" data-x="['left','left','center','center']" data-y="['middle','middle','middle','middle']" data-frames='[{"delay":500,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                                <div class="btn-box"><a href="{{route('register')}}" class="theme-btn btn-style-one bg_red"><span class="btn-title">Devenir Adhérent</span></a></div>
                            </div>
                        @endif
                    </li>

                    <!-- Slide 2: Voyages & Réseautage -->
                    <li data-index="rs-2" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb=""  data-delay="5000"  data-rotate="0"  data-saveperformance="off"  data-title="Voyages" data-description="">
                        <img src="{{ asset('assets/front/images/background/banner.jpeg') }}" title="Voyages d'Affaires" data-bg="p:center top;" data-parallax="off" class="rev-slidebg" data-no-retina>
                        <div class="tp-caption" data-paddingleft="[15,15,15,15]" data-responsive_offset="on" data-type="text" data-height="none" data-width="['1000','900','750','650']" data-voffset="['-100','-100','-120','-120']" data-x="['left','left','center','center']" data-y="['middle','middle','middle','middle']" data-frames='[{"delay":500,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <h2 class="text-white" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8); white-space: nowrap;">VOYAGES & RÉSEAUTAGE</h2>
                        </div>
                        <div class="tp-caption" data-paddingleft="[15,15,15,15]" data-responsive_offset="on" data-type="text" data-height="none" data-width="['1000','900','750','650']" data-voffset="['10','10','10','10']" data-x="['left','left','center','center']" data-y="['middle','middle','middle','middle']" data-frames='[{"delay":500,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="text text-white" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.8); font-weight: 600; background: rgba(0,0,0,0.2); padding: 10px; border-radius: 5px;">Connectez-vous au monde entier. Nous organisons vos voyages d'affaires et facilitons vos échanges internationaux.</div>
                        </div>
                        <div class="tp-caption" data-paddingleft="[15,15,15,15]" data-responsive_offset="on" data-type="text" data-height="none" data-width="['650','650','650','250']" data-voffset="['120','120','140','140']" data-x="['left','left','center','center']" data-y="['middle','middle','middle','middle']" data-frames='[{"delay":500,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="btn-box"><a href="#" class="theme-btn btn-style-one bg_red"><span class="btn-title">En savoir plus</span></a></div>
                        </div>
                    </li>

                    <!-- Slide 3: Production -->
                    <li data-index="rs-3" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb=""  data-delay="5000"  data-rotate="0"  data-saveperformance="off"  data-title="Production" data-description="">
                        <img src="{{ asset('assets/front/images/resource/members/production.jpeg') }}" title="Production Numérique" data-bg="p:center top;" data-parallax="off" class="rev-slidebg" data-no-retina>
                        <div class="tp-caption" data-paddingleft="[15,15,15,15]" data-responsive_offset="on" data-type="text" data-height="none" data-width="['1000','900','750','650']" data-voffset="['-100','-100','-120','-120']" data-x="['left','left','center','center']" data-y="['middle','middle','middle','middle']" data-frames='[{"delay":500,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <h2 class="text-white" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.8); white-space: nowrap;">PRODUCTION NUMÉRIQUE</h2>
                        </div>
                        <div class="tp-caption" data-paddingleft="[15,15,15,15]" data-responsive_offset="on" data-type="text" data-height="none" data-width="['1000','900','750','650']" data-voffset="['10','10','10','10']" data-x="['left','left','center','center']" data-y="['middle','middle','middle','middle']" data-frames='[{"delay":500,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="text text-white" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.8); font-weight: 600; background: rgba(0,0,0,0.2); padding: 10px; border-radius: 5px;">Une plateforme de production axée sur les pratiques artistiques offertes par les nouvelles technologies "temps réel".</div>
                        </div>
                        <div class="tp-caption" data-paddingleft="[15,15,15,15]" data-responsive_offset="on" data-type="text" data-height="none" data-width="['650','650','650','250']" data-voffset="['120','120','140','140']" data-x="['left','left','center','center']" data-y="['middle','middle','middle','middle']" data-frames='[{"delay":500,"speed":2000,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="btn-box"><a href="#" class="theme-btn btn-style-one bg_red"><span class="btn-title">Découvrir</span></a></div>
                        </div>
                    </li>


                </ul>
            </div>
        </div>
    </section>

    <!-- Missions & Features -->
    <section class="top-features" style="background-image: url({{ asset('assets/front/images/background/5.jpg') }});">
        <div class="auto-container">
            <div class="row">
                <!-- Feature: Promotion -->
                <div class="feature-block-two col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <span class="icon flaticon-speech-bubble"></span>
                        <h4 class="text-white">Promotion</h4>
                        <div class="text text-white">Améliorer les techniques de promotion, distribution et vente d'œuvres artistiques.</div>
                    </div>
                </div>
                <!-- Feature: Production -->
                <div class="feature-block-two col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <span class="icon flaticon-online-shopping"></span>
                        <h4 class="text-white">Production</h4>
                        <div class="text text-white">Accès à une plateforme de production numérique et formation aux nouvelles technologies.</div>
                    </div>
                </div>
                <!-- Feature: Voyage -->
                <div class="feature-block-two col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <span class="icon flaticon-box"></span>
                        <h4 class="text-white">Voyages</h4>
                        <div class="text text-white">Organisation de voyages d'affaires pour connecter les artistes au monde entier.</div>
                    </div>
                </div>
                <!-- Feature: Assistance -->
                <div class="feature-block-two col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <span class="icon flaticon-wallet"></span>
                        <h4 class="text-white">Assistance</h4>
                        <div class="text text-white">Aide au visa, expertise juridique pour vos contrats et assistance sociale.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="auto-container">
            <div class="row">
                <div class="text-column col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <span class="sub-title">NOS ACTIVITÉS</span>
                            <h3>Des services sur mesure pour les artistes</h3>
                            <div class="text"><strong>De la production de clips vidéo à l'organisation d'événements mondiaux, nous couvrons tous les aspects de votre carrière.</strong></div>
                        </div>
                        <p>La COOPROM s’est entourée d’une équipe jeune, dynamique et compétente prête à entreprendre toutes actions multiples permettant de valoriser la culture africaine.</p>
                        <a href="#" class="theme-btn icon-btn-two bg_red"><span>Voir tout</span></a>
                    </div>
                </div>
                <div class="column col-lg-7 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <!-- Service: Clip Vidéo -->
                            <div class="service-block reverse-hover">
                                <div class="inner-box">
                                    <div class="hover_layer" style="background-image: url({{ asset('assets/front/images/resource/home/serv_video_photo.jpeg') }});"></div>
                                    <span class="icon"><img src="{{ asset('assets/front/images/icons/service_icon_1.png') }}" alt="Production Clip"></span>
                                    <h3>Clips & Vidéos</h3>
                                    <div class="text">Production de clips vidéo, publi-reportages et cinéma.</div>
                                    <a href="#" class="overlay-link"></a>
                                </div>
                            </div>
                            <!-- Service: Voyage Business -->
                            <div class="service-block reverse-hover">
                                <div class="inner-box">
                                    <div class="hover_layer" style="background-image: url({{ asset('assets/front/images/resource/home/serv_voy_affaire.jpeg') }});"></div>
                                    <span class="icon"><img src="{{ asset('assets/front/images/icons/service_icon_3.png') }}" alt="Voyage Affaire"></span>
                                    <h3>Voyages d'Affaires</h3>
                                    <div class="text">Mise en relation et échanges culturels de haut niveau.</div>
                                    <a href="#" class="overlay-link"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <!-- Service: Galeries Virtuelles -->
                            <div class="service-block margin-top-50 reverse-hover">
                                <div class="inner-box">
                                    <div class="hover_layer" style="background-image: url({{ asset('assets/front/images/resource/home/serv_galerie_virtuelle.jpeg') }});"></div>
                                    <span class="icon"><img src="{{ asset('assets/front/images/icons/service_icon_2.png') }}" alt="Galerie Virtuelle"></span>
                                    <h3>Galeries Virtuelles</h3>
                                    <div class="text">Valorisation de l'art par les technologies "temps réel".</div>
                                    <a href="#" class="overlay-link"></a>
                                </div>
                            </div>
                            <!-- Service: Juridique -->
                            <div class="service-block reverse-hover">
                                <div class="inner-box">
                                    <div class="hover_layer" style="background-image: url({{ asset('assets/front/images/resource/home/serv_expert_jur.jpeg') }});"></div>
                                    <span class="icon"><img src="{{ asset('assets/front/images/icons/service_icon_4.png') }}" alt="Conseil Juridique"></span>
                                    <h3>Expertise Juridique</h3>
                                    <div class="text">Rédaction de vos contrats de production et de distribution.</div>
                                    <a href="#" class="overlay-link"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Section -->
    <section class="brand-section">
        <div class="upper-banner" style="background-image: url({{ asset('assets/front/images/background/7.jpg') }});">
            <div class="auto-container">
                <div class="row">
                    <div class="quot-column col-lg-6 col-md-12 col-sm-12">
                        <blockquote class="quote-style-one">
                            <span class="icon flaticon-cloud"></span>
                            <p><a href="#">Le progrès matériel technologique <br> au service de l’artiste ivoirien.</a></p>
                        </blockquote>
                    </div>
                    <div class="text-column col-lg-6 col-md-12 col-sm-12">
                        <div class="text">Nous mobilisons des ressources dynamiques pour soutenir le développement de nos membres. Notre réseau s'étend pour offrir les meilleures opportunités technologiques et artistiques.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="auto-container">
            <!-- Brand Block -->
            <div class="brand-block row no-gutters">
                <div class="image-column col-lg-6 col-md-12" style="background-image: url({{ asset('assets/front/images/background/partner_network.png') }});"></div>
                <div class="content-column col-lg-6 col-md-12">
                    <div class="inner-column">
                        <h3>Partenariat & Réseautage</h3>
                        <div class="text">La COOPROM noue des contacts avec d’autres acteurs des arts et de la culture dans le monde pour favoriser les échanges et les signatures de contrats.</div>
                        <a href="#" class="theme-btn icon-btn-two bg_red"><span>En savoir plus</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Brand Section -->

    <!-- Team Section -->
    <section class="team-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="icon flaticon-team-1"></span>
                <h3>Notre Équipe Professionnelle</h3>
                <div class="text">La COOPROM s’est entourée d’une équipe jeune, dynamique et compétente <br> prête à entreprendre toutes actions pour valoriser la culture.</div>
            </div>

            <div class="row">
                <!-- Team Block 1 -->
                <div class="team-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="#"><img src="{{ asset('assets/front/images/resource/team-1.jpg') }}" alt=""></a></figure>
                            <ul class="social-links">
                                <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                <li><a href="#"><span class="fab fa-vimeo-v"></span></a></li>
                                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                            </ul>
                        </div>
                        <div class="info-box">
                            <h5 class="name"><a href="#">Nom du Membre</a></h5>
                            <span class="designation">Designation</span>
                        </div>
                    </div>
                </div>

                <!-- Team Block 2 -->
                <div class="team-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="#"><img src="{{ asset('assets/front/images/resource/team-2.jpg') }}" alt=""></a></figure>
                            <ul class="social-links">
                                <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                <li><a href="#"><span class="fab fa-vimeo-v"></span></a></li>
                                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                            </ul>
                        </div>
                        <div class="info-box">
                            <h5 class="name"><a href="#">Nom du Membre</a></h5>
                            <span class="designation">Designation</span>
                        </div>
                    </div>
                </div>

                <!-- Team Block 3 -->
                <div class="team-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="#"><img src="{{ asset('assets/front/images/resource/team-3.jpg') }}" alt=""></a></figure>
                            <ul class="social-links">
                                <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                <li><a href="#"><span class="fab fa-vimeo-v"></span></a></li>
                                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                            </ul>
                        </div>
                        <div class="info-box">
                            <h5 class="name"><a href="#">Nom du Membre</a></h5>
                            <span class="designation">Designation</span>
                        </div>
                    </div>
                </div>

                <!-- Team Block 4 -->
                <div class="team-block col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="1200ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="#"><img src="{{ asset('assets/front/images/resource/team-4.jpg') }}" alt=""></a></figure>
                            <ul class="social-links">
                                <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                                <li><a href="#"><span class="fab fa-vimeo-v"></span></a></li>
                                <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                            </ul>
                        </div>
                        <div class="info-box">
                            <h5 class="name"><a href="#">Nom du Membre</a></h5>
                            <span class="designation">Designation</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sec-bottom-text">Notre équipe est à votre disposition pour vous accompagner. <a href="#">Commencez dès maintenant</a></div>
        </div>
    </section>

    <!-- Clients Section -->
    <section class="clients-section style-two">
        <div class="auto-container">
            <div class="sec-title-two text-center">
                <span class="title">NOS PARTENAIRES</span>
                <h3>Ils nous font confiance</h3>
            </div>
            <!-- Sponsors Outer -->
            <div class="sponsors-outer">
                <!--Sponsors Carousel-->
                <ul class="sponsors-carousel owl-carousel owl-theme">
                    <li class="slide-item">
                        <a href="#">
                            <img src="{{ asset('assets/front/images/clients/1_hover_red.png') }}" alt="" class="hover_img">
                            <img src="{{ asset('assets/front/images/clients/1.png') }}" alt="">
                        </a>
                    </li>
                    <li class="slide-item">
                        <a href="#">
                            <img src="{{ asset('assets/front/images/clients/2_hover_red.png') }}" alt="" class="hover_img">
                            <img src="{{ asset('assets/front/images/clients/2.png') }}" alt="">
                        </a>
                    </li>
                    <li class="slide-item">
                        <a href="#">
                            <img src="{{ asset('assets/front/images/clients/3_hover_red.png') }}" alt="" class="hover_img">
                            <img src="{{ asset('assets/front/images/clients/3.png') }}" alt="">
                        </a>
                    </li>
                    <li class="slide-item">
                        <a href="#">
                            <img src="{{ asset('assets/front/images/clients/4_hover_red.png') }}" alt="" class="hover_img">
                            <img src="{{ asset('assets/front/images/clients/4.png') }}" alt="">
                        </a>
                    </li>
                    <li class="slide-item">
                        <a href="#">
                            <img src="{{ asset('assets/front/images/clients/5_hover_red.png') }}" alt="" class="hover_img">
                            <img src="{{ asset('assets/front/images/clients/5.png') }}" alt="">
                        </a>
                    </li>
                    <li class="slide-item">
                        <a href="#">
                            <img src="{{ asset('assets/front/images/clients/6_hover_red.png') }}" alt="" class="hover_img">
                            <img src="{{ asset('assets/front/images/clients/6.png') }}" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Clients Section -->

    <!-- Call to Action: Adhésion -->
    <section class="call-to-action style-two" style="background-image: url({{ asset('assets/front/images/background/5.jpg') }});">
        <div class="auto-container">
            <div class="content">
                <div class="sec-title-two">
                    <span class="icon flaticon-question-1"></span>
                    <h3>Rejoignez la famille COOPROM</h3>
                    <div class="text">Bénéficiez d'un accompagnement professionnel pour propulser votre art au niveau supérieur.</div>
                </div>
                <div class="btn-box">
                    <a href="#" class="theme-btn icon-btn-two bg_red"><span>S'inscrire Maintenant</span></a>
                </div>
            </div>
        </div>
    </section>
@endsection

    <footer class="main-footer" style="background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%); color: #444; padding-top: 80px; position: relative; overflow: hidden;">
        <!-- Element Décoratif Créatif -->
        <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(250, 88, 77, 0.05); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: rgba(250, 88, 77, 0.03); border-radius: 50%;"></div>

        <div class="auto-container">
            <!--Widgets Section-->
            <div class="widgets-section" style="padding-top: 0;">
                <div class="row">
                    <!-- Colonne À Propos -->
                    <div class="footer-column col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="footer-widget about-widget">
                            <div class="logo mb-4" style="top: 0;">
                                <a href="/"><img src="{{ asset('assets/front/images/logo.jpeg') }}" alt="COOPROM" style="max-width: 180px; height: auto; filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.1));"></a>
                            </div>
                            <div class="text" style="color: #666; font-size: 15px; line-height: 1.8; margin-bottom: 30px;">
                                La COOPROM est une coopérative culturelle visionnaire. Nous forgeons des carrières artistiques d'exception et portons l'éclat de la culture africaine sur la scène mondiale avec passion et innovation.
                            </div>
                            <div class="social-links-new">
                                <ul class="d-flex align-items-center" style="list-style: none; padding: 0; gap: 15px;">
                                    <li><a href="#" class="social-icon-btn"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#" class="social-icon-btn"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#" class="social-icon-btn"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="#" class="social-icon-btn"><i class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Liens Rapides -->
                    <div class="footer-column col-xl-2 col-lg-2 col-md-6 col-sm-12">
                        <div class="footer-widget links-widget">
                            <h2 class="widget-title" style="color: #222 !important; font-size: 20px; font-weight: 700; margin-bottom: 30px; position: relative; padding-bottom: 10px;">
                                La Cooprom
                                <span style="position: absolute; left: 0; bottom: 0; width: 30px; height: 3px; background: #fa584d; border-radius: 2px;"></span>
                            </h2>
                            <div class="widget-content">
                                <ul class="list-new" style="list-style: none; padding: 0;">
                                    <li style="margin-bottom: 15px;"><a href="{{ route('cooprom.presentation') }}">Présentation</a></li>
                                    <li style="margin-bottom: 15px;"><a href="{{ route('cooprom.missions') }}">Missions & Objectifs</a></li>
                                    <li style="margin-bottom: 15px;"><a href="{{ route('cooprom.partenaires') }}">Nos Partenaires</a></li>
                                    <li style="margin-bottom: 15px;"><a href="{{ route('register') }}">Devenir Adhérent</a></li>
                                    <li style="margin-bottom: 15px;"><a href="{{ route('contact') }}">Nous Contacter</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Services -->
                    <div class="footer-column col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="footer-widget links-widget">
                            <h2 class="widget-title" style="color: #222 !important; font-size: 20px; font-weight: 700; margin-bottom: 30px; position: relative; padding-bottom: 10px;">
                                Nos Services
                                <span style="position: absolute; left: 0; bottom: 0; width: 30px; height: 3px; background: #fa584d; border-radius: 2px;"></span>
                            </h2>
                            <div class="widget-content">
                                <ul class="list-new" style="list-style: none; padding: 0;">
                                    <li style="margin-bottom: 15px;"><a href="{{ route('services.promotion') }}">Promotion Artistique</a></li>
                                    <li style="margin-bottom: 15px;"><a href="{{ route('services.production') }}">Production Numérique</a></li>
                                    <li style="margin-bottom: 15px;"><a href="{{ route('services.travels') }}">Voyages d'Affaires</a></li>
                                    <li style="margin-bottom: 15px;"><a href="{{ route('assistance.legal') }}">Conseil Juridique</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Contact & Newsletter -->
                    <div class="footer-column col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="footer-widget contact-widget">
                            <h2 class="widget-title" style="color: #222 !important; font-size: 20px; font-weight: 700; margin-bottom: 30px; position: relative; padding-bottom: 10px;">
                                Nous Contacter
                                <span style="position: absolute; left: 0; bottom: 0; width: 30px; height: 3px; background: #fa584d; border-radius: 2px;"></span>
                            </h2>
                            <div class="widget-content">
                                <ul class="contact-info-new" style="list-style: none; padding: 0;">
                                    <li style="display: flex; align-items: flex-start; margin-bottom: 20px;">
                                        <div style="width: 35px; color: #fa584d;"><i class="fa fa-map-marker-alt"></i></div>
                                        <span style="color: #666; font-size: 14px;">Abidjan, Côte d'Ivoire, Cocody Angré</span>
                                    </li>
                                    <li style="display: flex; align-items: flex-start; margin-bottom: 20px;">
                                        <div style="width: 35px; color: #fa584d;"><i class="fa fa-phone"></i></div>
                                        <a href="tel:+2250102030405" style="color: #666; font-size: 14px; text-decoration: none;">+225 01 02 03 04 05</a>
                                    </li>
                                    <li style="display: flex; align-items: flex-start; margin-bottom: 20px;">
                                        <div style="width: 35px; color: #fa584d;"><i class="fa fa-envelope"></i></div>
                                        <a href="mailto:contact@cooprom.ci" style="color: #666; font-size: 14px; text-decoration: none;">contact@cooprom.ci</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom" style="background: #fff; border-top: 1px solid rgba(0,0,0,0.05);">
            <div class="auto-container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-left">
                        <div class="copyright-text" style="color: #888; font-size: 14px;">
                            © {{ date('Y') }} <span style="color: #fa584d; font-weight: 700;">COOPROM</span>. Créé avec passion pour la culture.
                        </div>
                    </div>
                    <div class="col-md-6 text-center text-md-right mt-3 mt-md-0">
                        <ul style="list-style: none; display: inline-flex; gap: 20px;">
                            <li><a href="#" style="color: #888; font-size: 13px; text-decoration: none;">Mentions Légales</a></li>
                            <li><a href="#" style="color: #888; font-size: 13px; text-decoration: none;">Confidentialité</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <style>
        .list-new li a {
            color: #666 !important;
            transition: 0.3s;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
        }
        .list-new li a:hover {
            color: #fa584d !important;
            padding-left: 5px;
        }
        .social-icon-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: #fa584d !important;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: 0.3s;
            text-decoration: none !important;
        }
        .social-icon-btn:hover {
            background: #fa584d !important;
            color: #fff !important;
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(250, 88, 77, 0.3);
        }
        @media (max-width: 767px) {
            .footer-column {
                margin-bottom: 40px;
            }
        }
    </style>

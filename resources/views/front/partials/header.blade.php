    <header class="main-header header-style-two">
        <!-- Header top -->
        <div class="header-top">
            <div class="inner-container">
                <div class="top-left">
                    <div class="service-num">
                            <a href="tel:+2250102030405"><i class="fa fa-phone"></i> +225 01 02 03 04 05</a>
                            <div class="text">Contactez-nous pour toute question</div>
                        </div>
                </div>
                <div class="top-right">
                    <ul class="contact-list">
                        <li><a href="mailto:contact@cooprom.org"><i class="fa fa-envelope"></i> contact@cooprom.org</a></li>
                        <li><i class="fa fa-map-marker-alt"></i> Abidjan, Côte d'Ivoire</li>
                        @auth
                            <li class="dropdown" style="margin-left: 10px; position: relative;">
                                <a href="#" class="dropdown-toggle no-caret" data-toggle="dropdown" style="color: #333; font-size: 18px; position: relative; display: inline-block;">
                                    <i class="fa fa-bell"></i>
                                    <span id="notification-count" class="badge badge-danger" style="position: absolute; top: -5px; right: -8px; font-size: 9px; border-radius: 50%; padding: 2px 5px; min-width: 15px; height: 15px; display: flex; align-items: center; justify-content: center; {{ auth()->user()->unreadNotifications->count() > 0 ? '' : 'display: none;' }}">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                </a>
                                <style>
                                    .header-top .dropdown-toggle.no-caret::after {
                                        display: none !important;
                                    }
                                </style>
                                <div class="dropdown-menu dropdown-menu-right shadow-lg border-0" style="min-width: 300px; border-radius: 10px; padding: 0;">
                                    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 font-weight-bold">Notifications</h6>
                                        <a href="{{ route('member.notifications.index') }}" class="small text-info">Tout voir</a>
                                    </div>
                                    <div id="notification-list" style="max-height: 300px; overflow-y: auto;">
                                        @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                                            <a href="{{ route('member.notifications.index') }}" class="dropdown-item p-3 border-bottom d-flex align-items-start" style="white-space: normal;">
                                                <div class="bg-light text-info rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 35px; height: 35px; flex-shrink: 0;">
                                                    <i class="fa {{ $notification->data['icon'] ?? 'fa-bell' }}" style="font-size: 14px;"></i>
                                                </div>
                                                <div style="flex-grow: 1;">
                                                    <div class="small font-weight-bold">{{ $notification->data['title'] ?? 'Notification' }}</div>
                                                    <div class="small text-muted">{{ Str::limit($notification->data['message'] ?? '', 50) }}</div>
                                                    <div class="very-small text-muted mt-1" style="font-size: 10px;">{{ $notification->created_at->diffForHumans() }}</div>
                                                </div>
                                            </a>
                                        @empty
                                            <div class="p-4 text-center text-muted small">Aucune nouvelle notification</div>
                                        @endforelse
                                    </div>
                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                        <form action="{{ route('member.notifications.mark-all-read') }}" method="POST" class="p-2 text-center border-top">
                                            @csrf
                                            <button type="submit" class="btn btn-link btn-sm text-muted p-0" style="font-size: 11px;">Marquer tout comme lu</button>
                                        </form>
                                    @endif
                                </div>
                            </li>
                            <li class="btn-box" style="margin-left: 10px;">
                                <a href="{{ route('member.dashboard') }}" class="theme-btn btn-style-one" style="padding: 5px 15px; line-height: 1.1; font-size: 12px; border-radius: 30px; background-color: #fa584d; color: #fff; display: inline-flex; align-items: center; justify-content: center;">
                                    <span class="btn-title" style="color: #fff; display: flex; align-items: center;"><i class="fa fa-user-circle" style="margin-right: 5px;"></i> Mon Espace</span>
                                </a>
                            </li>
                        @else
                            <li class="btn-box" style="margin-left: 10px;">
                                <a href="{{ route('login') }}" class="theme-btn btn-style-one" style="padding: 5px 15px; line-height: 1.1; font-size: 12px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 30px; display: inline-flex; align-items: center; justify-content: center;">
                                    <span class="btn-title" style="color: #155724; display: flex; align-items: center;"><i class="fa fa-lock" style="margin-right: 5px;"></i> Connexion</span>
                                </a>
                            </li>
                            <li class="btn-box" style="margin-left: 5px;">
                                <a href="{{ route('register') }}" class="theme-btn btn-style-one" style="padding: 5px 15px; line-height: 1.1; font-size: 12px; border-radius: 30px; background-color: #ffb347; color: #fff; display: inline-flex; align-items: center; justify-content: center;">
                                    <span class="btn-title" style="display: flex; align-items: center;"><i class="fa fa-user-plus" style="margin-right: 5px;"></i> Devenir Adhérent</span>
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Header Top -->

        <!-- Main box -->
        <div class="main-box">
            <div class="auto-container">
                <div class="menu-box">
                    <div class="logo"><a href="/"><img src="{{ asset('assets/front/images/logo.jpg') }}" alt="COOPROM" title="COOPROM" ></a></div>

                    <!--Nav Box-->
                    <div class="nav-outer">
                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li class="{{request()->routeIs("home") ? 'current' : ''}}"><a href="/"><span>Accueil</span></a></li>

                                    <li class="dropdown {{ request()->routeIs('cooprom.*') ? 'current' : '' }}" >
                                        <a href="#"><span>La Cooprom</span></a>
                                        <ul class="dropdown-menu">
                                            <li class="{{request()->routeIs("cooprom.presentation") ? 'current' : ''}}"><a href="{{ route('cooprom.presentation') }}">Présentation</a></li>
                                            <li class="{{request()->routeIs("cooprom.missions") ? 'current' : ''}}"><a href="{{ route('cooprom.missions') }}">Missions & Objectifs</a></li>
                                            <li class="{{request()->routeIs("cooprom.partenaires") ? 'current' : ''}}"><a href="{{ route('cooprom.partenaires') }}">Partenaires</a></li>
                                            <li class="{{request()->routeIs("cooprom.gallery_photos") ? 'current' : ''}}"><a href="{{ route('cooprom.gallery_photos') }}">Gallérie photos</a></li>
                                            <li class="{{request()->routeIs("cooprom.gallery_videos") ? 'current' : ''}}"><a href="{{ route('cooprom.gallery_videos') }}">Gallérie vidéos</a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown {{ request()->routeIs('services.*') ? 'current' : '' }}">
                                        <a href="#"><span>Services</span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('services.promotion') }}">Promotion Artistique</a></li>
                                            <li><a href="{{ route('services.production') }}">Production Numérique</a></li>
                                            <li><a href="{{ route('services.travels') }}">Voyages d'Affaires</a></li>
                                            <li><a href="{{ route('services.events') }}">Événementiel</a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown {{ request()->routeIs('assistance.*') ? 'current' : '' }}">
                                        <a href="#"><span>Assistance</span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('assistance.visa') }}">Assistance Visa</a></li>
                                            <li><a href="{{ route('assistance.legal') }}">Conseil Juridique</a></li>
                                            <li><a href="{{ route('assistance.social') }}">Aide Sociale</a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown d-lg-none {{ request()->routeIs('member.*') ? 'current' : '' }}">
                                        @auth
                                            <a href="#"><span>Mon Espace</span></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('member.dashboard') }}"><i class="fa fa-th-large mr-2"></i> Tableau de bord</a></li>
                                                <li><a href="{{ route('member.profile.edit') }}"><i class="fa fa-user-circle mr-2"></i> Mon Profil</a></li>
                                                <li><a href="{{ route('member.productions.index') }}"><i class="fa fa-compact-disc mr-2"></i> Mes Productions</a></li>
                                                <li><a href="{{ route('member.contracts.index') }}"><i class="fa fa-file-signature mr-2"></i> Mes Contrats</a></li>
                                                <li><a href="{{ route('member.legal.index') }}"><i class="fa fa-gavel mr-2"></i> Conseil Juridique</a></li>
                                                <li><a href="{{ route('member.travels.index') }}"><i class="fa fa-plane-departure mr-2"></i> Voyages & Visas</a></li>
                                                <li><a href="{{ route('member.social.index') }}"><i class="fa fa-hand-holding-heart mr-2"></i> Aide Sociale</a></li>
                                                <li><a href="{{ route('member.appointments.index') }}"><i class="fa fa-calendar-alt mr-2"></i> Mes Rendez-vous</a></li>
                                                <li>
                                                    <form action="{{ route('logout') }}" method="POST" id="logout-form-mobile" style="display: none;">@csrf</form>
                                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" class="text-danger">
                                                        <i class="fa fa-power-off mr-2"></i> Déconnexion
                                                    </a>
                                                </li>
                                            </ul>
                                        @else
                                            <a href="{{ route('login') }}"><span>Connexion</span></a>
                                            <a href="{{ route('register') }}"><span>Devenir Adhérent</span></a>
                                        @endauth
                                    </li>

                                    <li><a href="#"><span>Contact</span></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>

                    <div class="outer-box">
                        <div class="service_wrapper">
                            <span class="icon flaticon-whatsapp"></span>
                            <p>Vous avez des Questions?</p>
                            <h4>07 12 12 12 12</h4>
                        </div>

                        <!-- Search Btn -->
                        <div class="search-box">
                            <button class="search-btn"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="main-box">
                <!--Keep This Empty / Menu will come through Javascript-->
            </div>
        </div><!-- End Sticky Menu -->

        <!-- Mobile Header -->
        <div class="mobile-header">
            <div class="logo"><a href="{{route('home')}}"><img src="{{ asset('assets/front/images/logo.jpg') }}" alt="" title="" ></a></div>

            <!--Nav Box-->
            <div class="nav-outer clearfix">
                <!--Keep This Empty / Menu will come through Javascript-->
            </div>
        </div>

        <!-- Mobile Sticky Header -->
        <div class="mobile-sticky-header">
            <div class="logo"><a href="{{route('home')}}"><img src="{{ asset('assets/front/images/logo.jpg') }}" alt="" title="" ></a></div>

            <!--Nav Box-->
            <div class="nav-outer clearfix">
                <!--Keep This Empty / Menu will come through Javascript-->
            </div>
        </div>

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <style>
                @media only screen and (min-width: 768px) {
                    .d-lg-none {
                        display: none !important;
                    }
                }
                /* Style créatif pour la section Espace Membre et Auth dans le menu mobile */
                .mobile-menu .navigation li.dropdown.d-lg-none > a,
                .mobile-menu .navigation li.d-lg-none > a {
                    background: rgba(250, 88, 77, 0.1);
                    color: #fa584d !important;
                    font-weight: 700 !important;
                    border-left: 4px solid #fa584d;
                    margin: 10px 15px;
                    border-radius: 5px;
                }
                .mobile-menu .navigation li.dropdown.d-lg-none .dropdown-btn {
                    color: #fa584d !important;
                }
                .mobile-menu .navigation li.dropdown.d-lg-none ul li a {
                    padding-left: 30px !important;
                    font-size: 14px;
                }
                .mobile-menu .navigation li.dropdown.d-lg-none ul li a i {
                    width: 20px;
                    text-align: center;
                    color: #fa584d;
                }
                .mobile-menu .user-profile-mobile {
                    padding: 20px 15px;
                    background: #f8f9fa;
                    border-bottom: 1px solid #eee;
                    display: flex;
                    align-items: center;
                    gap: 15px;
                }
                .mobile-menu .user-profile-mobile img {
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    object-fit: cover;
                    border: 2px solid #fa584d;
                }
                .mobile-menu .user-profile-mobile .info h5 {
                    margin: 0;
                    font-size: 16px;
                    font-weight: 700;
                    color: #333;
                }
                .mobile-menu .user-profile-mobile .info span {
                    font-size: 12px;
                    color: #777;
                }
            </style>
            <span class="mobile-menu-back-drop"></span>
            <div class="menu-outer">
                <nav class="menu-box">
                    <div class="nav-logo"><a href="{{route('home')}}"><img src="{{ asset('assets/front/images/logo.jpg') }}" alt="" title="" ></a></div><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->

                    @auth
                        <div class="user-profile-mobile">
                            <img src="{{ auth()->user()->photo }}" alt="Avatar">
                            <div class="info">
                                <h5>{{ auth()->user()->name }} {{ auth()->user()->last_name }}</h5>
                                <span>{{ auth()->user()->culturalSector->name ?? 'Membre Adhérent' }}</span>
                            </div>
                        </div>
                    @endauth
                </nav>

                <div class="menu-search">
                    <form method="post">
                        <div class="form-group">
                            <input type="text" class="input" name="search-field" value="" placeholder="Search..." required="">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- End Mobile Menu -->

        <!-- Header Search -->
        <div class="search-popup">
            <span class="search-back-drop"></span>

            <div class="search-inner">
                <div class="auto-container">
                    <div class="upper-text">
                        <div class="text">Vous recherchez ?</div>
                        <button class="close-search"><span class="fa fa-times"></span></button>
                    </div>

                    <form method="post">
                        <div class="form-group">
                            <input type="search" name="search-field" value="" placeholder="Search..." required="">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Header Search -->
    </header>

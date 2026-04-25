<!-- ULTRA-MINIMAL HIGH-END HEADER COOPROM -->
<header class="cooprom-minimal-header">
    <div class="header-inner">
        <div class="auto-container">
            <div class="nav-flex-wrapper d-flex align-items-center justify-content-between">

                <!-- Brand (Solo Logo) -->
                <div class="brand-logo">
                    <a href="/">
                        <img src="{{ asset('assets/front/images/logo.jpg') }}" alt="COOPROM" class="minimal-logo-img">
                    </a>
                </div>

                <!-- Desktop Navigation (Typography Driven) -->
                <nav class="desktop-nav d-none d-lg-block">
                    <ul class="nav-links d-flex align-items-center mb-0 list-unstyled">
                        <li class="{{request()->routeIs("home") ? 'active' : ''}}"><a href="/">Accueil</a></li>
                        <li class="{{request()->routeIs("events.*") ? 'active' : ''}}"><a href="{{ route('events.index') }}">Agenda</a></li>

                        <li class="nav-dropdown">
                            <a href="#">Coopérative <i class="fa fa-chevron-down small ml-1" style="font-size: 8px;"></i></a>
                            <ul class="dropdown-list shadow-lg list-unstyled">
                                <li><a href="{{ route('cooprom.presentation') }}">Présentation</a></li>
                                <li><a href="{{ route('cooprom.missions') }}">Missions</a></li>
                                <li><a href="{{ route('cooprom.partenaires') }}">Partenaires</a></li>
                                <li><a href="{{ route('cooprom.gallery_photos') }}">Photos</a></li>
                                <li><a href="{{ route('cooprom.gallery_videos') }}">Vidéos</a></li>
                            </ul>
                        </li>

                        <li class="nav-dropdown">
                            <a href="#">Expertises <i class="fa fa-chevron-down small ml-1" style="font-size: 8px;"></i></a>
                            <ul class="dropdown-list shadow-lg list-unstyled">
                                <li><a href="{{ route('services.promotion') }}">Promotion</a></li>
                                <li><a href="{{ route('services.production') }}">Production</a></li>
                                <li><a href="{{ route('services.travels') }}">Voyages</a></li>
                                <li><a href="{{ route('services.events') }}">Événementiel</a></li>
                            </ul>
                        </li>

                        <li class="nav-dropdown">
                            <a href="#">Assistance <i class="fa fa-chevron-down small ml-1" style="font-size: 8px;"></i></a>
                            <ul class="dropdown-list shadow-lg list-unstyled">
                                <li><a href="{{ route('assistance.visa') }}">Visa</a></li>
                                <li><a href="{{ route('assistance.legal') }}">Juridique</a></li>
                                <li><a href="{{ route('assistance.social') }}">Social</a></li>
                            </ul>
                        </li>

                        <li class="{{ request()->routeIs('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav>

                <!-- Action Area -->
                <div class="action-area d-flex align-items-center">
                    @auth
                        <div class="user-trigger dropdown">
                            <a href="#" class="dropdown-toggle no-caret" data-toggle="dropdown">
                                <img src="{{ auth()->user()->photo }}" alt="User" class="avatar-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow-2xl border-0 mt-3 rounded-xl overflow-hidden">
                                <div class="px-4 py-3 bg-light border-bottom">
                                    <span class="d-block font-weight-bold small text-dark">{{ auth()->user()->name }}</span>
                                    <span class="d-block text-muted" style="font-size: 9px;">{{ auth()->user()->email }}</span>
                                </div>
                                <a class="dropdown-item py-2 px-4 small" href="{{ route('member.dashboard') }}">Dashboard</a>
                                <a class="dropdown-item py-2 px-4 small" href="{{ route('member.profile.edit') }}">Profil</a>
                                <div class="dropdown-divider m-0"></div>
                                <form action="{{ route('logout') }}" method="POST">@csrf
                                    <button type="submit" class="dropdown-item py-2 px-4 small text-danger">Déconnexion</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="login-link d-none d-md-block mr-4 text-dark font-weight-bold">Connexion</a>
                        <a href="{{ route('register') }}" class="cta-minimal">Nous rejoindre</a>
                    @endauth

                    <div class="mobile-nav-toggler d-lg-none ml-4 text-dark" style="cursor: pointer; font-size: 22px;">
                        <i class="fa fa-align-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PURE CSS MINIMALIST -->
    <style>
        /* Isolation from old design */
        .main-header, .header-top, .sticky-header, .mobile-header, .mobile-sticky-header, .search-popup, .header-style-two {
            display: none !important;
        }

        .cooprom-minimal-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 99999;
            padding: 22px 0;
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(0,0,0,0.03);
        }

        .cooprom-minimal-header.scrolled {
            padding: 10px 0;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 5px 30px rgba(0,0,0,0.04);
        }

        .minimal-logo-img { max-height: 48px; border-radius: 8px; transition: 0.4s; }
        .scrolled .minimal-logo-img { max-height: 38px; }

        .nav-links li { margin: 0 15px; position: relative; }
        .nav-links li a {
            font-size: 11px;
            font-weight: 700;
            color: #111 !important;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-decoration: none !important;
            opacity: 0.5;
            transition: 0.3s;
            display: block;
            padding: 10px 0;
        }
        .nav-links li:hover a, .nav-links li.active a { opacity: 1; color: #ff3c36 !important; }

        /* Dropdown Style */
        .nav-dropdown { position: relative; }
        .dropdown-list {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%) translateY(15px);
            background: white;
            min-width: 220px;
            padding: 15px 0;
            border-radius: 12px;
            opacity: 0;
            visibility: hidden;
            transition: 0.3s;
            z-index: 100;
        }
        .nav-dropdown:hover .dropdown-list { opacity: 1; visibility: visible; transform: translateX(-50%) translateY(0); }
        .dropdown-list li a {
            display: block;
            padding: 8px 25px;
            font-size: 13px !important;
            text-transform: none !important;
            color: #333 !important;
            opacity: 1 !important;
            letter-spacing: 0.2px !important;
            font-weight: 600 !important;
        }
        .dropdown-list li a:hover { background: #fff5f5; color: #ff3c36 !important; padding-left: 30px; }

        /* Actions */
        .login-link { font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; text-decoration: none !important; color: #222 !important; }
        .cta-minimal {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 12px 28px;
            background: #111;
            color: white !important;
            border-radius: 6px;
            text-decoration: none !important;
            transition: 0.3s;
        }
        .cta-minimal:hover { background: #ff3c36; transform: translateY(-2px); box-shadow: 0 10px 25px rgba(255, 60, 54, 0.2); }

        .avatar-circle { width: 38px; height: 38px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; box-shadow: 0 3px 15px rgba(0,0,0,0.1); transition: 0.3s; }
        .avatar-circle:hover { border-color: #ff3c36; transform: scale(1.05); }

        /* Unique Mobile Menu */
        .cooprom-mobile-overlay-fixed { position: fixed; top:0; right:-100%; width:100%; height:100%; z-index:1000000; transition: 0.5s; visibility:hidden; display: block !important; }
        .cooprom-mobile-overlay-fixed.is-open { right:0; visibility:visible; }
        .mobile-backdrop-blur { position:absolute; width:100%; height:100%; background:rgba(0,0,0,0.5); backdrop-filter: blur(5px); }
        .mobile-nav-panel { position:absolute; right:0; width:80%; max-width:320px; height:100%; background:white; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('scroll', function() {
                const h = document.querySelector('.cooprom-minimal-header');
                if (h) {
                    if (window.scrollY > 40) h.classList.add('scrolled');
                    else h.classList.remove('scrolled');
                }
            });

            const t = document.querySelector('.mobile-nav-toggler');
            const s = document.querySelector('.cooprom-mobile-overlay-fixed');
            const b = document.querySelector('.mobile-backdrop-blur');
            const c = document.querySelector('.close-mobile-nav');

            if(t) t.onclick = () => s.classList.add('is-open');
            if(b) b.onclick = () => s.classList.remove('is-open');
            if(c) c.onclick = () => s.classList.remove('is-open');
        });
    </script>

    <!-- MOBILE NAVIGATION PANEL -->
    <div class="cooprom-mobile-overlay-fixed">
        <div class="mobile-backdrop-blur"></div>
        <div class="mobile-nav-panel p-4">
            <div class="d-flex justify-content-between align-items-center mb-5 border-bottom pb-4">
                <img src="{{ asset('assets/front/images/logo.jpg') }}" height="35" style="border-radius: 5px;">
                <div class="close-mobile-nav text-dark" style="font-size: 30px; cursor:pointer;">&times;</div>
            </div>

            <ul class="list-unstyled mb-5">
                <li class="mb-4"><a href="/" class="h5 text-dark font-weight-bold text-decoration-none">Accueil</a></li>
                <li class="mb-4"><a href="{{ route('events.index') }}" class="h5 text-dark font-weight-bold text-decoration-none">Agenda</a></li>
                <li class="mb-4 border-top pt-4">
                    <span class="small text-danger text-uppercase font-weight-bold">Institution</span>
                    <div class="mt-3 pl-3">
                        <a href="{{ route('cooprom.presentation') }}" class="d-block mb-3 text-dark text-decoration-none font-weight-bold">La Coopérative</a>
                        <a href="{{ route('cooprom.gallery_photos') }}" class="d-block mb-3 text-dark text-decoration-none font-weight-bold">Nos Photos</a>
                    </div>
                </li>
            </ul>

            <div class="mobile-auth-area border-top pt-4">
                @auth
                    <a href="{{ route('member.dashboard') }}" class="btn btn-danger w-100 rounded-pill py-3">Espace Membre</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-dark w-100 mb-2 py-3 rounded-pill">Connexion</a>
                    <a href="{{ route('register') }}" class="btn btn-danger w-100 py-3 rounded-pill">S'inscrire</a>
                @endauth
            </div>
        </div>
    </div>
</header>

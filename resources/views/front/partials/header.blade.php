<!-- HIGH-END MINIMALIST HEADER COOPROM -->
<header class="cooprom-header-v2">
    <div class="header-main-wrapper">
        <div class="auto-container">
            <div class="d-flex align-items-center justify-content-between py-3">
                <div class="logo-area animate-left">
                    <a href="/"><img src="{{ asset('assets/front/images/logo.jpg') }}" alt="COOPROM" class="minimal-logo"></a>
                </div>
                <nav class="desktop-nav-area d-none d-lg-block animate-up">
                    <ul class="nav-menu-list d-flex align-items-center list-unstyled mb-0">
                        <li class="{{request()->routeIs('home') ? 'active' : ''}}"><a href="/">Accueil</a></li>
                        <li class="{{request()->routeIs('events.*') ? 'active' : ''}}"><a href="{{ route('events.index') }}">Agenda</a></li>
                        <li class="has-drop">
                            <a href="#">Coopérative <i class="fas fa-chevron-down ml-1" style="font-size: 8px;"></i></a>
                            <ul class="drop-menu shadow-2xl list-unstyled">
                                <li><a href="{{ route('cooprom.presentation') }}">Présentation</a></li>
                                <li><a href="{{ route('cooprom.missions') }}">Missions</a></li>
                                <li><a href="{{ route('cooprom.partenaires') }}">Partenaires</a></li>
                                <li><a href="{{ route('cooprom.gallery_photos') }}">Photos</a></li>
                                <li><a href="{{ route('cooprom.gallery_videos') }}">Vidéos</a></li>
                            </ul>
                        </li>
                        <li class="has-drop">
                            <a href="#">Expertises <i class="fas fa-chevron-down ml-1" style="font-size: 8px;"></i></a>
                            <ul class="drop-menu shadow-2xl list-unstyled">
                                <li><a href="{{ route('services.promotion') }}">Promotion</a></li>
                                <li><a href="{{ route('services.production') }}">Production</a></li>
                                <li><a href="{{ route('services.travels') }}">Voyages</a></li>
                                <li><a href="{{ route('services.events') }}">Événementiel</a></li>
                            </ul>
                        </li>
                        <li class="has-drop">
                            <a href="#">Assistance <i class="fas fa-chevron-down ml-1" style="font-size: 8px;"></i></a>
                            <ul class="drop-menu shadow-2xl list-unstyled">
                                <li><a href="{{ route('assistance.visa') }}">Visa</a></li>
                                <li><a href="{{ route('assistance.legal') }}">Juridique</a></li>
                                <li><a href="{{ route('assistance.social') }}">Social</a></li>
                            </ul>
                        </li>
                        <li class="{{ request()->routeIs('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav>
                <div class="action-area d-flex align-items-center animate-right">
                    @auth
                        <div class="notif-box-mini mr-4">
                            <a href="{{ route('member.notifications.index') }}" class="position-relative text-dark" style="opacity: 0.6;">
                                <i class="fas fa-bell"></i>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="red-dot"></span>
                                @endif
                            </a>
                        </div>
                        <div class="user-profile-dropdown dropdown">
                            <a href="#" class="dropdown-toggle no-caret" data-toggle="dropdown">
                                <img src="{{ auth()->user()->photo }}" alt="User" class="avatar-minimal">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow-2xl border-0 mt-3 rounded-xl overflow-hidden p-0">
                                <div class="px-4 py-3 bg-light border-bottom">
                                    <span class="d-block font-weight-bold small text-dark text-truncate" style="max-width: 150px;">{{ auth()->user()->name }}</span>
                                    <span class="d-block text-muted" style="font-size: 9px;">{{ auth()->user()->email }}</span>
                                </div>
                                <div class="py-2">
                                    <a class="dropdown-item py-2 px-4 small {{ request()->routeIs('member.dashboard') ? 'text-danger font-weight-bold' : '' }}" href="{{ route('member.dashboard') }}">
                                        <i class="fas fa-th-large mr-2 opacity-50"></i> Dashboard
                                    </a>
                                    <a class="dropdown-item py-2 px-4 small {{ request()->routeIs('member.profile.edit') ? 'text-danger font-weight-bold' : '' }}" href="{{ route('member.profile.edit') }}">
                                        <i class="fas fa-user-circle mr-2 opacity-50"></i> Mon Profil
                                    </a>
                                    <a class="dropdown-item py-2 px-4 small {{ request()->routeIs('member.productions.*') ? 'text-danger font-weight-bold' : '' }}" href="{{ route('member.productions.index') }}">
                                        <i class="fas fa-compact-disc mr-2 opacity-50"></i> Mes Productions
                                    </a>
                                    <a class="dropdown-item py-2 px-4 small {{ request()->routeIs('member.contracts.*') ? 'text-danger font-weight-bold' : '' }}" href="{{ route('member.contracts.index') }}">
                                        <i class="fas fa-file-signature mr-2 opacity-50"></i> Mes Contrats
                                    </a>
                                    <a class="dropdown-item py-2 px-4 small {{ request()->routeIs('member.legal.*') ? 'text-danger font-weight-bold' : '' }}" href="{{ route('member.legal.index') }}">
                                        <i class="fas fa-gavel mr-2 opacity-50"></i> Conseil Juridique
                                    </a>
                                    <a class="dropdown-item py-2 px-4 small {{ request()->routeIs('member.travels.*') ? 'text-danger font-weight-bold' : '' }}" href="{{ route('member.travels.index') }}">
                                        <i class="fas fa-plane-departure mr-2 opacity-50"></i> Voyages & Visas
                                    </a>
                                    <a class="dropdown-item py-2 px-4 small {{ request()->routeIs('member.social.*') ? 'text-danger font-weight-bold' : '' }}" href="{{ route('member.social.index') }}">
                                        <i class="fas fa-hand-holding-heart mr-2 opacity-50"></i> Aide Sociale
                                    </a>
                                    <a class="dropdown-item py-2 px-4 small {{ request()->routeIs('member.appointments.*') ? 'text-danger font-weight-bold' : '' }}" href="{{ route('member.appointments.index') }}">
                                        <i class="fas fa-calendar-alt mr-2 opacity-50"></i> Mes Rendez-vous
                                    </a>
                                    <a class="dropdown-item py-2 px-4 small {{ request()->routeIs('member.notifications.*') ? 'text-danger font-weight-bold' : '' }}" href="{{ route('member.notifications.index') }}">
                                        <i class="fas fa-bell mr-2 opacity-50"></i> Notifications
                                        @if(auth()->user()->unreadNotifications->count() > 0)
                                            <span class="badge badge-danger badge-pill ml-2" style="font-size: 8px;">{{ auth()->user()->unreadNotifications->count() }}</span>
                                        @endif
                                    </a>
                                </div>
                                <div class="dropdown-divider m-0"></div>
                                <form action="{{ route('logout') }}" method="POST">@csrf
                                    <button type="submit" class="dropdown-item py-2 px-4 small text-danger border-0 bg-transparent w-100 text-left"><i class="fas fa-power-off mr-2"></i> Déconnexion</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="login-text-link d-none d-md-block mr-4">Connexion</a>
                        <a href="{{ route('register') }}" class="cta-button-minimal shadow-sm">Nous rejoindre</a>
                    @endauth
                    <div class="mobile-burger-btn d-lg-none ml-4 text-dark" style="cursor: pointer; font-size: 24px;">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cooprom-mobile-fullscreen">
        <div class="mobile-overlay-bg"></div>
        <div class="mobile-content-box bg-white">
            <div class="mobile-header p-4 d-flex justify-content-between align-items-center border-bottom">
                <img src="{{ asset('assets/front/images/logo.jpg') }}" height="35" style="border-radius: 5px;">
                <div class="close-mobile-overlay text-dark" style="cursor: pointer; width: 45px; height: 45px; border-radius: 50%; background: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 28px; transition: 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.15); border: 1px solid rgba(0,0,0,0.05); position: relative; z-index: 100001;">
                    <i class="fas fa-times text-danger"></i>
                </div>
            </div>
            <div class="mobile-links-area p-4 text-center">
                <ul class="list-unstyled mt-4">
                    <li class="mb-4 link-anim"><a href="/" class="h2 font-weight-light text-dark text-decoration-none">Accueil</a></li>
                    <li class="mb-4 link-anim"><a href="{{ route('events.index') }}" class="h2 font-weight-light text-dark text-decoration-none">Agenda</a></li>
                    <li class="mb-4 link-anim">
                        <a href="#" class="h2 font-weight-light text-dark text-decoration-none d-block mb-2" data-toggle="collapse" data-target="#mobile-coop-menu">Coopérative <i class="fas fa-chevron-down small"></i></a>
                        <div id="mobile-coop-menu" class="collapse">
                            <ul class="list-unstyled bg-light py-3 rounded">
                                <li class="mb-2"><a href="{{ route('cooprom.presentation') }}" class="text-dark">Présentation</a></li>
                                <li class="mb-2"><a href="{{ route('cooprom.missions') }}" class="text-dark">Missions</a></li>
                                <li class="mb-2"><a href="{{ route('cooprom.partenaires') }}" class="text-dark">Partenaires</a></li>
                                <li class="mb-2"><a href="{{ route('cooprom.gallery_photos') }}" class="text-dark">Photos</a></li>
                                <li class="mb-2"><a href="{{ route('cooprom.gallery_videos') }}" class="text-dark">Vidéos</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-4 link-anim">
                        <a href="#" class="h2 font-weight-light text-dark text-decoration-none d-block mb-2" data-toggle="collapse" data-target="#mobile-exp-menu">Expertises <i class="fas fa-chevron-down small"></i></a>
                        <div id="mobile-exp-menu" class="collapse">
                            <ul class="list-unstyled bg-light py-3 rounded">
                                <li class="mb-2"><a href="{{ route('services.promotion') }}" class="text-dark">Promotion</a></li>
                                <li class="mb-2"><a href="{{ route('services.production') }}" class="text-dark">Production</a></li>
                                <li class="mb-2"><a href="{{ route('services.travels') }}" class="text-dark">Voyages</a></li>
                                <li class="mb-2"><a href="{{ route('services.events') }}" class="text-dark">Événementiel</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-4 link-anim">
                        <a href="#" class="h2 font-weight-light text-dark text-decoration-none d-block mb-2" data-toggle="collapse" data-target="#mobile-ast-menu">Assistance <i class="fas fa-chevron-down small"></i></a>
                        <div id="mobile-ast-menu" class="collapse">
                            <ul class="list-unstyled bg-light py-3 rounded">
                                <li class="mb-2"><a href="{{ route('assistance.visa') }}" class="text-dark">Visa</a></li>
                                <li class="mb-2"><a href="{{ route('assistance.legal') }}" class="text-dark">Juridique</a></li>
                                <li class="mb-2"><a href="{{ route('assistance.social') }}" class="text-dark">Social</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-4 link-anim"><a href="{{ route('contact') }}" class="h2 font-weight-light text-dark text-decoration-none">Contact</a></li>
                </ul>
            </div>
            <div class="mobile-auth-footer p-4 border-top mt-auto text-center">
                @auth
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <img src="{{ auth()->user()->photo }}" class="rounded-circle mr-3" width="50" height="50" style="object-fit: cover; border: 2px solid #ff3c36;">
                        <div class="text-left">
                            <h6 class="font-weight-bold mb-0 text-dark">{{ auth()->user()->name }}</h6>
                            <small class="text-muted">Adhérent</small>
                        </div>
                    </div>
                    <a href="{{ route('member.dashboard') }}" class="btn btn-danger btn-lg w-100 rounded-pill mb-3">Mon Espace</a>
                    <div class="list-group list-group-flush mb-4 text-left">
                        <a href="{{ route('member.profile.edit') }}" class="list-group-item list-group-item-action border-0 py-2 d-flex align-items-center {{ request()->routeIs('member.profile.edit') ? 'text-danger font-weight-bold' : '' }}">
                            <i class="fas fa-user-circle mr-3 opacity-50"></i> Profil
                        </a>
                        <a href="{{ route('member.productions.index') }}" class="list-group-item list-group-item-action border-0 py-2 d-flex align-items-center {{ request()->routeIs('member.productions.*') ? 'text-danger font-weight-bold' : '' }}">
                            <i class="fas fa-compact-disc mr-3 opacity-50"></i> Productions
                        </a>
                        <a href="{{ route('member.contracts.index') }}" class="list-group-item list-group-item-action border-0 py-2 d-flex align-items-center {{ request()->routeIs('member.contracts.*') ? 'text-danger font-weight-bold' : '' }}">
                            <i class="fas fa-file-signature mr-3 opacity-50"></i> Contrats
                        </a>
                        <a href="{{ route('member.legal.index') }}" class="list-group-item list-group-item-action border-0 py-2 d-flex align-items-center {{ request()->routeIs('member.legal.*') ? 'text-danger font-weight-bold' : '' }}">
                            <i class="fas fa-gavel mr-3 opacity-50"></i> Juridique
                        </a>
                        <a href="{{ route('member.travels.index') }}" class="list-group-item list-group-item-action border-0 py-2 d-flex align-items-center {{ request()->routeIs('member.travels.*') ? 'text-danger font-weight-bold' : '' }}">
                            <i class="fas fa-plane-departure mr-3 opacity-50"></i> Voyages & Visas
                        </a>
                        <a href="{{ route('member.social.index') }}" class="list-group-item list-group-item-action border-0 py-2 d-flex align-items-center {{ request()->routeIs('member.social.*') ? 'text-danger font-weight-bold' : '' }}">
                            <i class="fas fa-hand-holding-heart mr-3 opacity-50"></i> Aide Sociale
                        </a>
                        <a href="{{ route('member.appointments.index') }}" class="list-group-item list-group-item-action border-0 py-2 d-flex align-items-center {{ request()->routeIs('member.appointments.*') ? 'text-danger font-weight-bold' : '' }}">
                            <i class="fas fa-calendar-alt mr-3 opacity-50"></i> Rendez-vous
                        </a>
                        <a href="{{ route('member.notifications.index') }}" class="list-group-item list-group-item-action border-0 py-2 d-flex align-items-center {{ request()->routeIs('member.notifications.*') ? 'text-danger font-weight-bold' : '' }}">
                            <i class="fas fa-bell mr-3 opacity-50"></i> Notifications
                        </a>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">@csrf
                        <button type="submit" class="btn btn-link text-muted small border-0 bg-transparent">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-dark btn-lg w-100 rounded-pill mb-3">Connexion</a>
                    <a href="{{ route('register') }}" class="btn btn-danger btn-lg w-100 rounded-pill">S'inscrire</a>
                @endauth
            </div>
        </div>
    </div>
    <style>
        .main-header, .header-top, .header-style-two, .sticky-header, .mobile-header, .mobile-sticky-header, .search-popup, .mobile-menu, .cooprom-creative-header, .creative-mobile-sidebar, .cooprom-mobile-overlay-fixed, .cooprom-minimal-header, .cooprom-mobile-menu-overlay { display: none !important; }
        body { padding-top: 85px; }
        @media (max-width: 991px) { body { padding-top: 75px; } }
        .member-slide-header { padding-top: 60px !important; padding-bottom: 60px !important; }
        .cooprom-header-v2 {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 99999;
            background: #ffffff !important;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            transition: 0.4s;
        }
        .cooprom-header-v2.is-scrolled {
            background: #ffffff !important;
            box-shadow: 0 5px 25px rgba(0,0,0,0.05);
            padding: 5px 0;
        }
        .minimal-logo { max-height: 45px; border-radius: 8px; transition: 0.3s; }
        .is-scrolled .minimal-logo { max-height: 35px; }
        .nav-menu-list li { margin: 0 15px; position: relative; }
        .nav-menu-list li a { font-size: 11px; font-weight: 700; color: #111 !important; text-transform: uppercase; letter-spacing: 1.5px; opacity: 0.6; transition: 0.3s; text-decoration: none !important; display: block; }
        .nav-menu-list li:hover > a, .nav-menu-list li.active > a { opacity: 1; color: #ff3c36 !important; }
        .has-drop { position: relative; }
        .has-drop:hover .drop-menu { opacity: 1; visibility: visible; transform: translateX(-50%) translateY(0); }
        .drop-menu { position: absolute; top: 100%; left: 50%; transform: translateX(-50%) translateY(15px); background: white; min-width: 220px; padding: 15px 0; border-radius: 12px; opacity: 0; visibility: hidden; transition: 0.3s; z-index: 100; list-style: none; box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
        .drop-menu li a { display: block; padding: 8px 25px; font-size: 13px !important; text-transform: none !important; color: #333 !important; opacity: 1 !important; letter-spacing: 0 !important; font-weight: 600 !important; }
        .drop-menu li a:hover { background: #fff5f5; color: #ff3c36 !important; padding-left: 30px; }
        .cta-button-minimal { font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.2px; padding: 10px 24px; background: #111; color: white !important; border-radius: 6px; text-decoration: none !important; transition: 0.3s; }
        .cta-button-minimal:hover { background: #ff3c36; transform: translateY(-2px); }
        .login-text-link { font-size: 11px; font-weight: 700; text-transform: uppercase; color: #111 !important; text-decoration: none !important; }
        .avatar-minimal { width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; box-shadow: 0 3px 10px rgba(0,0,0,0.1); }
        .red-dot { position: absolute; top: -2px; right: -2px; width: 7px; height: 7px; background: #ff3c36; border-radius: 50%; border: 1.5px solid #fff; }
        .cooprom-mobile-fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 100000;
            background: #ffffff !important;
            transform: translateY(-100%);
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            visibility: hidden;
            display: block !important;
        }
        .cooprom-mobile-fullscreen.is-open { transform: translateY(0); visibility: visible; }
        .mobile-header { position: sticky; top: 0; background: white; z-index: 100005; }
        .close-mobile-overlay:hover { background: #ff3c36 !important; transform: rotate(90deg); }
        .close-mobile-overlay:hover i { color: white !important; }
        .mobile-content-box { height: 100%; display: flex; flex-direction: column; overflow-y: auto; }
        .link-anim { opacity: 0; transform: translateY(20px); transition: 0.4s; }
        .is-open .link-anim { opacity: 1; transform: translateY(0); }
        .is-open .link-anim:nth-child(1) { transition-delay: 0.2s; }
        .is-open .link-anim:nth-child(2) { transition-delay: 0.3s; }
        .is-open .link-anim:nth-child(3) { transition-delay: 0.4s; }
        .is-open .link-anim:nth-child(4) { transition-delay: 0.5s; }
        .is-open .link-anim:nth-child(5) { transition-delay: 0.6s; }
        .is-open .link-anim:nth-child(6) { transition-delay: 0.7s; }
        body.mobile-menu-active { overflow: hidden; }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.addEventListener('scroll', function() {
                const h = document.querySelector('.cooprom-header-v2');
                if (h) {
                    if (window.scrollY > 30) h.classList.add('is-scrolled');
                    else h.classList.remove('is-scrolled');
                }
            });
            const ob = document.querySelector('.mobile-burger-btn');
            const cb = document.querySelector('.close-mobile-overlay');
            const mm = document.querySelector('.cooprom-mobile-fullscreen');
            if (ob && mm) {
                ob.onclick = (e) => {
                    e.preventDefault();
                    mm.classList.add('is-open');
                    document.body.classList.add('mobile-menu-active');
                };
            }
            if (cb && mm) {
                cb.onclick = (e) => {
                    e.preventDefault();
                    mm.classList.remove('is-open');
                    document.body.classList.remove('mobile-menu-active');
                };
            }
        });
    </script>
</header>

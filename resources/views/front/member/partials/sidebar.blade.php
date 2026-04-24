<div class="col-lg-3 col-md-12 d-none d-lg-block">
    <div class="inner-column bg-white shadow-sm p-0 rounded-lg overflow-hidden border">
        <div class="user-info text-center p-4 bg-light">
            <div class="image mb-3 position-relative d-inline-block">
                <img src="{{ auth()->user()->photo ? asset('storage/'.auth()->user()->photo) : asset('assets/admin/images/avatars/avatar-1.png') }}"
                     class="rounded-circle border border-white shadow-sm"
                     style="width: 100px; height: 100px; object-fit: cover;" alt="Avatar">
                <a href="{{ route('member.profile.edit') }}" class="btn btn-sm btn-light position-absolute rounded-circle shadow-sm" style="bottom: 0; right: 0; padding: 5px 8px;">
                    <i class="fa fa-camera text-muted"></i>
                </a>
            </div>
            <h5 class="mb-1 font-weight-bold">{{ auth()->user()->name }} {{ auth()->user()->last_name }}</h5>
            <span class="badge badge-pill badge-light text-muted border px-3 py-2">{{ auth()->user()->culturalSector->name ?? 'Artiste' }}</span>
        </div>

        <div class="p-3">
            <ul class="nav flex-column member-nav">
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('member.dashboard') ? 'active' : 'text-dark' }} d-flex align-items-center rounded px-3 py-2" href="{{ route('member.dashboard') }}">
                        <i class="fa fa-th-large mr-3"></i> Tableau de bord
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('member.profile.edit') ? 'active' : 'text-dark' }} d-flex align-items-center rounded px-3 py-2" href="{{ route('member.profile.edit') }}">
                        <i class="fa fa-user-circle mr-3"></i> Mon Profil
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('member.productions.*') ? 'active' : 'text-dark' }} d-flex align-items-center rounded px-3 py-2" href="{{ route('member.productions.index') }}">
                        <i class="fa fa-compact-disc mr-3"></i> Mes Productions
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('member.contracts.*') ? 'active' : 'text-dark' }} d-flex align-items-center rounded px-3 py-2" href="{{ route('member.contracts.index') }}">
                        <i class="fa fa-file-signature mr-3"></i> Mes Contrats
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('member.legal.*') ? 'active' : 'text-dark' }} d-flex align-items-center rounded px-3 py-2" href="{{ route('member.legal.index') }}">
                        <i class="fa fa-gavel mr-3"></i> Conseil Juridique
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('member.travels.*') ? 'active' : 'text-dark' }} d-flex align-items-center rounded px-3 py-2" href="{{ route('member.travels.index') }}">
                        <i class="fa fa-plane-departure mr-3"></i> Mes Voyages & Visas
                    </a>
                </li>
                @if(request()->routeIs('member.travels.*'))
                    <li class="nav-item mb-1 ml-3">
                        <a class="nav-link {{ request()->routeIs('member.travels.guides') || request()->routeIs('member.travels.guide_show') ? 'active' : 'text-dark' }} d-flex align-items-center rounded px-3 py-1 small" href="{{ route('member.travels.guides') }}">
                            <i class="fa fa-info-circle mr-2"></i> Guides Visa
                        </a>
                    </li>
                @endif
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('member.social.*') ? 'active' : 'text-dark' }} d-flex align-items-center rounded px-3 py-2" href="{{ route('member.social.index') }}">
                        <i class="fa fa-hand-holding-heart mr-3"></i> Aide Sociale
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('member.appointments.*') ? 'active' : 'text-dark' }} d-flex align-items-center rounded px-3 py-2" href="{{ route('member.appointments.index') }}">
                        <i class="fa fa-calendar-alt mr-3"></i> Mes Rendez-vous
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link {{ request()->routeIs('member.notifications.*') ? 'active' : 'text-dark' }} d-flex align-items-center rounded px-3 py-2" href="{{ route('member.notifications.index') }}">
                        <i class="fa fa-bell mr-3"></i> Notifications
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="badge badge-danger badge-pill ml-auto">{{ auth()->user()->unreadNotifications->count() }}</span>
                        @endif
                    </a>
                </li>

                <li class="nav-item mt-3 pt-3 border-top">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger nav-link d-flex align-items-center w-100 border-0 text-left px-3 py-2">
                            <i class="fa fa-power-off mr-3"></i> Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
    .rounded-lg { border-radius: 15px !important; }
    .member-nav .nav-link {
        transition: all 0.3s ease;
        font-weight: 500;
    }
    .member-nav .nav-link i {
        width: 20px;
        text-align: center;
        font-size: 1.1rem;
    }
    .member-nav .nav-link:hover {
        background-color: #fff5f4;
        color: #fa584d !important;
        transform: translateX(5px);
    }
    .member-nav .nav-link.active {
        background-color: #fa584d !important;
        color: #fff !important;
        box-shadow: 0 4px 15px rgba(250, 88, 77, 0.3);
    }
</style>

<!--start top header-->
<header class="top-header">
    <nav class="navbar navbar-expand">
        <div class="mobile-toggle-icon d-xl-none">
            <i class="bi bi-list"></i>
        </div>
        <div class="top-navbar d-none d-xl-block">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Tableau de bord</a>
                </li>
            </ul>
        </div>
        <div class="search-toggle-icon d-xl-none ms-auto">
            <i class="bi bi-search"></i>
        </div>
        <form class="searchbar d-none d-xl-flex ms-auto">
            <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i></div>
            <input class="form-control" type="text" placeholder="Rechercher...">
            <div class="position-absolute top-50 translate-middle-y d-block d-xl-none search-close-icon"><i class="bi bi-x-lg"></i></div>
        </form>
        <div class="top-navbar-right ms-3">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item dropdown dropdown-large">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                        <div class="notifications">
                            @php $count = auth()->user()->unreadNotifications->count(); @endphp
                            <span class="notify-badge" id="notification-count" {!! $count == 0 ? 'style="display: none;"' : '' !!}>{{ $count }}</span>
                            <i class="bi bi-bell-fill"></i>
                        </div>
                    </a>
                    <style>
                        .notify-badge {
                            position: absolute;
                            top: 5px;
                            right: 5px;
                            font-size: 10px;
                            background: #f41127;
                            color: #fff;
                            width: 18px;
                            height: 18px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border-radius: 50%;
                        }
                        .header-notifications-list {
                            max-height: 300px;
                            overflow-y: auto;
                        }
                        .notification-box {
                            width: 38px;
                            height: 38px;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 18px;
                        }
                    </style>
                    <div class="dropdown-menu dropdown-menu-end p-0">
                        <div class="p-2 border-bottom m-2">
                            <h5 class="h5 mb-0">Notifications</h5>
                        </div>
                        <div class="header-notifications-list p-2" id="notification-list">
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <a class="dropdown-item" href="{{ route('admin.notifications.read', $notification->id) }}">
                                    <div class="d-flex align-items-center">
                                        <div class="notification-box bg-light-primary text-primary"><i class="bi {{ $notification->data['icon'] ?? 'bi-info-circle-fill' }}"></i></div>
                                        <div class="ms-3 flex-grow-1" style="min-width: 0;">
                                            <h6 class="mb-0 dropdown-msg-user text-truncate">{{ $notification->data['title'] ?? 'Nouvelle notification' }}</h6>
                                            <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center text-truncate">{{ $notification->data['message'] ?? '' }}</small>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center p-3 text-muted">Aucune nouvelle notification</div>
                            @endforelse
                        </div>
                        <div class="p-2 border-top m-2">
                            <a class="dropdown-item text-center" href="{{ route('admin.notifications.index') }}">Voir toutes les notifications</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown dropdown-large">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                        <div class="user-setting d-flex align-items-center gap-1">
                            <img src="{{ asset('assets/admin/images/user_default.jpg') }}" class="user-img" alt="">
                            <div class="user-name d-none d-sm-block">Admin COOPROM</div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/admin/images/user_default.jpg') }}" alt="" class="rounded-circle" width="60" height="60">
                                    <div class="ms-3">
                                        <h6 class="mb-0 dropdown-user-name">Admin COOPROM</h6>
                                        <small class="mb-0 dropdown-user-designation text-secondary">admin@cooprom.ci</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex align-items-center">
                                    <div class="setting-icon"><i class="bi bi-person-fill"></i></div>
                                    <div class="setting-text ms-3"><span>Profil</span></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex align-items-center">
                                    <div class="setting-icon"><i class="bi bi-gear-fill"></i></div>
                                    <div class="setting-text ms-3"><span>Paramètres</span></div>
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <div class="d-flex align-items-center">
                                    <div class="setting-icon"><i class="bi bi-lock-fill"></i></div>
                                    <div class="setting-text ms-3"><span>Déconnexion</span></div>
                                </div>
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!--end top header-->

@extends('front.layouts.app')

@section('title', 'Mes Notifications - COOPROM')

@section('content')
<section class="page-title" style="background-image: url({{ asset('assets/front/images/background/11.jpg') }});">
    <div class="auto-container">
        <h1>Mes Notifications</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
            <li>Notifications</li>
        </ul>
    </div>
</section>

<section class="dashboard-section pt-5 pb-5">
    <div class="auto-container">
        <div class="row">
            @include('front.member.partials.sidebar')

            <div class="col-lg-9 col-md-12 col-12">
                <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                    <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 font-weight-bold">Toutes mes notifications</h4>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <form action="{{ route('member.notifications.mark-all-read') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <i class="fa fa-check-double mr-1"></i> Tout marquer comme lu
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="card-body p-0">
                        @if(session('success'))
                            <div class="px-4 pt-2">
                                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif

                        <div class="list-group list-group-flush">
                            @forelse($notifications as $notification)
                                <div class="list-group-item list-group-item-action p-4 border-bottom {{ $notification->unread() ? 'bg-light-info' : '' }}">
                                    <div class="d-flex w-100 justify-content-between align-items-start">
                                        <div class="d-flex align-items-start">
                                            <div class="notification-icon mr-3 rounded-circle d-flex align-items-center justify-content-center {{ $notification->unread() ? 'bg-info text-white' : 'bg-light text-muted' }}" style="width: 45px; height: 45px; flex-shrink: 0;">
                                                <i class="fa {{ $notification->data['icon'] ?? 'fa-bell' }}"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1 font-weight-bold {{ $notification->unread() ? 'text-dark' : 'text-muted' }}">
                                                    {{ $notification->data['title'] ?? 'Notification' }}
                                                </h6>
                                                <p class="mb-1 text-muted small">{{ $notification->data['message'] ?? '' }}</p>
                                                <small class="text-muted">
                                                    <i class="far fa-clock mr-1"></i> {{ $notification->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            @if($notification->unread())
                                                <form action="{{ route('member.notifications.read', $notification->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-info rounded-pill px-3 shadow-sm">
                                                        Voir / Lire
                                                    </button>
                                                </form>
                                            @elseif(isset($notification->data['url']))
                                                <a href="{{ $notification->data['url'] }}" class="btn btn-sm btn-light rounded-pill px-3 border">
                                                    Aller à
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fa fa-bell-slash fa-4x text-light mb-3"></i>
                                        <h5 class="text-muted">Aucune notification</h5>
                                        <p class="small text-muted">Vous serez informé ici des mises à jour de vos demandes.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <div class="p-4 d-flex justify-content-center">
                            {{ $notifications->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('extra_css')
<style>
    .rounded-lg { border-radius: 15px !important; }
    .bg-light-info { background-color: #f0faff !important; }
    .btn_orange { background-color: #fa584d; border: none; }
    .btn_orange:hover { background-color: #e64b42; color: #fff; }
    .font-weight-bold { font-weight: 700 !important; }
    .list-group-item { transition: all 0.2s ease; border-left: 3px solid transparent; }
    .list-group-item.bg-light-info { border-left-color: #17a2b8; }
</style>
@endsection

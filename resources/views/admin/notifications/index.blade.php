@extends('admin.layouts.app')

@section('title', 'Toutes les Notifications - COOPROM Admin')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Notifications</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Toutes les notifications</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm">Tout marquer comme lu</button>
            </form>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Titre</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notifications as $notification)
                            <tr class="{{ $notification->read_at ? '' : 'table-light fw-bold' }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="notification-box bg-light-primary text-primary me-2" style="flex-shrink: 0; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-bell-fill"></i>
                                        </div>
                                        <span class="text-truncate" style="max-width: 250px;">{{ $notification->data['title'] ?? 'Notification' }}</span>
                                    </div>
                                </td>
                                <td style="max-width: 400px;">
                                    <div class="text-wrap text-break">
                                        {{ $notification->data['message'] ?? '' }}
                                    </div>
                                </td>
                                <td>{{ $notification->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if($notification->read_at)
                                        <span class="badge bg-light-success text-success">Lu</span>
                                    @else
                                        <span class="badge bg-light-danger text-danger">Non lu</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.notifications.read', $notification->id) }}" class="btn btn-sm btn-outline-primary">
                                        Consulter
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Aucune notification trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
@endsection

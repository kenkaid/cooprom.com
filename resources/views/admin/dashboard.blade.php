@extends('admin.layouts.app')

@section('title', 'Tableau de Bord - COOPROM Admin')

@section('content')
    <!-- Header Hero Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card radius-10 bg-gradient-cosmic text-white shadow-lg overflow-hidden border-0">
                <div class="card-body p-4 position-relative">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <h2 class="fw-bold mb-1">Bienvenue, {{ auth()->user()->name }} ! 👋</h2>
                            @php
                                $periodLabels = [
                                    'all' => 'Global',
                                    'today' => "d'aujourd'hui",
                                    'week' => 'de la semaine',
                                    'month' => 'du mois',
                                    'year' => "de l'année",
                                ];
                                $currentLabel = $periodLabels[$stats['period']] ?? 'Global';
                            @endphp
                            <p class="mb-0 opacity-75">
                                @if($stats['start_date'] && $stats['end_date'])
                                    Aperçu du <span class="fw-bold">{{ \Carbon\Carbon::parse($stats['start_date'])->format('d/m/Y') }}</span> au <span class="fw-bold">{{ \Carbon\Carbon::parse($stats['end_date'])->format('d/m/Y') }}</span>
                                @else
                                    Aperçu <span class="fw-bold">{{ $currentLabel }}</span>
                                @endif
                                de l'activité COOPROM.
                            </p>
                        </div>
                        <div class="col-lg-5 text-lg-end mt-3 mt-lg-0">
                            <form action="{{ route('admin.dashboard') }}" method="GET" class="d-flex flex-wrap justify-content-lg-end gap-2">
                                <div class="input-group input-group-sm w-auto shadow-sm radius-30 overflow-hidden">
                                    <span class="input-group-text bg-white border-0 text-muted small">Du</span>
                                    <input type="date" name="start_date" value="{{ $stats['start_date'] }}" class="form-control border-0 px-2" style="width: 130px;">
                                    <span class="input-group-text bg-white border-0 text-muted small">Au</span>
                                    <input type="date" name="end_date" value="{{ $stats['end_date'] }}" class="form-control border-0 px-2" style="width: 130px;">
                                    <button type="submit" class="btn btn-white border-0 text-primary"><i class="bi bi-search"></i></button>
                                </div>

                                <select name="period" class="form-select form-select-sm radius-30 w-auto bg-white border-0 shadow-sm px-3" onchange="this.form.submit()">
                                    <option value="all" {{ $stats['period'] == 'all' && !($stats['start_date'] && $stats['end_date']) ? 'selected' : '' }}>Toute la période</option>
                                    <option value="today" {{ $stats['period'] == 'today' ? 'selected' : '' }}>Aujourd'hui</option>
                                    <option value="week" {{ $stats['period'] == 'week' ? 'selected' : '' }}>Cette semaine</option>
                                    <option value="month" {{ $stats['period'] == 'month' ? 'selected' : '' }}>Ce mois</option>
                                    <option value="year" {{ $stats['period'] == 'year' ? 'selected' : '' }}>Cette année</option>
                                </select>
                                @if($stats['start_date'] || $stats['period'] != 'all')
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-light radius-30 shadow-sm"><i class="bi bi-x-circle"></i></a>
                                @endif
                            </form>
                        </div>
                    </div>
                    <!-- Decorative shapes -->
                    <div class="position-absolute top-0 end-0 p-3 opacity-25">
                        <i class="bi bi-cpu-fill display-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Widgets -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4 mb-4">
        <div class="col">
            <div class="card radius-10 border-0 border-start border-primary border-4 shadow-sm hover-scale transition-all">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-1 text-secondary text-uppercase small fw-bold">Membres Actifs</p>
                            <h3 class="mb-0 fw-bold">{{ $stats['users'] }}</h3>
                        </div>
                        <div class="widgets-icons bg-light-primary text-primary rounded-circle shadow-sm">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.users.index') }}" class="text-primary small text-decoration-none">Gérer les membres <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-danger border-4 shadow-sm hover-scale transition-all">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-1 text-secondary text-uppercase small fw-bold">Productions</p>
                            <h3 class="mb-0 fw-bold">{{ $stats['productions'] }}</h3>
                        </div>
                        <div class="widgets-icons bg-light-danger text-danger rounded-circle shadow-sm">
                            <i class="bi bi-mic-fill"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.productions.index') }}" class="text-danger small text-decoration-none">Suivre les projets <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-success border-4 shadow-sm hover-scale transition-all">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-1 text-secondary text-uppercase small fw-bold">Événements</p>
                            <h3 class="mb-0 fw-bold">{{ $stats['events'] }}</h3>
                        </div>
                        <div class="widgets-icons bg-light-success text-success rounded-circle shadow-sm">
                            <i class="bi bi-calendar-event-fill"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.events.index') }}" class="text-success small text-decoration-none">Agenda culturel <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-0 border-start border-warning border-4 shadow-sm hover-scale transition-all">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="mb-1 text-secondary text-uppercase small fw-bold">Visas en attente</p>
                            <h3 class="mb-0 fw-bold">{{ $stats['pending_visas'] }}</h3>
                        </div>
                        <div class="widgets-icons bg-light-warning text-warning rounded-circle shadow-sm">
                            <i class="bi bi-globe"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.visa_applications.index') }}" class="text-warning small text-decoration-none">Traiter les demandes <i class="bi bi-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Productions -->
        <div class="col-12 col-xl-8">
            <div class="card radius-10 shadow-sm border-0 mb-4">
                <div class="card-header bg-transparent border-0 py-3">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold text-dark">Dernières Productions</h5>
                        </div>
                        <div class="ms-auto">
                            <a href="{{ route('admin.productions.index') }}" class="btn btn-outline-primary btn-sm radius-30">Voir tout</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Artiste</th>
                                    <th>Titre</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stats['recent_productions'] as $production)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ $production->user->photo }}" class="rounded-circle shadow-sm" width="35" height="35" alt="">
                                                <h6 class="mb-0 small fw-bold">{{ $production->user->name }}</h6>
                                            </div>
                                        </td>
                                        <td>{{ Str::limit($production->title, 30) }}</td>
                                        <td>
                                            @php
                                                $statusClass = [
                                                    'pending' => 'bg-light-warning text-warning',
                                                    'approved' => 'bg-light-success text-success',
                                                    'rejected' => 'bg-light-danger text-danger',
                                                ][$production->status] ?? 'bg-light-secondary text-secondary';
                                            @endphp
                                            <span class="badge {{ $statusClass }} radius-30 px-3">{{ ucfirst($production->status) }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.productions.show', $production->uuid) }}" class="btn btn-sm btn-light radius-30"><i class="bi bi-eye-fill"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-3">Aucune production récente</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card radius-10 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 py-3">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold text-dark">Derniers Contrats</h5>
                        </div>
                        <div class="ms-auto">
                            <a href="{{ route('admin.contracts.index') }}" class="btn btn-outline-primary btn-sm radius-30">Voir tout</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Membre</th>
                                    <th>Contrat</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stats['recent_contracts'] as $contract)
                                    <tr>
                                        <td>{{ $contract->user->name }}</td>
                                        <td>{{ Str::limit($contract->title, 25) }}</td>
                                        <td>
                                            @php
                                                $cStatusClass = [
                                                    'draft' => 'bg-light-secondary text-secondary',
                                                    'sent' => 'bg-light-info text-info',
                                                    'signed' => 'bg-light-success text-success',
                                                    'expired' => 'bg-light-danger text-danger',
                                                ][$contract->status] ?? 'bg-light-secondary text-secondary';
                                            @endphp
                                            <span class="badge {{ $cStatusClass }} radius-30 px-3">{{ ucfirst($contract->status) }}</span>
                                        </td>
                                        <td class="small">{{ $contract->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-3">Aucun contrat récent</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Members -->
        <div class="col-12 col-xl-4">
            <div class="card radius-10 shadow-sm border-0">
                <div class="card-header bg-transparent border-0 py-3 text-center">
                    <h5 class="mb-0 fw-bold text-dark">Nouveaux Membres</h5>
                    <p class="mb-0 small text-muted">Membres récemment inscrits</p>
                </div>
                <div class="card-body">
                    <div class="recent-members-list">
                        @forelse($stats['recent_users'] as $user)
                            <div class="d-flex align-items-center gap-3 p-3 border-bottom-dashed">
                                <img src="{{ $user->photo }}" class="rounded-circle shadow-sm" width="50" height="50" alt="">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-bold">{{ $user->name }} {{ $user->last_name }}</h6>
                                    <p class="mb-0 small text-muted">{{ $user->culturalSector->name ?? 'Secteur non défini' }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('admin.users.show', $user->uuid) }}" class="btn btn-sm btn-outline-secondary rounded-circle"><i class="bi bi-chevron-right"></i></a>
                                </div>
                            </div>
                        @empty
                            <p class="text-center py-3">Aucun membre récent</p>
                        @endforelse
                    </div>
                    <div class="mt-4 text-center">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm radius-30 w-100">Gérer tous les membres</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .bg-gradient-cosmic {
        background: linear-gradient(135deg, #FF3C36 0%, #6a11cb 100%);
    }
    .hover-scale:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .transition-all {
        transition: all 0.3s ease-in-out;
    }
    .widgets-icons {
        width: 55px;
        height: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        border-radius: 12px !important;
    }
    .bg-light-primary { background-color: rgba(13, 110, 253, 0.08); }
    .bg-light-danger { background-color: rgba(255, 60, 54, 0.08); }
    .bg-light-success { background-color: rgba(25, 135, 84, 0.08); }
    .bg-light-warning { background-color: rgba(255, 193, 7, 0.08); }
    .bg-light-info { background-color: rgba(13, 202, 240, 0.08); }

    .border-bottom-dashed {
        border-bottom: 1px dashed #e9ecef;
    }
    .border-bottom-dashed:last-child {
        border-bottom: none;
    }
    .card {
        border-radius: 15px;
    }
    .radius-30 {
        border-radius: 30px;
    }
    .btn-white {
        background-color: white;
        border-color: white;
    }
    .btn-white:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('extra_js')
    <script src="{{asset('assets/admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
@endsection

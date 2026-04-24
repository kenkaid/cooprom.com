@extends('front.layouts.app')

@section('title', 'Mes Productions - COOPROM')

@section('content')
<section class="page-title" style="background-image: url({{ asset('assets/front/images/resource/members/production.jpeg') }});">
    <div class="auto-container">
        <h1>Mes Productions</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li><a href="{{ route('member.dashboard') }}">Dashboard</a></li>
            <li>Productions</li>
        </ul>
    </div>
</section>

<section class="dashboard-section pt-5 pb-5">
    <div class="auto-container">
        <div class="row">
            @include('front.member.partials.sidebar')

            <div class="col-lg-9 col-md-12">
                <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                    <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 font-weight-bold">Mes Projets de Production</h4>
                        <a href="{{ route('member.productions.create') }}" class="btn btn-sm btn_orange text-white rounded-pill px-4 py-2 font-weight-bold shadow-sm">
                            <i class="fa fa-plus-circle mr-1"></i> Nouveau Projet
                        </a>
                    </div>
                    <div class="card-body p-0">
                        @if(session('success'))
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Succès !',
                                    text: "{{ session('success') }}",
                                    confirmButtonColor: '#fa584d',
                                    borderRadius: '15px'
                                });
                            </script>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 px-4 py-3">Titre du projet</th>
                                        <th class="border-0 py-3">Type</th>
                                        <th class="border-0 py-3 text-center">Statut</th>
                                        <th class="border-0 py-3 text-center">Actions</th>
                                        <th class="border-0 px-4 py-3 text-right">Date de soumission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($productions as $production)
                                        <tr>
                                            <td class="px-4 align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-3 bg-light p-2 rounded text_orange">
                                                        <i class="fa fa-film"></i>
                                                    </div>
                                                    <span class="font-weight-bold">{{ $production->title }}</span>
                                                </div>
                                            </td>
                                            <td class="align-middle">{{ $production->type }}</td>
                                            <td class="align-middle text-center">
                                                @php
                                                    $statusClass = [
                                                        'pending' => 'badge-warning text-white',
                                                        'rejected' => 'badge-danger',
                                                        'in_progress' => 'badge-info',
                                                        'completed' => 'badge-success',
                                                        'cancelled' => 'badge-secondary'
                                                    ][$production->status] ?? 'badge-secondary';

                                                    $statusLabel = [
                                                        'pending' => 'En attente',
                                                        'rejected' => 'Rejeté',
                                                        'in_progress' => 'En cours',
                                                        'completed' => 'Terminé',
                                                        'cancelled' => 'Annulé'
                                                    ][$production->status] ?? $production->status;
                                                @endphp
                                                <span class="badge {{ $statusClass }} px-3 py-2 rounded-pill">
                                                    {{ $statusLabel }}
                                                </span>
                                                @if($production->admin_note)
                                                    <div class="mt-1">
                                                        <small class="text-danger font-weight-bold" style="cursor: help;" title="Une note a été ajoutée">
                                                            <i class="fa fa-comment-dots"></i> Feedback
                                                        </small>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-light rounded-circle mx-1" data-toggle="modal" data-target="#descModal{{ $production->id }}" title="Voir description">
                                                        <i class="fa fa-eye text-muted"></i>
                                                    </button>

                                                    @if($production->attachment)
                                                        <a href="{{ asset('storage/' . $production->attachment) }}" target="_blank" class="btn btn-sm btn-light rounded-circle mx-1 text_orange" title="Télécharger le document">
                                                            <i class="fa fa-file-download"></i>
                                                        </a>
                                                    @endif

                                                    @if($production->status === 'pending' || $production->status === 'rejected')
                                                        <a href="{{ route('member.productions.edit', $production->uuid) }}" class="btn btn-sm btn-light rounded-circle mx-1 text-info" title="Modifier">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        @include('front.member.productions.delete')
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-4 align-middle text-right text-muted small">
                                                {{ $production->created_at->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                        <td colspan="6" class="text-center py-5">
                                                <div class="py-4">
                                                    <i class="fa fa-compact-disc fa-4x text-light mb-3"></i>
                                                    <h5 class="text-muted">Aucun projet trouvé</h5>
                                                    <p class="small text-muted">Commencez par soumettre votre premier projet de production.</p>
                                                    <a href="{{ route('member.productions.create') }}" class="btn btn-sm btn-outline-orange rounded-pill mt-3 px-4">
                                                        Soumettre un projet
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modals -->
@foreach($productions as $production)
    <div class="modal fade" id="descModal{{ $production->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                <div class="modal-header border-0 p-4">
                    <h5 class="modal-title font-weight-bold">{{ $production->title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4 text-left">
                    <h6 class="text-muted small text-uppercase font-weight-bold mb-3">Description du projet</h6>
                    <div class="description-content mb-4">
                        {!! $production->description ?: '<i class="text-muted">Aucune description fournie.</i>' !!}
                    </div>

                    @if($production->admin_note)
                        <hr>
                        <h6 class="text_orange small text-uppercase font-weight-bold mb-2">Note de la COOPROM</h6>
                        <div class="p-3 rounded bg-light border-left border-warning" style="border-left-width: 4px !important;">
                            <p class="mb-0 small italic">{{ $production->admin_note }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection

@section('extra_css')
<style>
    .rounded-lg { border-radius: 15px !important; }
    .btn_orange { background-color: #fa584d; border: none; }
    .btn_orange:hover { background-color: #e64b42; color: #fff; }
    .text_orange { color: #fa584d !important; }
    .font-weight-bold { font-weight: 700 !important; }
    .btn-outline-orange {
        color: #fa584d;
        border-color: #fa584d;
    }
    .btn-outline-orange:hover {
        background-color: #fa584d;
        color: #fff;
    }
    .description-content ul, .description-content ol {
        padding-left: 20px;
        margin-bottom: 1rem;
    }
    .description-content p {
        margin-bottom: 0.5rem;
    }
    /* Fix for modal backdrop issue */
    body.modal-open {
        overflow: hidden;
    }
    .modal-backdrop {
        display: none !important;
    }
    .modal {
        background: rgba(0, 0, 0, 0.5);
    }
</style>
@endsection

@section('extra_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.delete-btn').on('click', function(e) {
            var form = $(this).closest('.delete-form');

            Swal.fire({
                title: 'Supprimer ce projet ?',
                text: "Cette action est irréversible et supprimera également les fichiers joints.",
                icon: 'warning',
                iconColor: '#fa584d',
                showCancelButton: true,
                confirmButtonColor: '#fa584d',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                background: '#fff',
                color: '#2c3e50',
                borderRadius: '15px',
                customClass: {
                    confirmButton: 'rounded-pill px-4',
                    cancelButton: 'rounded-pill px-4'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection

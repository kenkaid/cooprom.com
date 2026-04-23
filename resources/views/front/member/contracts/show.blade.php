@extends('front.layouts.app')

@section('title', 'Détails du Contrat - COOPROM')

@section('content')
<!-- Page Title -->
<section class="page-title" style="background-image: url({{ asset('assets/front/images/background/11.jpg') }});">
    <div class="auto-container">
        <h1>Détails du Contrat</h1>
        <ul class="page-breadcrumb">
            <li><a href="/">Accueil</a></li>
            <li><a href="{{ route('member.dashboard') }}">Tableau de bord</a></li>
            <li><a href="{{ route('member.contracts.index') }}">Contrats</a></li>
            <li>Détails</li>
        </ul>
    </div>
</section>

<!-- Dashboard Section -->
<section class="dashboard-section pt-5 pb-5">
    <div class="auto-container">
        <div class="row">
            @include('front.member.partials.sidebar')

            <!-- Contenu Principal -->
            <div class="col-lg-9 col-md-12">
                <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                    <div class="card-header bg-white p-4 border-0 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 font-weight-bold">Contrat #{{ substr($contract->uuid, 0, 8) }}</h4>
                        <a href="{{ route('member.contracts.index') }}" class="btn btn-sm btn-light rounded-pill px-3">
                            <i class="fa fa-arrow-left mr-1"></i> Retour
                        </a>
                    </div>
                    <div class="card-body p-4 border-top">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="text-muted small text-uppercase font-weight-bold mb-1 d-block">Type de contrat</label>
                                <div class="h5 font-weight-bold">{{ $contract->type }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="text-muted small text-uppercase font-weight-bold mb-1 d-block">Statut actuel</label>
                                @if($contract->status == 'signed')
                                    <span class="badge badge-success px-3 py-2 rounded-pill">Signé</span>
                                @elseif($contract->status == 'draft')
                                    <span class="badge badge-warning px-3 py-2 text-white rounded-pill">Brouillon / En attente</span>
                                @elseif($contract->status == 'expired')
                                    <span class="badge badge-danger px-3 py-2 rounded-pill">Expiré</span>
                                @elseif($contract->status == 'cancelled')
                                    <span class="badge badge-dark px-3 py-2 rounded-pill">Annulé</span>
                                @else
                                    <span class="badge badge-secondary px-3 py-2 rounded-pill">{{ ucfirst($contract->status) }}</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="text-muted small text-uppercase font-weight-bold mb-1 d-block">Date de réception</label>
                                <div>{{ $contract->created_at ? $contract->created_at->format('d/m/Y') : '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="text-muted small text-uppercase font-weight-bold mb-1 d-block">Date de signature</label>
                                <div>{{ ($contract->status == 'signed' && $contract->start_date) ? \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') : 'Non encore signé' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="text-muted small text-uppercase font-weight-bold mb-1 d-block">Date de début</label>
                                <div>{{ $contract->start_date ? \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') : 'Non définie' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="text-muted small text-uppercase font-weight-bold mb-1 d-block">Date de fin</label>
                                <div>{{ $contract->end_date ? \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') : 'Non définie' }}</div>
                            </div>

                            <div class="col-12 mt-4">
                                <div class="p-4 bg-light rounded-lg text-center border">
                                    <i class="fa fa-file-pdf fa-3x text-danger mb-3"></i>
                                    <h5>Document du contrat</h5>
                                    <p class="text-muted small">Vous pouvez consulter ou télécharger le document officiel ci-dessous.</p>

                                    <div class="mt-4">
                                        @if($contract->file_path)
                                            <a href="{{ asset('storage/' . $contract->file_path) }}" target="_blank" class="btn btn_orange text-white rounded-pill px-4 py-2 shadow-sm font-weight-bold">
                                                <i class="fa fa-download mr-2"></i> Télécharger le PDF
                                            </a>
                                        @else
                                            <div class="alert alert-info d-inline-block px-4 py-2 border-0 shadow-sm rounded-pill">
                                                <i class="fa fa-info-circle mr-2"></i> Le document est en cours de préparation par le service juridique.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($contract->status == 'draft' && $contract->file_path)
                                <div class="col-12 mt-5 p-4 border rounded-lg bg-orange-light">
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            <h5 class="font-weight-bold text_orange">Action requise : Signature</h5>
                                            <p class="mb-md-0 small text-dark">Veuillez prendre connaissance du contrat. Vous pouvez le signer électroniquement ou uploader une copie signée manuellement.</p>
                                        </div>
                                        <div class="col-md-5 text-md-right mt-3 mt-md-0">
                                            <button type="button" class="btn btn-outline-orange rounded-pill px-4 py-2 font-weight-bold shadow-sm mr-2" data-toggle="modal" data-target="#uploadSignedModal">
                                                <i class="fa fa-upload mr-1"></i> Uploader signé
                                            </button>
                                            <button type="button" class="btn btn_orange text-white rounded-pill px-4 py-2 font-weight-bold shadow-sm btn-sign-trigger">
                                                <i class="fa fa-pen-nib mr-1"></i> Signer ici
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal de Signature -->
<div class="modal fade" id="signContractModal" tabindex="-1" role="dialog" aria-labelledby="signContractModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg rounded-lg">
            <div class="modal-header bg-orange-light border-0 py-3">
                <h5 class="modal-title font-weight-bold text_orange" id="signContractModalLabel">Confirmer la signature électronique</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('member.contracts.sign', $contract->uuid) }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <div class="icon-box mb-3">
                            <i class="fa fa-file-signature fa-3x text_orange"></i>
                        </div>
                        <p class="text-muted">Pour des raisons de sécurité, veuillez saisir votre mot de passe pour valider la signature de ce contrat.</p>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger small py-2">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="password" class="font-weight-bold small text-uppercase">Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control rounded-pill border-light shadow-sm" placeholder="Saisissez votre mot de passe" required>
                    </div>

                    <div class="custom-control custom-checkbox small mt-3">
                        <input type="checkbox" class="custom-control-input" id="confirmCheck" required>
                        <label class="custom-control-label text-muted" for="confirmCheck">Je certifie avoir lu et accepté les termes de ce contrat.</label>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn_orange text-white rounded-pill px-4 font-weight-bold shadow-sm">
                        Valider la signature
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal d'Upload du Contrat Signé -->
<div class="modal fade" id="uploadSignedModal" tabindex="-1" role="dialog" aria-labelledby="uploadSignedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg rounded-lg">
            <div class="modal-header bg-orange-light border-0 py-3">
                <h5 class="modal-title font-weight-bold text_orange" id="uploadSignedModalLabel">Uploader le contrat signé</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('member.contracts.upload_signed', $contract->uuid) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <div class="icon-box mb-3">
                            <i class="fa fa-upload fa-3x text_orange"></i>
                        </div>
                        <p class="text-muted">Veuillez uploader le fichier PDF du contrat que vous avez signé manuellement.</p>
                    </div>

                    <div class="form-group">
                        <label for="signed_file" class="font-weight-bold small text-uppercase">Fichier du contrat signé (PDF)</label>
                        <div class="custom-file">
                            <input type="file" name="signed_file" class="custom-file-input" id="signed_file" accept=".pdf" required>
                            <label class="custom-file-label" for="signed_file">Choisir le fichier...</label>
                        </div>
                        <small class="form-text text-muted">Format PDF uniquement. Max 12 Mo.</small>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn_orange text-white rounded-pill px-4 font-weight-bold shadow-sm">
                        Envoyer le contrat
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('extra_css')
<style>
    .rounded-lg { border-radius: 15px !important; }
    .btn_orange { background-color: #fa584d; border: none; }
    .btn_orange:hover { background-color: #e64b42; color: #fff; }
    .btn-outline-orange { border: 2px solid #fa584d; color: #fa584d; background: transparent; }
    .btn-outline-orange:hover { background-color: #fa584d; color: #fff; }
    .text_orange { color: #fa584d !important; }
    .bg-orange-light { background-color: #fff5f4; }
    .font-weight-bold { font-weight: 700 !important; }
    .badge-success { background-color: #28a745; }
    .badge-warning { background-color: #ffc107; }
    .badge-danger { background-color: #dc3545; }
    .badge-dark { background-color: #343a40; }
    .modal-content.rounded-lg { border-radius: 20px !important; }
    .form-control:focus {
        border-color: #fa584d;
        box-shadow: 0 0 0 0.2rem rgba(250, 88, 77, 0.25);
    }
    /* Fix pour l'accessibilité de la modal */
    body.modal-open {
        overflow: hidden;
    }
    .modal-backdrop {
        display: none !important;
    }
    .modal {
        background: rgba(0, 0, 0, 0.5);
        z-index: 1050 !important;
    }
</style>
@endsection

@section('extra_js')
<script>
    $(document).ready(function() {
        // Déclencheur manuel pour la modal au cas où data-toggle échouerait
        $('.btn-sign-trigger').on('click', function(e) {
            e.preventDefault();
            $('#signContractModal').modal('show');
        });

        @if(session('error'))
            $('#signContractModal').modal('show');
        @endif

        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endsection

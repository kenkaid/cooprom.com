@extends('admin.layouts.app')

@section('title', 'Nouveau Contrat - COOPROM Admin')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
        <div class="breadcrumb-title pe-3">Juridique</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.contracts.index') }}">Gestion des Contrats</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nouveau Contrat</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-xl-12 mx-auto">
            <div class="card border-0 shadow-lg radius-15">
                <div class="card-header bg-transparent border-0 pt-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="widgets-icons-2 rounded-circle bg-gradient-cosmic text-white me-3">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold">Nouveau Contrat Juridique</h4>
                            <p class="mb-0 text-muted">Édition et enregistrement d'un nouvel accord contractuel</p>
                        </div>
                    </div>
                </div>
                <hr class="mx-4 my-2">
                <div class="card-body p-4">
                    <form action="{{ route('admin.contracts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <!-- Section Identité -->
                            <div class="col-12">
                                <h6 class="text-uppercase fw-bold text-primary mb-3"><i class="fas fa-id-card me-2"></i>Informations de base</h6>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Adhérent concerné <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent"><i class="fas fa-user text-primary"></i></span>
                                    <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                        <option value="">Sélectionner un adhérent</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} {{ $user->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Type de contrat <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent"><i class="fas fa-tags text-primary"></i></span>
                                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                        <option value="">Sélectionner un type</option>
                                        @foreach($types as $value => $label)
                                            <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold">Titre du contrat <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent"><i class="fas fa-heading text-primary"></i></span>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Ex: Contrat de Production Album 2026" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold">Lier à une demande courante (Optionnel)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent"><i class="fas fa-link text-primary"></i></span>
                                    <select id="contractable_select" class="form-select" disabled>
                                        <option value="">Sélectionnez d'abord un adhérent</option>
                                    </select>
                                </div>
                                <input type="hidden" name="contractable_type" id="contractable_type" value="{{ old('contractable_type') }}">
                                <input type="hidden" name="contractable_id" id="contractable_id" value="{{ old('contractable_id') }}">
                                <small class="text-muted mt-1 d-block">Lier ce contrat à un projet de production ou un voyage spécifique.</small>
                            </div>

                            <!-- Section Détails -->
                            <div class="col-12 mt-5">
                                <h6 class="text-uppercase fw-bold text-primary mb-3"><i class="fas fa-info-circle me-2"></i>Contenu & Validité</h6>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-bold">Description / Notes</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent"><i class="fas fa-align-left text-primary"></i></span>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Détails supplémentaires, clauses particulières...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Date de début</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent"><i class="fas fa-calendar-check text-primary"></i></span>
                                    <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Date de fin</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent"><i class="fas fa-calendar-times text-primary"></i></span>
                                    <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Statut <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent"><i class="fas fa-toggle-on text-primary"></i></span>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                                        <option value="signed" {{ old('status') == 'signed' ? 'selected' : '' }}>Signé</option>
                                        <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expiré</option>
                                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                                        <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>Clôturé</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Section Fichier -->
                            <div class="col-12 mt-5">
                                <h6 class="text-uppercase fw-bold text-primary mb-3"><i class="fas fa-file-pdf me-2"></i>Document attaché</h6>
                            </div>

                            <div class="col-md-12">
                                <div class="upload-container p-4 border-dashed rounded-3 text-center bg-light">
                                    <i class="fas fa-cloud-upload-alt fs-1 text-primary mb-3"></i>
                                    <h5>Télécharger le contrat (PDF)</h5>
                                    <p class="text-muted small">Taille maximale autorisée : 12 Mo</p>
                                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept=".pdf">
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="col-12 mt-5 mb-3">
                                <div class="d-grid d-md-flex align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-5 radius-30 btn-lg shadow">
                                        <i class="fas fa-save me-2"></i>Enregistrer le contrat
                                    </button>
                                    <a href="{{ route('admin.contracts.index') }}" class="btn btn-outline-secondary px-5 radius-30 btn-lg">
                                        <i class="fas fa-times me-2"></i>Annuler
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_css')
<style>
    .bg-gradient-cosmic {
        background: linear-gradient(to right, #fa584d, #ff8c7f);
    }
    .text-primary {
        color: #fa584d !important;
    }
    .btn-primary {
        background-color: #fa584d;
        border-color: #fa584d;
    }
    .btn-primary:hover {
        background-color: #e44d43;
        border-color: #e44d43;
    }
    .input-group-text {
        border-right: none;
    }
    .form-control, .form-select {
        border-left: none;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: none;
        border-color: #dee2e6;
    }
    .border-dashed {
        border: 2px dashed #fa584d;
    }
    .upload-container {
        transition: all 0.3s ease;
    }
    .upload-container:hover {
        background-color: #fff1f0 !important;
    }
    .radius-15 {
        border-radius: 15px;
    }
    .widgets-icons-2 {
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
    }
</style>
@endsection

@section('extra_js')
<script>
    $(document).ready(function() {
        const $userSelect = $('#user_id');
        const $contractableSelect = $('#contractable_select');
        const $typeInput = $('#contractable_type');
        const $idInput = $('#contractable_id');

        function loadRelatedItems(userId, selectedValue = null) {
            if (!userId) {
                $contractableSelect.html('<option value="">Sélectionnez d\'abord un adhérent</option>').prop('disabled', true);
                $typeInput.val('');
                $idInput.val('');
                return;
            }

            $contractableSelect.html('<option value="">Chargement...</option>').prop('disabled', true);

            let url = "{{ route('admin.contracts.related-items', ['user' => ':userId']) }}";
            url = url.replace(':userId', userId);

            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    let html = '<option value="">Aucune liaison</option>';

                    if (data.productions && data.productions.length > 0) {
                        html += '<optgroup label="Productions">';
                        data.productions.forEach(function(item) {
                            let val = "App\\Models\\Production:" + item.id;
                            let selected = (selectedValue === val) ? 'selected' : '';
                            html += `<option value="${val}" ${selected}>${item.title}</option>`;
                        });
                        html += '</optgroup>';
                    }

                    if (data.visas && data.visas.length > 0) {
                        html += '<optgroup label="Demandes de Visa / Voyages">';
                        data.visas.forEach(function(item) {
                            let val = "App\\Models\\VisaApplication:" + item.id;
                            let selected = (selectedValue === val) ? 'selected' : '';
                            html += `<option value="${val}" ${selected}>${item.title}</option>`;
                        });
                        html += '</optgroup>';
                    }

                    if (data.productions.length === 0 && data.visas.length === 0) {
                        html = '<option value="">Aucun projet ou visa trouvé pour cet adhérent</option>';
                    }

                    $contractableSelect.html(html).prop('disabled', false);
                },
                error: function() {
                    $contractableSelect.html('<option value="">Erreur de chargement</option>').prop('disabled', true);
                }
            });
        }

        $userSelect.on('change', function() {
            loadRelatedItems($(this).val());
        });

        $contractableSelect.on('change', function() {
            var val = $(this).val();
            if (val) {
                var parts = val.split(':');
                $typeInput.val(parts[0]);
                $idInput.val(parts[1]);
            } else {
                $typeInput.val('');
                $idInput.val('');
            }
        });

        // Trigger loading if user is already selected (e.g. after validation error)
        if ($userSelect.val()) {
            let initialVal = null;
            if ($typeInput.val() && $idInput.val()) {
                initialVal = $typeInput.val() + ":" + $idInput.val();
            }
            loadRelatedItems($userSelect.val(), initialVal);
        }
    });
</script>
@endsection

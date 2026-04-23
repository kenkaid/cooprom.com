@extends('admin.layouts.app')

@section('title', 'Modèles de Contrats - COOPROM Admin')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Opérations Métiers</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modèles de contrats</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-3">Ajouter un Modèle</h5>
                    <form action="{{ route('admin.contracts.templates.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nom du modèle</label>
                            <input type="text" name="name" class="form-control" placeholder="ex: Contrat de Production" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type de contrat</label>
                            <select name="type" class="form-select">
                                <option value="">Choisir un type...</option>
                                @foreach($types as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Fichier (PDF, DOC, DOCX)</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Uploader le modèle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-3">Modèles de Contrats Types</h5>
                    <p class="text-muted">Gérez les modèles standards de la COOPROM.</p>
                    <hr>

                    <div class="list-group list-group-flush">
                        @forelse($templates as $template)
                            <div class="list-group-item d-flex align-items-center px-0 py-3">
                                <div class="font-35 {{ $template->extension == 'pdf' ? 'text-danger' : 'text-primary' }}">
                                    @if($template->extension == 'pdf')
                                        <i class="bi bi-file-earmark-pdf-fill"></i>
                                    @else
                                        <i class="bi bi-file-earmark-word-fill"></i>
                                    @endif
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-0">{{ $template->name }}</h6>
                                    <small class="text-muted">
                                        {{ $types[$template->type] ?? 'Type non défini' }} |
                                        Format .{{ $template->extension }} |
                                        {{ number_format($template->size / 1024, 2) }} KB |
                                        Mis à jour: {{ $template->updated_at->format('d/m/Y') }}
                                    </small>
                                    @if($template->description)
                                        <p class="mb-0 small text-muted mt-1">{{ $template->description }}</p>
                                    @endif
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.contracts.templates.download', $template) }}" class="btn btn-light-primary btn-sm radius-30 px-3">
                                        <i class="bi bi-download me-1"></i> Télécharger
                                    </a>
                                    <form action="{{ route('admin.contracts.templates.destroy', $template) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce modèle ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light-danger btn-sm radius-30 px-3">
                                            <i class="bi bi-trash me-1"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <i class="bi bi-file-earmark-text text-muted font-35"></i>
                                <p class="mt-2 text-muted">Aucun modèle de contrat n'a encore été ajouté.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body">
                    <h6 class="mb-3"><i class="bi bi-info-circle-fill me-2 text-info"></i> Note administrative</h6>
                    <p class="small text-muted mb-0">
                        Ces modèles sont fournis à titre indicatif pour les administrateurs. Ils peuvent être téléchargés, modifiés puis uploadés spécifiquement pour chaque artiste lors de la création d'un contrat.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

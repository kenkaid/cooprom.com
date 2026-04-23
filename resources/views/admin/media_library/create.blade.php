@extends('admin.layouts.app')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Médiathèque</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.media-library.index') }}">Médiathèque</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.media-library.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-12 col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Titre du média</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description (optionnel)</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Type de média</label>
                        <select name="type" id="mediaType" class="form-select" required>
                            <option value="file" {{ old('type') == 'file' ? 'selected' : '' }}>Fichier local (Image/Vidéo)</option>
                            <option value="youtube" {{ old('type') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                            <option value="facebook" {{ old('type') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                            <option value="vimeo" {{ old('type') == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                        </select>
                    </div>

                    <div id="fileSection" class="mb-3 {{ old('type', 'file') != 'file' ? 'd-none' : '' }}">
                        <label class="form-label">Sélectionner le fichier</label>
                        <input type="file" name="media_file" class="form-control @error('media_file') is-invalid @enderror">
                        <small class="text-muted">Images ou Vidéos (max 20MB)</small>
                        @error('media_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div id="urlSection" class="mb-3 {{ old('type', 'file') == 'file' ? 'd-none' : '' }}">
                        <label class="form-label">Lien (URL)</label>
                        <input type="url" name="external_url" class="form-control @error('external_url') is-invalid @enderror" value="{{ old('external_url') }}" placeholder="https://...">
                        @error('external_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('extra_js')
<script>
    document.getElementById('mediaType').addEventListener('change', function() {
        if (this.value === 'file') {
            document.getElementById('fileSection').classList.remove('d-none');
            document.getElementById('urlSection').classList.add('d-none');
        } else {
            document.getElementById('fileSection').classList.add('d-none');
            document.getElementById('urlSection').classList.remove('d-none');
        }
    });
</script>
@endsection

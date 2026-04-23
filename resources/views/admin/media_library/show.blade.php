@extends('admin.layouts.app')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Médiathèque</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.media-library.index') }}">Médiathèque</a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card">
            <div class="card-body">
                @if($mediaLibrary->type == 'file')
                    @if($mediaLibrary->hasMedia('library'))
                        @php $media = $mediaLibrary->getFirstMedia('library'); @endphp
                        @if(Str::startsWith($media->mime_type, 'image/'))
                            <img src="{{ $media->getUrl() }}" class="img-fluid rounded" alt="{{ $mediaLibrary->title }}">
                        @elseif(Str::startsWith($media->mime_type, 'video/'))
                            <video controls class="w-100 rounded">
                                <source src="{{ $media->getUrl() }}" type="{{ $media->mime_type }}">
                                Votre navigateur ne supporte pas la lecture de vidéos.
                            </video>
                        @else
                            <div class="p-5 text-center bg-light rounded">
                                <i class="bi bi-file-earmark-text fs-1"></i>
                                <p class="mt-3">Fichier : {{ $media->file_name }}</p>
                                <a href="{{ $media->getUrl() }}" class="btn btn-primary" download>Télécharger</a>
                            </div>
                        @endif
                    @endif
                @else
                    <div class="ratio ratio-16x9">
                        @if($embedHtml)
                            {!! $embedHtml !!}
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light">
                                <p>Impossible de charger l'intégration pour : {{ $mediaLibrary->external_url }}</p>
                            </div>
                        @endif
                    </div>
                @endif

                <div class="mt-4">
                    <h3>{{ $mediaLibrary->title }}</h3>
                    <p class="text-muted">{{ $mediaLibrary->description ?? 'Aucune description.' }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informations</h5>
                <hr>
                <p><strong>Type:</strong> <span class="badge bg-info">{{ strtoupper($mediaLibrary->type) }}</span></p>
                <p><strong>Ajouté le:</strong> {{ $mediaLibrary->created_at->format('d/m/Y H:i') }}</p>
                @if($mediaLibrary->external_url)
                    <p><strong>Lien source:</strong> <a href="{{ $mediaLibrary->external_url }}" target="_blank" class="text-break">{{ $mediaLibrary->external_url }}</a></p>
                @endif

                <div class="d-grid gap-2 mt-4">
                    <a href="{{ route('admin.media-library.edit', $mediaLibrary->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Modifier</a>
                    <form action="{{ route('admin.media-library.destroy', $mediaLibrary->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100"><i class="bi bi-trash"></i> Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

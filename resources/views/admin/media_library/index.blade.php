@extends('admin.layouts.app')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Communication</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Médiathèque</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <a href="{{ route('admin.media-library.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Ajouter un média</a>
    </div>
</div>

<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-3">
    @forelse($mediaItems as $item)
    <div class="col">
        <div class="card h-100">
            @if($item->type == 'file')
                @if($item->hasMedia('library'))
                    @php $media = $item->getFirstMedia('library'); @endphp
                    @if(Str::startsWith($media->mime_type, 'image/'))
                        <img src="{{ $media->getUrl('thumb') }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: contain; background-color: #f8f9fa;" onerror="this.src='{{ $media->getUrl() }}'; this.onerror=null;">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                            <i class="bi bi-file-earmark-play-fill fs-1"></i>
                        </div>
                    @endif
                @endif
            @else
                <div class="card-img-top d-flex align-items-center justify-content-center bg-dark text-white" style="height: 200px;">
                    <i class="bi bi-{{ $item->type == 'youtube' ? 'youtube' : ($item->type == 'vimeo' ? 'vimeo' : 'facebook') }} fs-1"></i>
                </div>
            @endif
            <div class="card-body">
                <h6 class="card-title mb-1 text-truncate">{{ $item->title }}</h6>
                <p class="card-text small text-muted mb-2">
                    <span class="badge bg-light-info text-info">{{ strtoupper($item->type) }}</span>
                    {{ $item->created_at->format('d/m/Y') }}
                </p>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.media-library.show', $item->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('admin.media-library.edit', $item->id) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('admin.media-library.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info text-center">
            Aucun média trouvé dans la bibliothèque.
        </div>
    </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $mediaItems->links() }}
</div>
@endsection

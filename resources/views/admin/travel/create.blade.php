@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Opérations Métiers</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.travels.index') }}">Voyages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nouveau Voyage</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-xl-9 mx-auto">
        <h6 class="mb-0 text-uppercase">Créer un nouveau voyage</h6>
        <hr/>
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-body p-5">
                <form class="row g-3" action="{{ route('admin.travels.store') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <label for="title" class="form-label">Titre du voyage / Mission</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="destination" class="form-label">Destination (Pays/Ville)</label>
                        <input type="text" class="form-control @error('destination') is-invalid @enderror" id="destination" name="destination" value="{{ old('destination') }}" required>
                        @error('destination')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label">Type de voyage</label>
                        <select id="type" name="type" class="form-select @error('type') is-invalid @enderror">
                            <option value="group" {{ old('type') == 'group' ? 'selected' : '' }}>Voyage de Groupe</option>
                            <option value="individual" {{ old('type') == 'individual' ? 'selected' : '' }}>Voyage Individuel (Assistance)</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="departure_date" class="form-label">Date de départ</label>
                        <input type="date" class="form-control @error('departure_date') is-invalid @enderror" id="departure_date" name="departure_date" value="{{ old('departure_date') }}" required>
                        @error('departure_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="return_date" class="form-label">Date de retour (Optionnel)</label>
                        <input type="date" class="form-control @error('return_date') is-invalid @enderror" id="return_date" name="return_date" value="{{ old('return_date') }}">
                        @error('return_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Description / Détails de la mission</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary px-5">Enregistrer le voyage</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('admin.layouts.app')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Configuration</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.attributes.index') }}">Attributs Dynamiques</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ isset($attribute) ? 'Modifier' : 'Nouveau' }}</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->

<div class="row">
    <div class="col-xl-9 mx-auto">
        <h6 class="mb-0 text-uppercase">{{ isset($attribute) ? 'Modifier l\'Attribut' : 'Créer un nouvel Attribut' }}</h6>
        <hr/>
        <div class="card">
            <div class="card-body">
                <form action="{{ isset($attribute) ? route('admin.attributes.update', $attribute->uuid) : route('admin.attributes.store') }}" method="POST">
                    @csrf
                    @if(isset($attribute))
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Libellé (Label) <span class="text-danger">*</span></label>
                            <input type="text" name="label" class="form-control @error('label') is-invalid @enderror" value="{{ old('label', $attribute->label ?? '') }}" required placeholder="Ex: Numéro de Burida">
                            @error('label')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Type de champ <span class="text-danger">*</span></label>
                            <select name="type" class="form-select @error('type') is-invalid @enderror" required id="type-select">
                                <option value="text" {{ (old('type', $attribute->type ?? '') == 'text') ? 'selected' : '' }}>Texte</option>
                                <option value="number" {{ (old('type', $attribute->type ?? '') == 'number') ? 'selected' : '' }}>Nombre</option>
                                <option value="email" {{ (old('type', $attribute->type ?? '') == 'email') ? 'selected' : '' }}>Email</option>
                                <option value="date" {{ (old('type', $attribute->type ?? '') == 'date') ? 'selected' : '' }}>Date</option>
                                <option value="select" {{ (old('type', $attribute->type ?? '') == 'select') ? 'selected' : '' }}>Liste déroulante (Select)</option>
                                <option value="textarea" {{ (old('type', $attribute->type ?? '') == 'textarea') ? 'selected' : '' }}>Zone de texte (Textarea)</option>
                                <option value="checkbox" {{ (old('type', $attribute->type ?? '') == 'checkbox') ? 'selected' : '' }}>Case à cocher (Checkbox)</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12" id="options-container" style="display: {{ (old('type', $attribute->type ?? '') == 'select') ? 'block' : 'none' }};">
                            <label class="form-label">Options (séparées par des virgules) <span class="text-danger">*</span></label>
                            <input type="text" name="options" class="form-control @error('options') is-invalid @enderror" value="{{ old('options', isset($attribute->options) ? implode(', ', $attribute->options) : '') }}" placeholder="Option 1, Option 2, Option 3">
                            <small class="text-muted">Obligatoire uniquement pour le type "Liste déroulante".</small>
                            @error('options')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Rôles autorisés (laisser vide pour tous)</label>
                            <select name="allowed_roles" class="form-select">
                                <option value="">Tous les rôles</option>
                                <option value="artiste" {{ (old('allowed_roles', $attribute->allowed_roles ?? '') == 'artiste') ? 'selected' : '' }}>Artiste</option>
                                <option value="organisation" {{ (old('allowed_roles', $attribute->allowed_roles ?? '') == 'organisation') ? 'selected' : '' }}>Organisation</option>
                                <option value="individuel" {{ (old('allowed_roles', $attribute->allowed_roles ?? '') == 'individuel') ? 'selected' : '' }}>Individuel</option>
                            </select>
                            <small class="text-muted">Cet attribut ne s'affichera que pour le rôle sélectionné.</small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ordre d'affichage</label>
                            <input type="number" name="order_column" class="form-control" value="{{ old('order_column', $attribute->order_column ?? 0) }}">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Secteurs Culturels associés (laisser vide pour tous)</label>
                            <div class="row">
                                @foreach($sectors as $sector)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="cultural_sectors[]" value="{{ $sector->id }}" id="sector_{{ $sector->id }}"
                                                {{ (isset($attribute) && $attribute->culturalSectors->contains($sector->id)) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="sector_{{ $sector->id }}">
                                                {{ $sector->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_required" value="1" id="is_required" {{ old('is_required', $attribute->is_required ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_required">Champ obligatoire</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Règles de validation (Optionnel)</label>
                            <input type="text" name="validation_rules" class="form-control" value="{{ old('validation_rules', $attribute->validation_rules ?? '') }}" placeholder="Ex: min:4|max:10">
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary px-5 radius-30">Enregistrer</button>
                            <a href="{{ route('admin.attributes.index') }}" class="btn btn-outline-secondary px-5 radius-30">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<script>
    document.getElementById('type-select').addEventListener('change', function() {
        var optionsContainer = document.getElementById('options-container');
        if (this.value === 'select') {
            optionsContainer.style.display = 'block';
        } else {
            optionsContainer.style.display = 'none';
        }
    });
</script>
@endsection

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Pays</label>
        <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" value="{{ old('country', $guide->country ?? '') }}" required>
        @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Type de Visa</label>
        <input type="text" name="visa_type" class="form-control" value="{{ old('visa_type', $guide->visa_type ?? '') }}" placeholder="Ex: Court séjour, Talent, etc.">
    </div>

    <div class="col-12">
        <label class="form-label">Description / Introduction</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description', $guide->description ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label">Documents requis (un par ligne)</label>
        <textarea name="required_documents" class="form-control" rows="5" placeholder="Ex: Passeport valide&#10;Photos d'identité&#10;Justificatif d'hébergement...">{{ old('required_documents', $guide->required_documents ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label">Procédure / Étapes</label>
        <textarea name="procedure_steps" class="form-control" rows="5" placeholder="Étape 1: Prendre RDV...&#10;Étape 2: Payer les frais...">{{ old('procedure_steps', $guide->procedure_steps ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label">Liens utiles (URLs)</label>
        <textarea name="useful_links" class="form-control" rows="2" placeholder="Lien vers l'ambassade, etc.">{{ old('useful_links', $guide->useful_links ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <div class="form-check form-switch">
            <input type="hidden" name="is_active" value="0">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $guide->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Rendre ce guide actif</label>
        </div>
    </div>

    <div class="col-12 text-end">
        <a href="{{ route('admin.visa-guides.index') }}" class="btn btn-secondary me-2">Annuler</a>
        <button type="submit" class="btn btn-primary px-4">{{ isset($guide) ? 'Enregistrer les modifications' : 'Enregistrer' }}</button>
    </div>
</div>

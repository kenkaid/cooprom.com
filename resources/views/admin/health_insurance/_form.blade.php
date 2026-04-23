<div class="row g-4">
    <div class="col-12">
        <h5 class="mb-3">Informations Générales</h5>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Nom du partenaire</label>
        <div class="input-group">
            <span class="input-group-text bg-transparent"><i class="fas fa-hospital text-primary"></i></span>
            <input type="text" name="partner_name" class="form-control @error('partner_name') is-invalid @enderror" value="{{ old('partner_name', $healthInsurance->partner_name ?? '') }}" placeholder="Nom de l'assurance ou mutuelle" required>
        </div>
        @error('partner_name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Type d'assurance</label>
        <div class="input-group">
            <span class="input-group-text bg-transparent"><i class="fas fa-shield-alt text-primary"></i></span>
            <input type="text" name="insurance_type" class="form-control @error('insurance_type') is-invalid @enderror" value="{{ old('insurance_type', $healthInsurance->insurance_type ?? '') }}" placeholder="Ex: Mutuelle, Prévoyance, Santé..." required>
        </div>
        @error('insurance_type') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label class="form-label fw-bold">Description courte</label>
        <div class="input-group">
            <span class="input-group-text bg-transparent"><i class="fas fa-align-left text-primary"></i></span>
            <textarea name="description" class="form-control" rows="2" placeholder="Brève présentation du partenaire...">{{ old('description', $healthInsurance->description ?? '') }}</textarea>
        </div>
    </div>

    <div class="col-12">
        <h5 class="mb-3 mt-2">Détails de l'Offre</h5>
    </div>
    <div class="col-12">
        <label class="form-label fw-bold">Garanties et Couverture</label>
        <div class="input-group">
            <span class="input-group-text bg-transparent"><i class="fas fa-list-check text-primary"></i></span>
            <textarea name="coverage_details" class="form-control" rows="6" placeholder="Listez ici les garanties principales, les taux de remboursement, etc.">{{ old('coverage_details', $healthInsurance->coverage_details ?? '') }}</textarea>
        </div>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Contact / Infos utiles</label>
        <div class="input-group">
            <span class="input-group-text bg-transparent"><i class="fas fa-phone-alt text-primary"></i></span>
            <input type="text" name="contact_info" class="form-control" value="{{ old('contact_info', $healthInsurance->contact_info ?? '') }}" placeholder="Téléphone, email, service client...">
        </div>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Lien externe (URL)</label>
        <div class="input-group">
            <span class="input-group-text bg-transparent"><i class="fas fa-external-link-alt text-primary"></i></span>
            <input type="url" name="external_link" class="form-control @error('external_link') is-invalid @enderror" value="{{ old('external_link', $healthInsurance->external_link ?? '') }}" placeholder="https://www.assurance-partenaire.com">
        </div>
        @error('external_link') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <div class="card bg-light-primary border-0 shadow-none mb-0">
            <div class="card-body">
                <div class="form-check form-switch">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $healthInsurance->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="is_active">Rendre cette offre visible pour les membres</label>
                </div>
                <small class="text-muted d-block mt-1 ms-4">Si désactivé, les membres ne pourront pas voir ou accéder aux détails de ce partenaire.</small>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4">
        <hr>
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.health-insurances.index') }}" class="btn btn-light px-4">
                <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
            <button type="submit" class="btn btn-primary px-5 shadow-sm">
                <i class="fas fa-save me-2"></i>{{ isset($healthInsurance) ? 'Mettre à jour le partenaire' : 'Enregistrer le partenaire' }}
            </button>
        </div>
    </div>
</div>

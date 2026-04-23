<div class="row">
    <div class="col-12">
        <div class="mb-3">
            <label class="form-label">Nom du secteur</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-tag"></i></span>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $sector->name ?? '') }}" placeholder="Ex: Musique, Danse, etc.">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Description du secteur...">{{ old('description', $sector->description ?? '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Statut</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-check-circle"></i></span>
                <select name="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="1" {{ (old('status', $sector->status ?? 1) == 1) ? 'selected' : '' }}>Actif</option>
                    <option value="0" {{ (old('status', $sector->status ?? 1) == 0) ? 'selected' : '' }}>Inactif</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

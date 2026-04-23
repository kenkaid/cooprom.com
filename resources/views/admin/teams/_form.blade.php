<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Nom</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $team->name ?? '') }}" placeholder="Nom">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Prénom</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $team->last_name ?? '') }}" placeholder="Prénom">
            @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Désignation / Poste</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
            <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation', $team->designation ?? '') }}" placeholder="Ex: Directeur, Designer...">
            @error('designation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Photo</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-image"></i></span>
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">
            @error('photo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Facebook (URL)</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-facebook"></i></span>
            <input type="url" name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $team->facebook ?? '') }}" placeholder="https://facebook.com/...">
            @error('facebook')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Twitter (URL)</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-twitter"></i></span>
            <input type="url" name="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ old('twitter', $team->twitter ?? '') }}" placeholder="https://twitter.com/...">
            @error('twitter')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">LinkedIn (URL)</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-linkedin"></i></span>
            <input type="url" name="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin', $team->linkedin ?? '') }}" placeholder="https://linkedin.com/in/...">
            @error('linkedin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Vimeo (URL)</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-vimeo"></i></span>
            <input type="url" name="vimeo" class="form-control @error('vimeo') is-invalid @enderror" value="{{ old('vimeo', $team->vimeo ?? '') }}" placeholder="https://vimeo.com/...">
            @error('vimeo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-3">
        <label class="form-label">Statut</label>
        <div class="form-check form-switch">
            <input type="hidden" name="status" value="0">
            <input class="form-check-input" type="checkbox" name="status" value="1" id="flexSwitchCheckDefault" {{ (old('status', $team->status ?? 1) == 1) ? 'checked' : '' }}>
            <label class="form-check-label" for="flexSwitchCheckDefault">Actif</label>
        </div>
    </div>
</div>

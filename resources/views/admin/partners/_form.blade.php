<div class="mb-3">
    <label class="form-label">Nom du partenaire <span class="text-danger">*</span></label>
    <div class="input-group">
        <span class="input-group-text bg-transparent"><i class="fas fa-user"></i></span>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $partner->name ?? '') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Numéro de téléphone <span class="text-danger">*</span></label>
    <div class="input-group">
        <span class="input-group-text bg-transparent"><i class="fas fa-phone"></i></span>
        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $partner->phone_number ?? '') }}" required>
        @error('phone_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <div class="input-group">
        <span class="input-group-text bg-transparent"><i class="fas fa-align-left"></i></span>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $partner->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    @if(isset($partner) && $partner->logo)
        <label class="form-label">Logo actuel</label>
        <div class="mb-2">
            <img src="{{ $partner->logo == 'default.png' ? asset('assets/front/images/resource/members/visa.jpeg') : asset('storage/partners/' . $partner->logo) }}"
                 alt="{{ $partner->name }}"
                 style="width: 100px; height: 100px; object-fit: contain;" class="border p-1">
        </div>
        <label class="form-label">Changer le logo</label>
    @else
        <label class="form-label">Logo</label>
    @endif
    <div class="input-group">
        <span class="input-group-text bg-transparent"><i class="fas fa-image"></i></span>
        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
        @error('logo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <small class="text-muted">Formats autorisés : jpeg, png, jpg, gif. Taille max : 2Mo.</small>
</div>

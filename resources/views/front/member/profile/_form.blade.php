<div class="row">
    <!-- Photo de profil -->
    <div class="col-12 mb-4 text-center">
        <div class="profile-photo-wrapper position-relative d-inline-block">
            <img id="photo-preview" src="{{ $user->photo }}"
                 class="rounded-circle border shadow-sm p-1"
                 style="width: 150px; height: 150px; object-fit: cover;" alt="Photo">
            <label for="photo-input" class="btn btn-sm btn_orange text-white position-absolute rounded-circle shadow"
                   style="bottom: 10px; right: 10px; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                <i class="fa fa-camera"></i>
                <input type="file" id="photo-input" name="photo" class="d-none" accept="image/*" onchange="previewImage(this)">
            </label>
        </div>
        @error('photo')
            <div class="text-danger small mt-2">{{ $message }}</div>
        @enderror
        <div class="mt-2">
            <small class="text-muted">Format recommandé : JPG, PNG (Max 2Mo)</small>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label class="font-weight-bold small text-uppercase">Prénom</label>
        <input type="text" name="name" class="form-control rounded-pill px-4 @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" placeholder="Votre prénom">
        @error('name') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="font-weight-bold small text-uppercase">Nom de famille</label>
        <input type="text" name="last_name" class="form-control rounded-pill px-4 @error('last_name') is-invalid @enderror" value="{{ old('last_name', $user->last_name) }}" placeholder="Votre nom">
        @error('last_name') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="font-weight-bold small text-uppercase">Adresse Email</label>
        <input type="email" name="email" class="form-control rounded-pill px-4 @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" placeholder="Email de contact">
        @error('email') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="font-weight-bold small text-uppercase">Numéro de téléphone</label>
        <input type="text" name="phone_number" class="form-control rounded-pill px-4 @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $user->phone_number) }}" placeholder="Ex: +225 0102030405">
        @error('phone_number') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12 mb-4">
        <label class="font-weight-bold small text-uppercase">Secteur d'activité culturelle</label>
        <select name="cultural_sector_id" class="form-control rounded-pill px-4 @error('cultural_sector_id') is-invalid @enderror">
            <option value="">Sélectionnez votre secteur</option>
            @foreach($sectors as $sector)
                <option value="{{ $sector->id }}" {{ old('cultural_sector_id', $user->cultural_sector_id) == $sector->id ? 'selected' : '' }}>
                    {{ $sector->name }}
                </option>
            @endforeach
        </select>
        @error('cultural_sector_id') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
    </div>

    <div class="col-12 mt-2">
        <h5 class="font-weight-bold border-bottom pb-2 mb-3">Changer le mot de passe</h5>
        <p class="small text-muted mb-4">Laissez vide si vous ne souhaitez pas modifier votre mot de passe.</p>
    </div>

    <div class="col-md-6 mb-3">
        <label class="font-weight-bold small text-uppercase">Nouveau mot de passe</label>
        <input type="password" name="password" class="form-control rounded-pill px-4 @error('password') is-invalid @enderror" placeholder="••••••••">
        @error('password') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="font-weight-bold small text-uppercase">Confirmer le mot de passe</label>
        <input type="password" name="password_confirmation" class="form-control rounded-pill px-4" placeholder="••••••••">
    </div>
</div>

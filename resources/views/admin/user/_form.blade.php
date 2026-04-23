<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Nom (Nom de famille)</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name ?? '') }}" placeholder="Prénom">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Prénom</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $user->last_name ?? '') }}" placeholder="Nom">
            @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-3">
        <label class="form-label">Photo de profil</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-image"></i></span>
            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
            @error('photo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @if(isset($user) && $user->photo)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $user->photo) }}" alt="Photo de profil" class="img-thumbnail" style="height: 100px;">
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Email</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email ?? '') }}" placeholder="email@exemple.com">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Téléphone</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
            <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $user->phone_number ?? '') }}" placeholder="0123456789">
            @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Secteur Culturel</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-layers"></i></span>
            <select name="cultural_sector_id" class="form-select @error('cultural_sector_id') is-invalid @enderror">
                <option value="">Sélectionner un secteur</option>
                @foreach($sectors as $sector)
                    <option value="{{ $sector->id }}" {{ (old('cultural_sector_id', $user->cultural_sector_id ?? '') == $sector->id) ? 'selected' : '' }}>
                        {{ $sector->name }}
                    </option>
                @endforeach
            </select>
            @error('cultural_sector_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Rôles / Type d'utilisateur</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-shield-check"></i></span>
            <select name="roles[]" class="form-select @error('roles') is-invalid @enderror" multiple>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ (isset($user) && $user->hasRole($role->name)) ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
            @error('roles')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <small class="text-muted">Maintenez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs rôles.</small>
    </div>
</div>

<div class="row" id="staff_fields" style="display: none;">
    <div class="col-md-12">
        <h6 class="mb-3">Informations d'Équipe (Staff uniquement)</h6>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Désignation / Poste</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
            <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation', $user->designation ?? '') }}" placeholder="ex: Manager, Directeur">
            @error('designation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Statut</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-toggle-on"></i></span>
            <select name="status" class="form-select">
                <option value="1" {{ (old('status', $user->status ?? 1) == 1) ? 'selected' : '' }}>Actif</option>
                <option value="0" {{ (old('status', $user->status ?? 1) == 0) ? 'selected' : '' }}>Inactif</option>
            </select>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Facebook (URL)</label>
        <input type="text" name="facebook" class="form-control" value="{{ old('facebook', $user->facebook ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Twitter (URL)</label>
        <input type="text" name="twitter" class="form-control" value="{{ old('twitter', $user->twitter ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">LinkedIn (URL)</label>
        <input type="text" name="linkedin" class="form-control" value="{{ old('linkedin', $user->linkedin ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Vimeo (URL)</label>
        <input type="text" name="vimeo" class="form-control" value="{{ old('vimeo', $user->vimeo ?? '') }}">
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-3">
        <label class="form-label">Adresse physique</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $user->address ?? '') }}" placeholder="Adresse physique">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rolesSelect = document.querySelector('select[name="roles[]"]');
        const staffFields = document.getElementById('staff_fields');

        function toggleStaffFields() {
            const selectedRoles = Array.from(rolesSelect.selectedOptions).map(option => option.value);
            const staffRoles = ['staff', 'admin', 'super-admin'];
            const hasStaffRole = selectedRoles.some(role => staffRoles.includes(role));

            if (hasStaffRole) {
                staffFields.style.display = 'flex';
            } else {
                staffFields.style.display = 'none';
            }
        }

        rolesSelect.addEventListener('change', toggleStaffFields);
        toggleStaffFields();
    });
</script>

<div class="row">
    <div class="col-md-12 mb-3">
        <label class="form-label">Mot de passe {{ isset($user) ? '(laisser vide pour ne pas modifier)' : '' }}</label>
        <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="********">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

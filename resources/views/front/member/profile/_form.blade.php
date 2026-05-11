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

    @if($user->role_type === 'organisation')
        <div class="col-md-6 mb-3">
            <label class="font-weight-bold small text-uppercase">Raison Sociale</label>
            <input type="text" name="company_name" class="form-control rounded-pill px-4 @error('company_name') is-invalid @enderror" value="{{ old('company_name', $user->company_name) }}" placeholder="Nom de l'organisation">
            @error('company_name') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="font-weight-bold small text-uppercase">Nom du dirigeant</label>
            <input type="text" name="manager_name" class="form-control rounded-pill px-4 @error('manager_name') is-invalid @enderror" value="{{ old('manager_name', $user->manager_name) }}" placeholder="Dirigeant principal">
            @error('manager_name') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
        </div>
    @else
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
    @endif

    @if($user->role_type === 'individuel')
        <div class="col-md-6 mb-3">
            <label class="font-weight-bold small text-uppercase">Numéro CNPS</label>
            <input type="text" name="cnps_number" class="form-control rounded-pill px-4 @error('cnps_number') is-invalid @enderror" value="{{ old('cnps_number', $user->cnps_number) }}" placeholder="N° CNPS">
            @error('cnps_number') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="font-weight-bold small text-uppercase">Profession</label>
            <input type="text" name="profession" class="form-control rounded-pill px-4 @error('profession') is-invalid @enderror" value="{{ old('profession', $user->profession) }}" placeholder="Votre métier">
            @error('profession') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
        </div>
    @endif

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

    <div class="col-md-6 mb-3">
        <label class="font-weight-bold small text-uppercase">Lieu d'habitation</label>
        <input type="text" name="habitation_place" class="form-control rounded-pill px-4 @error('habitation_place') is-invalid @enderror" value="{{ old('habitation_place', $user->habitation_place) }}" placeholder="Ville, quartier">
        @error('habitation_place') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
    </div>

    @if($user->role_type === 'artiste')
        <div class="col-md-6 mb-3">
            <label class="font-weight-bold small text-uppercase">Numéro BURIDA (Obligatoire)</label>
            <input type="text" name="burida_number" class="form-control rounded-pill px-4 @error('burida_number') is-invalid @enderror" value="{{ old('burida_number', $user->burida_number) }}" placeholder="4 chiffres">
            @error('burida_number') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="font-weight-bold small text-uppercase">Numéro CNI (Obligatoire)</label>
            <input type="text" name="cni_number" class="form-control rounded-pill px-4 @error('cni_number') is-invalid @enderror" value="{{ old('cni_number', $user->cni_number) }}" placeholder="N° de carte d'identité">
            @error('cni_number') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="font-weight-bold small text-uppercase">Pseudonyme (Obligatoire)</label>
            <input type="text" name="pseudonym" class="form-control rounded-pill px-4 @error('pseudonym') is-invalid @enderror" value="{{ old('pseudonym', $user->pseudonym) }}" placeholder="Votre nom de scène">
            @error('pseudonym') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
        </div>
    @endif

    @if($user->role_type === 'organisation')
        <div class="col-md-6 mb-3">
            <label class="font-weight-bold small text-uppercase">N° Immatriculation MC</label>
            <input type="text" name="registration_number_mc" class="form-control rounded-pill px-4 @error('registration_number_mc') is-invalid @enderror" value="{{ old('registration_number_mc', $user->registration_number_mc) }}" placeholder="Ministère de la Culture">
            @error('registration_number_mc') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="font-weight-bold small text-uppercase">Lieu d'implantation</label>
            <input type="text" name="implementation_place" class="form-control rounded-pill px-4 @error('implementation_place') is-invalid @enderror" value="{{ old('implementation_place', $user->implementation_place) }}" placeholder="Siège social">
            @error('implementation_place') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
        </div>
    @endif

    <div class="col-md-12 mb-4" x-data="{ sector_id: '{{ old('cultural_sector_id', $user->cultural_sector_id) }}' }">
        <label class="font-weight-bold small text-uppercase">Secteur d'activité culturelle</label>
        @if($user->role_type === 'individuel')
            <input type="text" name="cultural_sector_id" class="form-control rounded-pill px-4 @error('cultural_sector_id') is-invalid @enderror" value="{{ old('cultural_sector_id', $user->cultural_sector_id) }}" placeholder="Votre secteur d'activité">
        @else
            <select name="cultural_sector_id" x-model="sector_id" class="form-control rounded-pill px-4 @error('cultural_sector_id') is-invalid @enderror">
                <option value="">Sélectionnez votre secteur</option>
                @foreach($sectors as $sector)
                    <option value="{{ $sector->id }}">{{ $sector->name }}</option>
                @endforeach
            </select>
        @endif
        @error('cultural_sector_id') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror

        {{-- Champ Autre Secteur --}}
        @if($user->role_type !== 'individuel')
        <div class="mt-3" x-show="sector_id == '{{ \App\Models\CulturalSector::where('name', 'LIKE', '%AUTRES%')->first()?->id }}'">
            <label class="font-weight-bold small text-uppercase">Précisez le secteur</label>
            <input type="text" name="other_sector" class="form-control rounded-pill px-4 @error('other_sector') is-invalid @enderror" value="{{ old('other_sector', $user->other_sector) }}" placeholder="Veuillez préciser...">
            @error('other_sector') <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
        </div>
        @endif
    </div>

    {{-- Attributs Dynamiques EAV --}}
    @if(isset($dynamicAttributes) && $dynamicAttributes->count() > 0)
        <div class="col-12 mt-2">
            <h5 class="font-weight-bold border-bottom pb-2 mb-3">Informations complémentaires</h5>
        </div>
        @foreach($dynamicAttributes as $attribute)
            @php
                $userValue = $user->attributeValues->where('attribute_id', $attribute->id)->first()?->value;
            @endphp
            <div class="col-md-6 mb-3">
                <label class="font-weight-bold small text-uppercase">{{ $attribute->label }} @if($attribute->required) <span class="text-danger">*</span> @endif</label>

                @if($attribute->type === 'select')
                    <select name="attributes[{{ $attribute->uuid }}]" class="form-control rounded-pill px-4 @error('attributes.'.$attribute->uuid) is-invalid @enderror">
                        <option value="">Sélectionnez...</option>
                        @foreach($attribute->getOptions() as $option)
                            <option value="{{ $option }}" {{ old('attributes.'.$attribute->uuid, $userValue) == $option ? 'selected' : '' }}>{{ $option }}</option>
                        @endforeach
                    </select>
                @elseif($attribute->type === 'number')
                    <input type="number" name="attributes[{{ $attribute->uuid }}]" class="form-control rounded-pill px-4 @error('attributes.'.$attribute->uuid) is-invalid @enderror" value="{{ old('attributes.'.$attribute->uuid, $userValue) }}">
                @else
                    <input type="text" name="attributes[{{ $attribute->uuid }}]" class="form-control rounded-pill px-4 @error('attributes.'.$attribute->uuid) is-invalid @enderror" value="{{ old('attributes.'.$attribute->uuid, $userValue) }}">
                @endif
                @error('attributes.'.$attribute->uuid) <div class="invalid-feedback ml-3">{{ $message }}</div> @enderror
            </div>
        @endforeach
    @endif

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

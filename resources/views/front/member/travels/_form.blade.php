<div class="row clearfix">
    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
        <label>Pays de destination</label>
        <input type="text" name="country" placeholder="Ex: France, USA, Maroc..." value="{{ old('country', $visaApplication->country ?? '') }}" required>
        @error('country') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
        <label>Type de visa</label>
        <select name="visa_type" class="custom-select-box" required>
            <option value="">Sélectionnez un type</option>
            <option value="court_sejour" {{ old('visa_type', $visaApplication->visa_type ?? '') == 'court_sejour' ? 'selected' : '' }}>Court Séjour (Tourisme/Affaires)</option>
            <option value="long_sejour" {{ old('visa_type', $visaApplication->visa_type ?? '') == 'long_sejour' ? 'selected' : '' }}>Long Séjour</option>
            <option value="professionnel" {{ old('visa_type', $visaApplication->visa_type ?? '') == 'professionnel' ? 'selected' : '' }}>Professionnel / Artiste</option>
        </select>
        @error('visa_type') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
        <label>Lier à un voyage de groupe (Optionnel)</label>
        <select name="travel_id" class="custom-select-box">
            <option value="">-- Aucun (Voyage individuel) --</option>
            @foreach($availableTravels as $travel)
                @php
                    $selected = false;
                    if(old('travel_id')) {
                        $selected = old('travel_id') == $travel->uuid;
                    } elseif(isset($visaApplication) && $visaApplication->travel) {
                        $selected = $visaApplication->travel->uuid == $travel->uuid;
                    }
                @endphp
                <option value="{{ $travel->uuid }}" {{ $selected ? 'selected' : '' }}>{{ $travel->title }} ({{ $travel->destination }})</option>
            @endforeach
        </select>
        @error('travel_id') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
        <label>Informations complémentaires / Documents déjà en votre possession</label>
        <textarea name="required_documents" placeholder="Ex: J'ai déjà mon passeport valide, j'ai une invitation..." rows="4">{{ old('required_documents', $visaApplication->required_documents ?? '') }}</textarea>
        @error('required_documents') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>

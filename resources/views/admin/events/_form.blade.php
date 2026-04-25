<div class="row">
    <!-- Informations de base -->
    <div class="col-12 col-lg-8">
        <div class="card shadow-none border">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations générales</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Titre de l'événement</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               placeholder="Ex: Festival International des Arts de Côte d'Ivoire"
                               value="{{ old('title', $event->title ?? '') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Type d'événement</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                @php
                                    $types = [
                                        'festival' => 'Festival',
                                        'exposition' => 'Exposition',
                                        'seminaire' => 'Séminaire',
                                        'spectacle' => 'Spectacle',
                                        'foire' => 'Foire',
                                        'congres' => 'Congrès',
                                        'autre' => 'Autre'
                                    ];
                                @endphp
                                @foreach($types as $value => $label)
                                    <option value="{{ $value }}" {{ old('type', $event->type ?? '') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Statut de publication</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="draft" {{ old('status', $event->status ?? '') == 'draft' ? 'selected' : '' }}>Brouillon</option>
                                <option value="published" {{ old('status', $event->status ?? '') == 'published' ? 'selected' : '' }}>Publié</option>
                                <option value="open_registration" {{ old('status', $event->status ?? '') == 'open_registration' ? 'selected' : '' }}>Ouvert aux inscriptions</option>
                                @if(isset($event))
                                    <option value="ongoing" {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>En cours</option>
                                    <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Terminé</option>
                                    <option value="cancelled" {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                                @endif
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description détaillée</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                              rows="6" placeholder="Décrivez l'événement, son programme, ses objectifs...">{{ old('description', $event->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Lieu / Emplacement</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                               placeholder="Ex: Palais de la Culture, Abidjan"
                               value="{{ old('location', $event->location ?? '') }}">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Paramètres logistiques et fichiers -->
    <div class="col-12 col-lg-4">
        <div class="card shadow-none border">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Calendrier & Logistique</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Date de début</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                        <input type="datetime-local" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                               value="{{ old('start_date', isset($event) ? $event->start_date->format('Y-m-d\TH:i') : '') }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date de fin</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-hourglass-end"></i></span>
                        <input type="datetime-local" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
                               value="{{ old('end_date', (isset($event) && $event->end_date) ? $event->end_date->format('Y-m-d\TH:i') : '') }}">
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Capacité (Participants)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-users"></i></span>
                        <input type="number" name="max_participants" class="form-control @error('max_participants') is-invalid @enderror"
                               placeholder="Illimité si vide"
                               value="{{ old('max_participants', $event->max_participants ?? '') }}">
                        @error('max_participants')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-0">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="isFeatured" {{ old('is_featured', $event->is_featured ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="isFeatured">
                            Mettre en avant
                        </label>
                    </div>
                    <small class="text-muted d-block mt-1">L'événement apparaîtra en priorité sur le site.</small>
                </div>
            </div>
        </div>

        <div class="card shadow-none border mt-3" id="budget-section">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="fas fa-wallet me-2"></i>Budget & Tarifs</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Budget prévisionnel (Alloué)</label>
                    <div class="input-group">
                        <span class="input-group-text">CFA</span>
                        <input type="number" name="budget_allocated" class="form-control @error('budget_allocated') is-invalid @enderror"
                               value="{{ old('budget_allocated', $event->budget_allocated ?? '') }}" step="0.01"
                               placeholder="Montant estimé">
                        @error('budget_allocated')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @if(isset($event))
                <div class="mb-3">
                    <label class="form-label text-primary fw-bold">Dépenses réelles (Suivi)</label>
                    <div class="input-group border rounded {{ (isset($event) && $event->actual_expenses > $event->budget_allocated) ? 'border-danger' : 'border-primary' }}">
                        <span class="input-group-text bg-primary text-white">CFA</span>
                        <input type="number" name="actual_expenses" class="form-control @error('actual_expenses') is-invalid @enderror"
                               value="{{ old('actual_expenses', $event->actual_expenses ?? '') }}" step="0.01">
                        @error('actual_expenses')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="text-primary mt-1 d-block"><i class="fas fa-info-circle me-1"></i>Mettez à jour ce montant au fur et à mesure des dépenses effectuées.</small>
                </div>
                @endif

                <div class="mb-0">
                    <label class="form-label">Frais d'inscription</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-ticket-alt"></i></span>
                        <input type="number" name="entry_fee" class="form-control @error('entry_fee') is-invalid @enderror"
                               value="{{ old('entry_fee', $event->entry_fee ?? '0') }}" step="0.01">
                        @error('entry_fee')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Médias et Fichiers -->
    <div class="col-12 mt-3">
        <div class="card shadow-none border text-start">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="fas fa-images me-2"></i>Médias & Documents techniques</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Image de couverture</label>
                        <div class="d-flex align-items-start gap-3 mb-2">
                            @if(isset($event) && $event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="rounded shadow-sm" width="120" height="80" style="object-fit: cover" alt="">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 120px; height: 80px;">
                                    <i class="fas fa-image text-secondary fa-2x"></i>
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-upload"></i></span>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                </div>
                                @error('image')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                                <small class="text-muted mt-1 d-block">Formats acceptés : JPG, PNG. Max 2Mo.</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 border-start ps-md-4">
                        <label class="form-label">Dossier technique / Fiche d'artiste</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-file-pdf"></i></span>
                            <input type="file" name="technical_file" class="form-control @error('technical_file') is-invalid @enderror">
                        </div>
                        @error('technical_file')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                        @if(isset($event) && $event->technical_file)
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $event->technical_file) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-download me-1"></i> Télécharger le fichier actuel
                                </a>
                            </div>
                        @endif
                        <small class="text-muted mt-1 d-block">Formats acceptés : PDF, DOC, ZIP. Max 10Mo.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

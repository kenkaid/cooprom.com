<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
        <label>Titre du projet</label>
        <input type="text" name="title" placeholder="Ex: Clip Vidéo - Titre de la chanson" value="{{ old('title', $production->title ?? '') }}" required>
        @error('title') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
        <label>Type de production</label>
        <select name="type" class="custom-select-box" required>
            <option value="">Sélectionnez un type</option>
            @php
                $types = [
                    'clip' => 'Clip Vidéo',
                    'album' => 'Enregistrement Album/EP',
                    'reportage' => 'Publi-reportage',
                    'cinema' => 'Cinéma / Court-métrage',
                    'virtual_gallery' => 'Galerie Virtuelle',
                    'digital_work' => 'Œuvre Numérique',
                ];
                $currentType = old('type', $production->type ?? '');
            @endphp
            @foreach($types as $value => $label)
                <option value="{{ $value }}" {{ $currentType == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
        <label>Budget estimé (FCFA)</label>
        <input type="number" name="budget" placeholder="Facultatif" value="{{ old('budget', $production->budget ?? '') }}">
        @error('budget') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
        <label>Description du projet</label>
        <div id="quill-editor" style="height: 200px; font-size: 16px; background-color: #fff;">
            {!! old('description', isset($production) ? $production->description : '') !!}
        </div>
        <textarea name="description" id="description-input" class="d-none">{{ old('description', isset($production) ? $production->description : '') }}</textarea>
        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
        <label>Document joint (PDF, Word, TXT, PPT - Max 12Mo)</label>
        <div class="custom-file-upload">
            <input type="file" name="attachment_file" id="attachment_file" class="form-control" accept=".pdf,.doc,.docx,.txt,.ppt,.pptx">
            <div class="progress mt-2" style="height: 10px; display: none;">
                <div id="upload-progress" class="progress-bar progress-bar-striped progress-bar-animated bg_orange" role="progressbar" style="width: 0%"></div>
            </div>
            @if(isset($production) && $production->attachment)
                <div class="mt-2 small text-muted">
                    <i class="fa fa-paperclip"></i> Fichier actuel :
                    <a href="{{ asset('storage/' . $production->attachment) }}" target="_blank" class="text_orange">Voir le document</a>
                </div>
                <small class="text-muted d-block mt-1">Laissez vide pour conserver le document actuel.</small>
            @else
                <small class="text-muted">Vous pouvez joindre un dossier de présentation ou tout document utile.</small>
            @endif
        </div>
        @error('attachment_file') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>

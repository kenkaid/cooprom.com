<div class="row g-3">
    <div class="col-12">
        <label for="name" class="form-label">Nom de la Permission</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $permission->name ?? '') }}">
    </div>
    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $permission->description ?? '') }}</textarea>
    </div>
    <div class="col-12 text-center" id="submit_button_container">
        <button type="submit" class="btn btn-primary px-5">{{ isset($permission) ? 'Mettre à jour' : 'Enregistrer' }}</button>
    </div>
</div>

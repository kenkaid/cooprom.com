<div class="row g-3">
    <div class="col-12">
        <label for="name" class="form-label">Nom du Rôle</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $role->name ?? '') }}" required>
    </div>
    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $role->description ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="form-label mb-0">Permissions</label>
            <button type="button" class="btn btn-sm btn-outline-secondary" id="check-all-permissions">Tout cocher / décocher</button>
        </div>
        <div class="row" id="permissions-container">
            @foreach($permissions as $permission)
                <div class="col-md-3">
                    <div class="form-check">
                        <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm_{{ $permission->id }}"
                        {{ (isset($rolePermissions) && in_array($permission->name, $rolePermissions)) ? 'checked' : '' }}>
                        <label class="form-check-label" for="perm_{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAllBtn = document.getElementById('check-all-permissions');
            const checkboxes = document.querySelectorAll('.permission-checkbox');

            if (checkAllBtn) {
                checkAllBtn.addEventListener('click', function() {
                    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                    checkboxes.forEach(cb => {
                        cb.checked = !allChecked;
                    });
                });
            }
        });
    </script>
    <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary px-5">{{ isset($role) ? 'Mettre à jour' : 'Enregistrer' }}</button>
    </div>
</div>

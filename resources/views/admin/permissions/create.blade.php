@extends('admin.layouts.app')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Configuration</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">Permissions</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nouvelle Permission</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.permissions.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="generate_default" id="generate_default" value="1" {{ old('generate_default') ? 'checked' : '' }}>
                        <label class="form-check-label" for="generate_default">
                            Générer les permissions par défaut (CRUD) pour un module
                        </label>
                    </div>
                </div>
            </div>

            <div id="single_permission_fields">
                @include('admin.permissions._form')
            </div>

            <div id="default_permissions_fields" style="display: none;">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="module_name" class="form-label">Nom du Module (ex: users, posts)</label>
                        <input type="text" name="module_name" class="form-control" id="module_name" value="{{ old('module_name') }}" placeholder="Entrez le nom du module">
                        <small class="text-muted">Cela générera : list-nom, create-nom, edit-nom, delete-nom</small>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary px-5">Générer les Permissions</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('extra_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const generateDefaultCheckbox = document.getElementById('generate_default');
        const singlePermissionFields = document.getElementById('single_permission_fields');
        const defaultPermissionsFields = document.getElementById('default_permissions_fields');
        const nameInput = document.getElementById('name');
        const moduleNameInput = document.getElementById('module_name');

        function toggleFields() {
            if (generateDefaultCheckbox.checked) {
                singlePermissionFields.style.display = 'none';
                defaultPermissionsFields.style.display = 'block';
                nameInput.removeAttribute('required');
                moduleNameInput.setAttribute('required', 'required');
            } else {
                singlePermissionFields.style.display = 'block';
                defaultPermissionsFields.style.display = 'none';
                nameInput.setAttribute('required', 'required');
                moduleNameInput.removeAttribute('required');
                // S'assurer que le bouton d'enregistrement est visible dans le formulaire inclus
                const singleSubmit = singlePermissionFields.querySelector('button[type="submit"]');
                if (singleSubmit) singleSubmit.style.display = 'block';
            }
        }

        generateDefaultCheckbox.addEventListener('change', toggleFields);
        toggleFields(); // Initial state
    });
</script>
@endsection

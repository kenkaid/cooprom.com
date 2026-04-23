@extends('admin.layouts.app')

@section('title', 'Programmer un Rendez-vous - COOPROM Admin')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Agenda</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.appointments.index') }}">Rendez-vous</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nouveau</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Programmer un nouveau rendez-vous</h5>
                    <form action="{{ route('admin.appointments.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Adhérent / Membre</label>
                                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="">Sélectionner un membre...</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} {{ $user->last_name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Lier à un dossier / contrat</label>
                                <select name="appointmentable_info" id="appointmentable_info" class="form-select @error('appointmentable_id') is-invalid @enderror" required disabled>
                                    <option value="">Choisissez d'abord un membre...</option>
                                </select>
                                <input type="hidden" name="appointmentable_type" id="appointmentable_type">
                                <input type="hidden" name="appointmentable_id" id="appointmentable_id">
                                @error('appointmentable_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Objet du rendez-vous</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Ex: Remise des documents physiques" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Date et Heure</label>
                                <input type="datetime-local" name="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror" value="{{ old('appointment_date') }}" required>
                                @error('appointment_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Lieu</label>
                                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', 'Siège COOPROM') }}" placeholder="Ex: Bureaux COOPROM ou Lien Visio">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Description / Instructions</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Détails supplémentaires pour l'adhérent...">{{ old('description') }}</textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary px-5">Enregistrer le rendez-vous</button>
                                <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-secondary px-5">Annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#user_id').on('change', function() {
            var userId = $(this).val();
            var $select = $('#appointmentable_info');

            if (userId) {
                $select.prop('disabled', true).html('<option>Chargement...</option>');

                $.ajax({
                    url: '/cp-admin-access/appointments/related-items/' + userId,
                    type: 'GET',
                    success: function(data) {
                        $select.prop('disabled', false).html('<option value="">Sélectionner un contrat ou dossier...</option>');
                        $.each(data, function(index, item) {
                            $select.append('<option value="' + item.id + '" data-type="' + item.type + '">' + item.label + '</option>');
                        });
                    }
                });
            } else {
                $select.prop('disabled', true).html('<option value="">Choisissez d\'abord un membre...</option>');
            }
        });

        $('#appointmentable_info').on('change', function() {
            var id = $(this).val();
            var type = $(this).find(':selected').data('type');
            $('#appointmentable_id').val(id);
            $('#appointmentable_type').val(type);
        });
    });
</script>
@endsection

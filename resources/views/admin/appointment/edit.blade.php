@extends('admin.layouts.app')

@section('title', 'Modifier le Rendez-vous - COOPROM Admin')

@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Agenda</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.appointments.index') }}">Rendez-vous</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Modifier le rendez-vous</h5>
                    <form action="{{ route('admin.appointments.update', $appointment->uuid) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Adhérent / Membre</label>
                                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $appointment->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} {{ $user->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Statut</label>
                                <select name="status" class="form-select" required>
                                    <option value="scheduled" {{ $appointment->status == 'scheduled' ? 'selected' : '' }}>Programmé</option>
                                    <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Terminé</option>
                                    <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Lier à un dossier / contrat</label>
                                <select name="appointmentable_info" id="appointmentable_info" class="form-select" required>
                                    <option value="{{ $appointment->appointmentable_id }}" data-type="{{ $appointment->appointmentable_type }}">
                                        {{ class_basename($appointment->appointmentable_type) }}:
                                        {{ $appointment->appointmentable->title ?? ($appointment->appointmentable->country ?? $appointment->appointmentable_id) }}
                                    </option>
                                </select>
                                <input type="hidden" name="appointmentable_type" id="appointmentable_type" value="{{ $appointment->appointmentable_type }}">
                                <input type="hidden" name="appointmentable_id" id="appointmentable_id" value="{{ $appointment->appointmentable_id }}">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Objet du rendez-vous</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $appointment->title) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Date et Heure</label>
                                <input type="datetime-local" name="appointment_date" class="form-control" value="{{ old('appointment_date', $appointment->appointment_date->format('Y-m-d\TH:i')) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Lieu</label>
                                <input type="text" name="location" class="form-control" value="{{ old('location', $appointment->location) }}">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Description / Instructions</label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description', $appointment->description) }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Note administrative (interne)</label>
                                <textarea name="admin_note" class="form-control" rows="2">{{ old('admin_note', $appointment->admin_note) }}</textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-warning px-5">Mettre à jour</button>
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

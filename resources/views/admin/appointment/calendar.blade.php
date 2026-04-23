@extends('admin.layouts.app')

@section('title', 'Agenda des Rendez-vous - Admin')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Applications</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Agenda des Rendez-vous</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#appointmentModal">
                <i class="bi bi-plus-circle me-1"></i> Nouveau RDV
            </button>
        </div>
    </div>
</div>
<!--end breadcrumb-->

<div class="card">
    <div class="card-body">
        <div id='calendar'></div>
    </div>
</div>

<!-- Appointment Modal -->
<div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="appointmentForm">
                @csrf
                <input type="hidden" name="id" id="appointment_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentModalLabel">Programmer un Rendez-vous</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Adhérent <span class="text-danger">*</span></label>
                            <select name="user_id" id="user_id" class="form-select" required>
                                <option value="">Sélectionner un adhérent</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->uuid }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Dossier lié <span class="text-danger">*</span></label>
                            <select name="related_item" id="related_item" class="form-select" required disabled>
                                <option value="">Choisir un adhérent d'abord</option>
                            </select>
                            <input type="hidden" name="appointmentable_type" id="appointmentable_type">
                            <input type="hidden" name="appointmentable_id" id="appointmentable_id">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Titre du rendez-vous <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Ex: Entretien pour visa" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date et Heure <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lieu</label>
                            <input type="text" name="location" id="location" class="form-control" placeholder="Ex: Bureaux COOPROM">
                        </div>
                        <div class="col-md-12" id="status_container" style="display: none;">
                            <label class="form-label">Statut</label>
                            <select name="status" id="status" class="form-select">
                                <option value="scheduled">Programmé</option>
                                <option value="completed">Terminé</option>
                                <option value="cancelled">Annulé</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Description / Instructions</label>
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-12" id="admin_note_container" style="display: none;">
                            <label class="form-label">Note administrative (interne)</label>
                            <textarea name="admin_note" id="admin_note" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger me-auto" id="btnDelete" style="display: none;">Supprimer</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="btnSave">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra_js')
<link href="{{ asset('assets/admin/plugins/fullcalendar/css/main.min.css') }}" rel="stylesheet" />
<script src="{{ asset('assets/admin/plugins/fullcalendar/js/main.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var appointmentModal = new bootstrap.Modal(document.getElementById('appointmentModal'));
        var appointmentForm = document.getElementById('appointmentForm');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            locale: 'fr',
            initialView: 'dayGridMonth',
            navLinks: true,
            selectable: true,
            nowIndicator: true,
            dayMaxEvents: true,
            editable: true,
            businessHours: true,
            events: "{{ route('admin.appointments.list') }}",

            select: function(info) {
                resetForm();
                // Set date to selected start
                let date = new Date(info.start);
                date.setMinutes(date.getMinutes() - date.getTimezoneOffset());
                document.getElementById('appointment_date').value = date.toISOString().slice(0, 16);

                document.getElementById('appointmentModalLabel').innerText = "Nouveau Rendez-vous";
                appointmentModal.show();
            },

            eventClick: function(info) {
                loadAppointment(info.event.id);
            },

            eventDrop: function(info) {
                updateAppointmentDate(info.event);
            }
        });

        calendar.render();

        // Handle User change to load related items
        document.getElementById('user_id').addEventListener('change', function() {
            let userId = this.value;
            let relatedSelect = document.getElementById('related_item');

            // On mémorise les valeurs pré-remplies si elles existent
            let preType = document.getElementById('appointmentable_type').value;
            let preId = document.getElementById('appointmentable_id').value;

            if (!userId) {
                relatedSelect.innerHTML = '<option value="">Choisir un adhérent d\'abord</option>';
                relatedSelect.disabled = true;
                return;
            }

            fetch(`/cp-admin-access/appointments/related-items/${userId}`)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    console.log("Related items loaded:", data);
                    relatedSelect.innerHTML = '<option value="">Sélectionner un dossier</option>';

                    if (data.length === 0) {
                        relatedSelect.innerHTML = '<option value="">Aucun dossier (Production ou Visa) trouvé</option>';
                        relatedSelect.disabled = true;
                    } else {
                        data.forEach(item => {
                            relatedSelect.innerHTML += `<option value="${item.id}" data-type="${item.type}">${item.label}</option>`;
                        });

                        // Force removal of disabled attribute
                        relatedSelect.disabled = false;
                        relatedSelect.removeAttribute('disabled');
                    }

                    // Try to select the current item (editing or URL params)
                    let type = document.getElementById('appointmentable_type').value;
                    let id = document.getElementById('appointmentable_id').value;
                    if (type && id) {
                        for (let option of relatedSelect.options) {
                            if (option.value === id && option.getAttribute('data-type') === type) {
                                option.selected = true;
                                break;
                            }
                        }
                        // Sélectionner l'élément pré-rempli si applicable
                        if (preId && preType) {
                            for (let option of relatedSelect.options) {
                                if (option.value == preId && option.getAttribute('data-type') == preType) {
                                    option.selected = true;
                                    break;
                                }
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    relatedSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                });
        });

        document.getElementById('related_item').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            document.getElementById('appointmentable_type').value = selectedOption.getAttribute('data-type');
            document.getElementById('appointmentable_id').value = selectedOption.value;
        });

        appointmentForm.addEventListener('submit', function(e) {
            e.preventDefault();

            let id = document.getElementById('appointment_id').value;
            let url = id ? `/cp-admin-access/appointments/${id}` : "{{ route('admin.appointments.store') }}";
            let method = id ? 'PUT' : 'POST';

            let formData = new FormData(this);
            let data = Object.fromEntries(formData.entries());

            // Add method spoofing for PUT
            if (id) data._method = 'PUT';

                    fetch(url, {
                method: 'POST', // Use POST with _method spoofing for PUT
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    appointmentModal.hide();
                    calendar.refetchEvents();
                    Swal.fire('Succès', data.message, 'success');
                } else {
                    let errorMessage = 'Veuillez vérifier les champs du formulaire.';
                    if (data.errors) {
                        errorMessage = Object.values(data.errors).flat().join('<br>');
                    }
                    Swal.fire({
                        title: 'Erreur',
                        html: errorMessage,
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Erreur', 'Une erreur est survenue lors de l\'enregistrement.', 'error');
            });
        });

        document.getElementById('btnDelete').addEventListener('click', function() {
            let id = document.getElementById('appointment_id').value;
            if (!id) return;

            Swal.fire({
                title: 'Supprimer ce rendez-vous ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/cp-admin-access/appointments/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            appointmentModal.hide();
                            calendar.refetchEvents();
                            Swal.fire('Supprimé !', data.message, 'success');
                        }
                    });
                }
            });
        });

        function loadAppointment(id) {
            fetch(`/cp-admin-access/appointments/${id}/edit`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.json())
            .then(data => {
                let app = data.appointment;
                resetForm();

                document.getElementById('appointment_id').value = app.id;
                document.getElementById('user_id').value = app.user ? app.user.uuid : '';
                document.getElementById('title').value = app.title;
                document.getElementById('location').value = app.location;
                document.getElementById('description').value = app.description;
                document.getElementById('status').value = app.status;
                document.getElementById('admin_note').value = app.admin_note;

                // Format date for datetime-local
                let date = new Date(app.appointment_date);
                date.setMinutes(date.getMinutes() - date.getTimezoneOffset());
                document.getElementById('appointment_date').value = date.toISOString().slice(0, 16);

                document.getElementById('appointmentable_type').value = app.appointmentable_type;
                document.getElementById('appointmentable_id').value = app.appointmentable_id;

                // Show status and admin note
                document.getElementById('status_container').style.display = 'block';
                document.getElementById('admin_note_container').style.display = 'block';
                document.getElementById('btnDelete').style.display = 'block';

                document.getElementById('appointmentModalLabel').innerText = "Modifier le Rendez-vous";

                // Trigger user change to load items
                let event = new Event('change');
                document.getElementById('user_id').dispatchEvent(event);

                appointmentModal.show();
            });
        }

        function updateAppointmentDate(event) {
            let id = event.id;
            let newDate = event.start.toISOString();

            fetch(`/cp-admin-access/appointments/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    _method: 'PUT',
                    appointment_date: newDate,
                    // Send other required fields
                    user_id: event.extendedProps.userId,
                    title: event.title.split(' : ').pop(), // Remove user name prefix
                    appointmentable_type: event.extendedProps.type,
                    appointmentable_id: event.extendedProps.type_id,
                    status: event.extendedProps.status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Lobibox.notify('success', {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: 'bi bi-check-circle-fill',
                        msg: 'Date mise à jour.'
                    });
                }
            });
        }

        function resetForm() {
            appointmentForm.reset();
            document.getElementById('appointment_id').value = '';
            document.getElementById('appointmentable_type').value = '';
            document.getElementById('appointmentable_id').value = '';
            document.getElementById('related_item').innerHTML = '<option value="">Choisir un adhérent d\'abord</option>';
            document.getElementById('related_item').disabled = true;
            document.getElementById('status_container').style.display = 'none';
            document.getElementById('admin_note_container').style.display = 'none';
            document.getElementById('btnDelete').style.display = 'none';
            document.getElementById('appointmentModalLabel').innerText = "Programmer un Rendez-vous";
        }

        // Check for URL parameters to auto-open modal
        const urlParamsSearch = new URLSearchParams(window.location.search);
        if (urlParamsSearch.get('action') === 'schedule' && urlParamsSearch.get('user_id')) {
            let preFillUserId = urlParamsSearch.get('user_id');
            let contractId = urlParamsSearch.get('contract_id');
            let typeParam = urlParamsSearch.get('type') || "App\\Models\\Contract";

            resetForm();
            const userSelect = document.getElementById('user_id');

            // Trouver l'option par ID ou UUID
            for (let i = 0; i < userSelect.options.length; i++) {
                if (userSelect.options[i].value == preFillUserId) {
                    userSelect.selectedIndex = i;
                    break;
                }
            }

            if (contractId) {
                document.getElementById('appointmentable_type').value = type;
                document.getElementById('appointmentable_id').value = contractId;
                document.getElementById('title').value = "Entretien suite à signature de contrat";
            } else {
                document.getElementById('title').value = "Rendez-vous de suivi";
            }

            // Déclencher le chargement des éléments liés
            if (userSelect.selectedIndex > 0) {
                userSelect.dispatchEvent(new Event('change'));
            }

            appointmentModal.show();
        }
    });
</script>

<style>
    .fc-event {
        cursor: pointer;
        background-color: #87CEEB !important;
        border-color: #87CEEB !important;
        color: #000000 !important;
    }
    .fc-event-title {
        font-weight: bold !important;
        color: #000000 !important;
    }
    .fc-event-time {
        font-weight: bold !important;
        color: #000000 !important;
    }
</style>
@endsection

<?php

namespace App\Services\Admin;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Contract;
use App\Models\VisaApplication;
use App\Models\Production;
use App\Notifications\MemberGenericNotification;
use App\Repositories\AppointmentRepository;
use Illuminate\Support\Facades\DB;

class AppointmentService
{
    /**
     * @var AppointmentRepository
     */
    protected $appointmentRepository;

    /**
     * AppointmentService constructor.
     *
     * @param AppointmentRepository $appointmentRepository
     */
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * Store a new appointment and notify the user.
     *
     * @param array $data
     * @return Appointment
     */
    public function storeAppointment(array $data): Appointment
    {
        return DB::transaction(function () use ($data) {
            $appointment = $this->appointmentRepository->create($data);

            // Notification au membre
            $user = User::find($data['user_id']);
            $user->notify(new MemberGenericNotification([
                'title' => 'Nouveau rendez-vous programmé',
                'message' => "Un nouveau rendez-vous a été fixé pour le " . $appointment->appointment_date->format('d/m/Y à H:i') . " concernant : " . $appointment->title,
                'icon' => 'fa-calendar-check',
                'url' => route('member.appointments.index'),
                'buttonText' => 'Voir mes rendez-vous'
            ]));

            return $appointment;
        });
    }

    /**
     * Update an appointment and notify the user if necessary.
     *
     * @param Appointment $appointment
     * @param array $data
     * @return Appointment
     */
    public function updateAppointment(Appointment $appointment, array $data): Appointment
    {
        return DB::transaction(function () use ($appointment, $data) {
            $oldDate = $appointment->appointment_date;
            $this->appointmentRepository->update($appointment, $data);

            // Notification si la date a changé ou si c'est annulé
            if ($oldDate->format('Y-m-d H:i') != $appointment->appointment_date->format('Y-m-d H:i') || $appointment->status == 'cancelled') {
                $msg = $appointment->status == 'cancelled'
                    ? "Votre rendez-vous du " . $appointment->appointment_date->format('d/m/Y') . " a été ANNULÉ."
                    : "Votre rendez-vous a été déplacé au " . $appointment->appointment_date->format('d/m/Y à H:i') . ".";

                $appointment->user->notify(new MemberGenericNotification([
                    'title' => $appointment->status == 'cancelled' ? 'Rendez-vous annulé' : 'Rendez-vous modifié',
                    'message' => $msg,
                    'icon' => $appointment->status == 'cancelled' ? 'fa-calendar-times' : 'fa-calendar-alt',
                    'url' => route('member.appointments.index'),
                    'buttonText' => 'Consulter mon agenda'
                ]));
            }

            return $appointment;
        });
    }

    /**
     * Get appointments formatted for FullCalendar.
     *
     * @return array
     */
    public function getCalendarEvents(): array
    {
        $appointments = $this->appointmentRepository->getAllForCalendar();

        $events = [];

        foreach ($appointments as $appointment) {
            $events[] = [
                'id' => $appointment->id,
                'title' => ($appointment->user ? $appointment->user->name . ' : ' : '') . $appointment->title,
                'start' => $appointment->appointment_date->toIso8601String(),
                'end' => $appointment->appointment_date->addHours(1)->toIso8601String(), // Par défaut 1h si pas d'heure de fin
                'description' => $appointment->description,
                'location' => $appointment->location,
                'status' => $appointment->status,
                'userName' => $appointment->user ? $appointment->user->name : 'N/A',
                'className' => $this->getStatusColor($appointment->status),
                'extendedProps' => [
                    'userId' => $appointment->user ? $appointment->user->uuid : null,
                    'status' => $appointment->status,
                    'location' => $appointment->location,
                    'description' => $appointment->description,
                    'type' => $appointment->appointmentable_type,
                    'type_id' => $appointment->appointmentable_id,
                ]
            ];
        }

        return $events;
    }

    /**
     * Get CSS class based on status.
     *
     * @param string $status
     * @return string
     */
    private function getStatusColor(string $status): string
    {
        switch ($status) {
            case 'completed':
                return 'bg-success';
            case 'cancelled':
                return 'bg-danger';
            case 'scheduled':
            default:
                return 'bg-primary';
        }
    }

    /**
     * Get related items for a user.
     *
     * @param int $userId
     * @return array
     */
    public function getRelatedItems(int $userId): array
    {
        $visas = VisaApplication::where('user_id', $userId)->get(['id', 'country', 'visa_type', 'status']);
        $productions = Production::where('user_id', $userId)->get(['id', 'title', 'status']);

        $items = [];

        foreach ($visas as $visa) {
            $items[] = [
                'id' => $visa->id,
                'type' => VisaApplication::class,
                'label' => "Visa : " . $visa->country . " (" . $visa->visa_type . ") - Statut : " . $visa->status
            ];
        }

        foreach ($productions as $production) {
            $items[] = [
                'id' => $production->id,
                'type' => Production::class,
                'label' => "Production : " . $production->title . " - Statut : " . $production->status
            ];
        }

        return $items;
    }
}

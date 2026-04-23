<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use App\Services\Admin\AppointmentService;
use App\Repositories\AppointmentRepository;
use App\Http\Requests\AppointmentRequest;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * @var AppointmentService
     */
    protected $appointmentService;

    /**
     * @var AppointmentRepository
     */
    protected $appointmentRepository;

    /**
     * AppointmentController constructor.
     *
     * @param AppointmentService $appointmentService
     * @param AppointmentRepository $appointmentRepository
     */
    public function __construct(AppointmentService $appointmentService, AppointmentRepository $appointmentRepository)
    {
        $this->appointmentService = $appointmentService;
        $this->appointmentRepository = $appointmentRepository;
    }

    public function index()
    {
        return $this->calendar();
    }

    public function calendar()
    {
        $users = User::role('adhérent')->get();
        return view('admin.appointment.calendar', compact('users'));
    }

    public function listEvents()
    {
        $events = $this->appointmentService->getCalendarEvents();
        return response()->json($events);
    }

    public function create()
    {
        $users = User::role('adhérent')->get();
        return view('admin.appointment.create', compact('users'));
    }

    public function store(AppointmentRequest $request)
    {
        $data = $request->validated();

        // Convert UUID to ID if necessary
        if (isset($data['user_id']) && !is_numeric($data['user_id'])) {
            $user = User::where('uuid', $data['user_id'])->first();
            if ($user) {
                $data['user_id'] = $user->id;
            } else {
                return response()->json(['success' => false, 'errors' => ['user_id' => ['Adhérent introuvable.']]], 422);
            }
        }

        $appointment = $this->appointmentService->storeAppointment($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Rendez-vous programmé avec succès.',
                'appointment' => $appointment
            ]);
        }

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Rendez-vous programmé avec succès.');
    }

    public function edit(Appointment $appointment)
    {
        $users = User::role('adhérent')->get();

        if (request()->ajax()) {
            $appointment->load('user');
            return response()->json([
                'appointment' => $appointment,
                'related_items' => $this->appointmentService->getRelatedItems($appointment->user_id)
            ]);
        }

        return view('admin.appointment.edit', compact('appointment', 'users'));
    }

    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $data = $request->validated();

        // Convert UUID to ID if necessary
        if (isset($data['user_id']) && !is_numeric($data['user_id'])) {
            $user = User::where('uuid', $data['user_id'])->first();
            if ($user) {
                $data['user_id'] = $user->id;
            } else {
                return response()->json(['success' => false, 'errors' => ['user_id' => ['Adhérent introuvable.']]], 422);
            }
        }

        $this->appointmentService->updateAppointment($appointment, $data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Rendez-vous mis à jour avec succès.',
                'appointment' => $appointment
            ]);
        }

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Rendez-vous mis à jour avec succès.');
    }

    public function destroy(Appointment $appointment)
    {
        $this->appointmentRepository->delete($appointment);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Rendez-vous supprimé.'
            ]);
        }

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Rendez-vous supprimé.');
    }

    public function getRelatedItems($uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        $items = $this->appointmentService->getRelatedItems($user->id);

        return response()->json($items);
    }
}

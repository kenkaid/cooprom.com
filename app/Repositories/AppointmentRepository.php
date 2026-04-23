<?php

namespace App\Repositories;

use App\Models\Appointment;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AppointmentRepository
{
    /**
     * @var Appointment
     */
    protected $model;

    /**
     * AppointmentRepository constructor.
     *
     * @param Appointment $appointment
     */
    public function __construct(Appointment $appointment)
    {
        $this->model = $appointment;
    }

    /**
     * Get all appointments with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 20): LengthAwarePaginator
    {
        return $this->model->with(['user', 'appointmentable'])
            ->orderBy('appointment_date', 'asc')
            ->paginate($perPage);
    }

    /**
     * Get all appointments for a specific user with pagination.
     *
     * @param int $userId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginateForUser(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->where('user_id', $userId)
            ->with(['appointmentable'])
            ->orderBy('appointment_date', 'desc')
            ->paginate($perPage);
    }

    /**
     * Find an appointment by its ID.
     *
     * @param int $id
     * @return Appointment|null
     */
    public function find(int $id): ?Appointment
    {
        return $this->model->find($id);
    }

    /**
     * Create a new appointment.
     *
     * @param array $data
     * @return Appointment
     */
    public function create(array $data): Appointment
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing appointment.
     *
     * @param Appointment $appointment
     * @param array $data
     * @return bool
     */
    public function update(Appointment $appointment, array $data): bool
    {
        return $appointment->update($data);
    }

    /**
     * Get all appointments for calendar.
     *
     * @return Collection
     */
    public function getAllForCalendar(): Collection
    {
        return $this->model->with(['user', 'appointmentable'])->get();
    }

    /**
     * Delete an appointment.
     *
     * @param Appointment $appointment
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Appointment $appointment): ?bool
    {
        return $appointment->delete();
    }
}

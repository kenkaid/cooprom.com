<?php

namespace App\Http\Controllers\Front\Member;

use App\Http\Controllers\Controller;
use App\Repositories\AppointmentRepository;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * @var AppointmentRepository
     */
    protected $appointmentRepository;

    /**
     * AppointmentController constructor.
     *
     * @param AppointmentRepository $appointmentRepository
     */
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function index()
    {
        $appointments = $this->appointmentRepository->paginateForUser(Auth::id(), 10);

        return view('front.member.appointments.index', compact('appointments'));
    }
}

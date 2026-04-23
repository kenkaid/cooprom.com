<?php

namespace App\Repositories;

use App\Models\VisaApplication;
use App\Models\Travel;

class TravelRepository
{
    public function getVisaApplicationsForUser($userId)
    {
        return VisaApplication::where('user_id', $userId)->with('travel')->latest()->get();
    }

    public function getPlannedTravels()
    {
        return Travel::where('status', 'planned')->get();
    }

    public function findTravelByUuid($uuid)
    {
        return Travel::where('uuid', $uuid)->first();
    }

    public function createVisaApplication(array $data)
    {
        return VisaApplication::create($data);
    }
    public function findVisaApplicationByUuid($uuid)
    {
        return VisaApplication::where('uuid', $uuid)->first();
    }

    public function updateVisaApplication(VisaApplication $visaApplication, array $data)
    {
        return $visaApplication->update($data);
    }

    public function deleteVisaApplication(VisaApplication $visaApplication)
    {
        return $visaApplication->delete();
    }
}

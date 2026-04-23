<?php

namespace App\Repositories;

use App\Models\HealthInsuranceDetail;

class HealthInsuranceRepository
{
    public function getAll()
    {
        return HealthInsuranceDetail::latest()->get();
    }

    public function getActive()
    {
        return HealthInsuranceDetail::where('is_active', true)->latest()->get();
    }

    public function findById($id)
    {
        return HealthInsuranceDetail::findOrFail($id);
    }

    public function create(array $data)
    {
        return HealthInsuranceDetail::create($data);
    }

    public function update(HealthInsuranceDetail $insurance, array $data)
    {
        $insurance->update($data);
        return $insurance;
    }

    public function delete(HealthInsuranceDetail $insurance)
    {
        return $insurance->delete();
    }
}

<?php

namespace App\Repositories;

use App\Models\RetirementSimulation;

class RetirementRepository
{
    public function getAll()
    {
        return RetirementSimulation::with('user')->latest()->get();
    }

    public function findById($id)
    {
        return RetirementSimulation::findOrFail($id);
    }

    public function create(array $data)
    {
        return RetirementSimulation::create($data);
    }

    public function update(RetirementSimulation $simulation, array $data)
    {
        $simulation->update($data);
        return $simulation;
    }

    public function delete(RetirementSimulation $simulation)
    {
        return $simulation->delete();
    }
}

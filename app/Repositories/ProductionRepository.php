<?php

namespace App\Repositories;

use App\Models\Production;
use Illuminate\Support\Facades\Auth;

class ProductionRepository
{
    public function getForUser($userId)
    {
        return Production::where('user_id', $userId)->latest()->get();
    }

    public function create(array $data)
    {
        return Production::create($data);
    }

    public function update(Production $production, array $data)
    {
        $production->update($data);
        return $production;
    }

    public function delete(Production $production)
    {
        return $production->delete();
    }

    public function findByIdForUser($id, $userId)
    {
        return Production::where('id', $id)->where('user_id', $userId)->first();
    }
}

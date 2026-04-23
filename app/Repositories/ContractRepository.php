<?php

namespace App\Repositories;

use App\Models\Contract;

class ContractRepository
{
    public function getForUser($userId)
    {
        return Contract::where('user_id', $userId)->latest()->get();
    }

    public function findByIdForUser($id, $userId)
    {
        return Contract::where('id', $id)->where('user_id', $userId)->first();
    }
}

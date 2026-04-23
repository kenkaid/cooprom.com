<?php

namespace App\Repositories;

use App\Models\SolidarityFundRequest;

class SolidarityFundRepository
{
    public function getAll()
    {
        return SolidarityFundRequest::with('user')->latest()->get();
    }

    public function findById($id)
    {
        return SolidarityFundRequest::findOrFail($id);
    }

    public function create(array $data)
    {
        return SolidarityFundRequest::create($data);
    }

    public function update(SolidarityFundRequest $request, array $data)
    {
        $request->update($data);
        return $request;
    }

    public function delete(SolidarityFundRequest $request)
    {
        return $request->delete();
    }
}

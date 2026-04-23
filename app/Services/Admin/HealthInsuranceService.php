<?php

namespace App\Services\Admin;

use App\Repositories\HealthInsuranceRepository;
use App\Models\HealthInsuranceDetail;

class HealthInsuranceService
{
    protected $repository;

    public function __construct(HealthInsuranceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(HealthInsuranceDetail $insurance, array $data)
    {
        return $this->repository->update($insurance, $data);
    }

    public function delete(HealthInsuranceDetail $insurance)
    {
        return $this->repository->delete($insurance);
    }
}

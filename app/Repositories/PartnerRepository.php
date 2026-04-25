<?php

namespace App\Repositories;

use App\Models\Partner;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PartnerRepository
{
    /**
     * @var Partner
     */
    protected $model;

    /**
     * PartnerRepository constructor.
     *
     * @param Partner $partner
     */
    public function __construct(Partner $partner)
    {
        $this->model = $partner;
    }

    /**
     * Get all partners with pagination.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 20): LengthAwarePaginator
    {
        return $this->model->orderBy('name', 'asc')->paginate($perPage);
    }

    /**
     * Find a partner by its ID.
     *
     * @param int $id
     * @return Partner|null
     */
    public function find(int $id): ?Partner
    {
        return $this->model->find($id);
    }

    /**
     * Find a partner by its UUID.
     *
     * @param string $uuid
     * @return Partner|null
     */
    public function findByUuid(string $uuid): ?Partner
    {
        return $this->model->where('uuid', $uuid)->first();
    }

    /**
     * Create a new partner.
     *
     * @param array $data
     * @return Partner
     */
    public function create(array $data): Partner
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing partner.
     *
     * @param Partner $partner
     * @param array $data
     * @return bool
     */
    public function update(Partner $partner, array $data): bool
    {
        return $partner->update($data);
    }

    /**
     * Delete a partner.
     *
     * @param Partner $partner
     * @return bool|null
     */
    public function delete(Partner $partner): ?bool
    {
        return $partner->delete();
    }

    /**
     * Get all partners.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->orderBy('name', 'asc')->get();
    }
}

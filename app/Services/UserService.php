<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    public function createUser(array $data)
    {
        $data['uuid'] = (string) Str::uuid();
        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->create($data);
    }

    public function getUser($uuid)
    {
        return $this->userRepository->findByUuid($uuid);
    }

    public function updateUser($uuid, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->userRepository->update($uuid, $data);
    }

    public function deleteUser($uuid)
    {
        return $this->userRepository->delete($uuid);
    }
}

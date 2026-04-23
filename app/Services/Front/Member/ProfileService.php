<?php

namespace App\Services\Front\Member;

use App\Repositories\ProfileRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    protected $repository;

    public function __construct(ProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getSectors()
    {
        return $this->repository->getAllSectors();
    }

    public function updateProfile(User $user, array $data)
    {
        if (isset($data['photo'])) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $data['photo'] = $data['photo']->store('users/photos', 'public');
        }

        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->repository->update($user, $data);
    }
}

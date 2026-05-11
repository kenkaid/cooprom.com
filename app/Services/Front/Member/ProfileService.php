<?php

namespace App\Services\Front\Member;

use App\Repositories\ProfileRepository;
use App\Models\Attribute;
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

    public function getAttributesForUser(User $user)
    {
        return Attribute::where(function ($query) use ($user) {
            $query->whereNull('allowed_roles')
                ->orWhere('allowed_roles', 'LIKE', '%' . $user->role_type . '%');
        })
        ->where(function ($query) use ($user) {
            $query->where('target_type', 'global')
                ->orWhere(function ($q) use ($user) {
                    $q->where('target_type', 'sector')
                        ->whereHas('culturalSectors', function ($sq) use ($user) {
                            $sq->where('cultural_sectors.id', $user->cultural_sector_id);
                        });
                });
        })
        ->orderBy('order_column')
        ->get();
    }

    public function updateProfile(User $user, array $data)
    {
        if (isset($data['photo'])) {
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $data['photo'] = $data['photo']->store('users/photos', 'public');
        }

        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user = $this->repository->update($user, $data);

        // Handle EAV Attributes
        if (isset($data['attributes']) && is_array($data['attributes'])) {
            foreach ($data['attributes'] as $attributeUuid => $value) {
                $attribute = Attribute::where('uuid', $attributeUuid)->first();
                if ($attribute) {
                    $user->attributeValues()->updateOrCreate(
                        ['attribute_id' => $attribute->id],
                        ['value' => is_array($value) ? json_encode($value) : $value]
                    );
                }
            }
        }

        return $user;
    }
}

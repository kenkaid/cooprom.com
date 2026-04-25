<?php

namespace App\Services\Admin;

use App\Models\Partner;
use App\Repositories\PartnerRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PartnerService
{
    /**
     * @var PartnerRepository
     */
    protected $partnerRepository;

    /**
     * PartnerService constructor.
     *
     * @param PartnerRepository $partnerRepository
     */
    public function __construct(PartnerRepository $partnerRepository)
    {
        $this->partnerRepository = $partnerRepository;
    }

    /**
     * Store a new partner.
     *
     * @param array $data
     * @param UploadedFile|null $logo
     * @return Partner
     */
    public function storePartner(array $data, UploadedFile $logo = null): Partner
    {
        if ($logo) {
            $data['logo'] = $this->handleLogoUpload($logo);
        }

        return $this->partnerRepository->create($data);
    }

    /**
     * Update a partner.
     *
     * @param Partner $partner
     * @param array $data
     * @param UploadedFile|null $logo
     * @return Partner
     */
    public function updatePartner(Partner $partner, array $data, UploadedFile $logo = null): Partner
    {
        if ($logo) {
            // Supprimer l'ancien logo si ce n'est pas celui par défaut
            if ($partner->logo && $partner->logo !== 'default.png') {
                Storage::disk('public')->delete('partners/' . $partner->logo);
            }
            $data['logo'] = $this->handleLogoUpload($logo);
        }

        $this->partnerRepository->update($partner, $data);

        return $partner;
    }

    /**
     * Handle logo upload.
     *
     * @param UploadedFile $file
     * @return string
     */
    protected function handleLogoUpload(UploadedFile $file): string
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('partners', $filename, 'public');
        return $filename;
    }

    /**
     * Delete a partner.
     *
     * @param Partner $partner
     * @return bool|null
     */
    public function deletePartner(Partner $partner): ?bool
    {
        // On garde le fichier logo car c'est un soft delete, ou on le supprime si on veut faire propre.
        // Ici on suit la logique de soft delete.
        return $this->partnerRepository->delete($partner);
    }
}

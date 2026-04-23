<?php

namespace Database\Seeders;

use App\Models\CulturalSector;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CulturalSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectors = [
            'ACTEURS DE CINÉMA',
            'ARRANGEURS',
            'ARTISTES CHANTEUR',
            'ARTISTES CHORISTE',
            'ARTISTES COMÉDIEN',
            'ARTISTES DANSEURS',
            'ARTISTES MUSICIENS',
            'ARTS VISUELS',
            'ASSOCIATIONS ET ONG CULTURELLES',
            'COMPAGNIES ET ENSEMBLE ARTISTIQUE',
            'ECRIVAINS',
            'ENTREPRISES CULTURELLES PRIVÉE',
            'MANAGER D\'ARTISTES',
            'MODE ET STYLISME',
            'PRODUCTEURS',
            'RÉALISATEURS',
            'TECHNICIEN SON ET LUMIÈRE',
            'ACCESSOIRISTE DESIGNER',
        ];

        foreach ($sectors as $sector) {
            CulturalSector::updateOrCreate(
                ['name' => $sector],
                [
                    'uuid' => (string) Str::uuid(),
                    'user_created_id' => 1,
                    'user_updated_id' => 1,
                ]
            );
        }
    }
}

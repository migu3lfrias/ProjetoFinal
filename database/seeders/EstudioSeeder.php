<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estudio;

class EstudioSeeder extends Seeder
{
    public function run(): void
    {
        $estudios = [
            [
                'name' => 'Warner Bros. Pictures',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/Warner_Bros._%282019%29_logo.svg/512px-Warner_Bros._%282019%29_logo.svg.png',
            ],
            [
                'name' => 'Universal Pictures',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/Universal_Pictures_logo_%282012%29.svg/512px-Universal_Pictures_logo_%282012%29.svg.png',
            ],
            [
                'name' => 'Paramount Pictures',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/Paramount_Pictures_2022.svg/512px-Paramount_Pictures_2022.svg.png',
            ],
            [
                'name' => 'Walt Disney Studios',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Walt_Disney_Pictures_2022_logo.svg/512px-Walt_Disney_Pictures_2022_logo.svg.png',
            ],
            [
                'name' => 'Sony Pictures',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Sony_Pictures_Entertainment_logo.svg/512px-Sony_Pictures_Entertainment_logo.svg.png',
            ],
            [
                'name' => '20th Century Studios',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/62/20th_Century_Studios_logo_%282020%29.svg/512px-20th_Century_Studios_logo_%282020%29.svg.png',
            ]
        ];

        foreach ($estudios as $estudio) {
            Estudio::create($estudio);
        }
    }
}

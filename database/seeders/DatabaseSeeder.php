<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Hall;
use App\Models\PlaceType;
use App\Models\UserPlace;
use Illuminate\Database\Seeder;
use App\Models\HallPlaceTypePrice;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $hallsSeed = [
            [
                'name' => 'Зал 1',
                'rows' => 3,
                'row_length' => 3,
                'enabled' => true,
            ],
            [
                'name' => 'Зал 2',
                'rows' => 2,
                'row_length' => 2,
                'enabled' => false,
            ]
        ];
        $filmsSeed = [
            [
                'name' => 'Мой ужасный сосед (2022)',
                'minutes' => 126,
                'image' => 'http://localhost:8000/storage/images/a-man-called-otto.webp'
            ],
            [
                'name' => 'Джон Уик 4 (2023)',
                'minutes' => 169,
                'image' => 'http://localhost:8000/storage/images/john-wick-chapter-4.webp'
            ],
            [
                'name' => 'Аферисты (2023)',
                'minutes' => 116,
                'image' => 'http://localhost:8000/storage/images/sharper.webp'
            ],
            [
                'name' => 'Финч (2021)',
                'minutes' => 115,
                'image' => 'http://localhost:8000/storage/images/finch.webp'
            ]
        ];
        $placeTypesSeed = [
            [
                'type' => 'standart',
                'name' => 'Стандартное'
            ],
            [
                'type' => 'vip',
                'name' => 'VIP'
            ],
            [
                'type' => 'disabled',
                'name' => 'Место отсутствует'
            ]
        ];
        $hallPlaceTypePriceSeed = [
            [
                'hall_id' => 1,
                'place_type_id' => 1,
                'price' => 250
            ],
            [
                'hall_id' => 1,
                'place_type_id' => 2,
                'price' => 350
            ],
            [
                'hall_id' => 2,
                'place_type_id' => 1,
                'price' => 550
            ],
            [
                'hall_id' => 2,
                'place_type_id' => 2,
                'price' => 1250
            ]
        ];
        $userPlacesSeed = [
            [
                'place_row' => 1,
                'place_number' => 1,
                'hall_id' => 1,
                'place_type_id' => 1
            ],
            [
                'place_row' => 1,
                'place_number' => 2,
                'hall_id' => 1,
                'place_type_id' => 1
            ],
            [
                'place_row' => 1,
                'place_number' => 3,
                'hall_id' => 1,
                'place_type_id' => 1
            ],
            [
                'place_row' => 2,
                'place_number' => 1,
                'hall_id' => 1,
                'place_type_id' => 2
            ],
            [
                'place_row' => 2,
                'place_number' => 2,
                'hall_id' => 1,
                'place_type_id' => 2
            ],
            [
                'place_row' => 2,
                'place_number' => 3,
                'hall_id' => 1,
                'place_type_id' => 2
            ],
            [
                'place_row' => 3,
                'place_number' => 1,
                'hall_id' => 1,
                'place_type_id' => 2
            ],
            [
                'place_row' => 3,
                'place_number' => 2,
                'hall_id' => 1,
                'place_type_id' => 2
            ],
            [
                'place_row' => 3,
                'place_number' => 3,
                'hall_id' => 1,
                'place_type_id' => 3
            ],
            [
                'place_row' => 1,
                'place_number' => 1,
                'hall_id' => 2,
                'place_type_id' => 1
            ],
            [
                'place_row' => 1,
                'place_number' => 2,
                'hall_id' => 2,
                'place_type_id' => 2
            ],
            [
                'place_row' => 2,
                'place_number' => 1,
                'hall_id' => 2,
                'place_type_id' => 3
            ],
            [
                'place_row' => 2,
                'place_number' => 2,
                'hall_id' => 2,
                'place_type_id' => 1
            ],
        ];

        foreach ($hallsSeed as $hall) {
            Hall::firstOrCreate([
                'name' => $hall['name']
            ], $hall);
        }

        foreach ($filmsSeed as $film) {
            Film::firstOrCreate([
                'name' => $film['name']
            ], $film);
        }

        foreach ($placeTypesSeed as $placeType) {
            PlaceType::firstOrCreate([
                'type' => $placeType['type']
            ], $placeType);
        }

        foreach ($hallPlaceTypePriceSeed as $hallPlaceTypePrice) {
            HallPlaceTypePrice::firstOrCreate([
                'hall_id' => $hallPlaceTypePrice['hall_id'],
                'place_type_id' => $hallPlaceTypePrice['place_type_id'],
            ], $hallPlaceTypePrice);
        }

        foreach ($userPlacesSeed as $userPlace) {
            UserPlace::firstOrCreate([
                'hall_id' => $userPlace['hall_id'],
                'place_row' => $userPlace['place_row'],
                'place_number' => $userPlace['place_number'],
            ], $userPlace);
        }



        // \App\Models\User::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::create([
            'id' => 1,
            'name' => 'Anvers',
            'name_en' => 'Antwerp',
            'name_nl' => 'Antwerpen',
        ]);
        Province::create([
            'id' => 2,
            'name' => 'Flandre-Occidentale',
            'name_en' => 'West Flanders',
            'name_nl' => 'West-Vlaanderen',
        ]);
        Province::create([
            'id' => 3,
            'name' => 'Flandre-Orientale',
            'name_en' => 'East Flanders',
            'name_nl' => 'Oost-Vlaanderen',
        ]);
        Province::create([
            'id' => 4,
            'name' => 'Hainaut',
            'name_en' => 'Hainaut',
            'name_nl' => 'Henegouwen',
        ]);
        Province::create([
            'id' => 5,
            'name' => 'Liège',
            'name_en' => 'Liege',
            'name_nl' => 'Luik',
        ]);
        Province::create([
            'id' => 6,
            'name' => 'Limbourg',
            'name_en' => 'Limburg',
            'name_nl' => 'Limburg',
        ]);
        Province::create([
            'id' => 7,
            'name' => 'Luxembourg',
            'name_en' => 'Luxembourg',
            'name_nl' => 'Luxemburg',
        ]);
        Province::create([
            'id' => 8,
            'name' => 'Namur',
            'name_en' => 'Namur',
            'name_nl' => 'Namen',
        ]);
        Province::create([
            'id' => 9,
            'name' => 'Brabant flamand',
            'name_en' => 'Brabant flamand',
            'name_nl' => 'Brabant flamand',
        ]);
        Province::create([
            'id' => 10,
            'name' => 'Brabant wallon',
            'name_en' => 'Brabant wallon',
            'name_nl' => 'Brabant wallon',
        ]);
        Province::create([
            'id' => 11,
            'name' => 'Bruxelles',
            'name_en' => 'Brussels',
            'name_nl' => 'Brussel',
        ]);
    }
}

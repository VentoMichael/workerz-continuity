<?php

namespace Database\Seeders;

use App\Models\CatchPhraseAnnouncement;
use Illuminate\Database\Seeder;

class CatchPhraseAnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatchPhraseAnnouncement::create([
            'id'=>1,
            'name_en'=>'uncommon',
            'name_nl'=>'ongewoon',
            'name'=>'peu commune'
        ]);
        CatchPhraseAnnouncement::create([
            'id'=>2,
            'name_en'=>'to make a better deal',
            'name_nl'=>'om een betere deal te krijgen',
            'name'=>'pour réaliser une meilleur affaire'
        ]);
        CatchPhraseAnnouncement::create([
            'id'=>3,
            'name_en'=>'that suits you',
            'name_nl'=>'dat bij u past',
            'name'=>'qui vous convient'
        ]);
        CatchPhraseAnnouncement::create([
            'id'=>4,
            'name_en'=>'that everyone should accept',
            'name_nl'=>'dat iedereen zou moeten accepteren',
            'name'=>'que tout le monde devrait accepter'
        ]);
        CatchPhraseAnnouncement::create([
            'id'=>5,
            'name_en'=>'indispensable',
            'name_nl'=>'onmisbaar',
            'name'=>'indispensable'
        ]);
    }
}

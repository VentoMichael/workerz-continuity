<?php

namespace Database\Seeders;

use App\Models\CatchPhraseUser;
use Illuminate\Database\Seeder;

class CatchPhraseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatchPhraseUser::create([
            'id'=>1,
            'name_en'=>' par excellence',
            'name_nl'=>' bij uitstek',
            'name'=>' par excellence'
        ]);
        CatchPhraseUser::create([
            'id'=>2,
            'name_en'=>', the best in its field',
            'name_nl'=>', de beste op zijn gebied',
            'name'=>', le meilleur dans son domaine'
        ]);
        CatchPhraseUser::create([
            'id'=>3,
            'name_en'=>' who you need',
            'name_nl'=>' wie je nodig hebt',
            'name'=>' qui vous faut'
        ]);
        CatchPhraseUser::create([
            'id'=>4,
            'name_en'=>' who has time for you',
            'name_nl'=>' die tijd voor je heeft',
            'name'=>' qui a du temps pour vous'
        ]);
        CatchPhraseUser::create([
            'id'=>5,
            'name_en'=>' who will be as fast as professional',
            'name_nl'=>' die zo snel als professioneel zal zijn',
            'name'=>' qui sera aussi rapide que professionnel'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\PlanUser;
use Illuminate\Database\Seeder;

class PlanUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlanUser::create([
            'id' => 1,
            'name' => 'Free',
            'price' => 0,
            'duration' => 7,
            'possibilityAdCreated' =>2,
            'hight_visibility' => false,
            'priority' => false,
            'more_visible'=>false,
        ]);
        PlanUser::create([
            'id' => 2,
            'name' => 'Premium',
            'price' => 9.99,
            'oldprice' => 12.99,
            'possibilityAdCreated' => 5,
            'hight_visibility' => true,
            'priority' => true,
            'more_visible'=>true,
        ]);
        PlanUser::create([
            'id' => 3,
            'name' => 'Star',
            'price' => 19.99,
            'possibilityAdCreated' => 15,
            'hight_visibility' => true,
            'priority' => true,
            'more_visible'=>true,
        ]);
    }
}

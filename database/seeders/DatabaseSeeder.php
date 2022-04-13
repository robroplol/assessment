<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

use App\Models\User;
use App\Models\Store;
use App\Models\Journal;
use App\Models\Brand;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            ['name' => 'Taco Bell', 'color' => '#632888'],
            ['name' => 'Pizza Hut', 'color' => '#ef3840'],
            ['name' => 'KFC', 'color' => '#9a070c'],
            ['name' => 'The Habit Burger Grill', 'color' => '#eb931e'],
        ];
        foreach ($brands as $brand) {
            Brand::create(['name' => $brand['name'], 'color' => $brand['color']]);
        }
        
        $user = User::factory(2)->has(
            Store::factory()->count(1)->state(new Sequence(
                fn ($sequence) => ['brand_id' => Brand::all()->random()],
            ))->hasJournals(15)
        )->create();

        
    }
}

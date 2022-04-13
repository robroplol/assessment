<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\Hash;

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
            ['name' => 'Taco Bell', 'color' => '#632888', 'logo_file' => 'img/taco-bell-logo.svg'],
            ['name' => 'Pizza Hut', 'color' => '#ef3840' , 'logo_file' => 'img/pizza-hut-logo.svg'],
            ['name' => 'KFC', 'color' => '#9a070c', 'logo_file' => 'img/kfc-logo.svg'],
            ['name' => 'The Habit Burger Grill', 'color' => '#eb931e', 'logo_file' => 'img/habit-burger-logo.svg'],
        ];
        foreach ($brands as $brand) {
            Brand::create(['name' => $brand['name'], 'color' => $brand['color'], 'logo_file' => $brand['logo_file']]);
        }
        
        $user = User::factory(2)->has(
            Store::factory()->count(5)->state(new Sequence(
                fn ($sequence) => ['brand_id' => Brand::all()->random()],
            ))->hasJournals(10)
        )->create();

        $first_user = User::first();
        $first_user->update([
            'name' => 'Rob Rop',
            'email' => 'robrop92@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $first_user->save();
    }
}

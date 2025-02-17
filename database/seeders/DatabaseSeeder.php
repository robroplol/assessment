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

use Carbon\Carbon;

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
        
        $users = User::factory(3)->create();
        foreach ($users as $user) {
           Store::factory()->count(3)->for($user)->state(new Sequence(
            fn ($sequence) => ['brand_id' => Brand::all()->random()],
        ))->create();
        }
        
        $stores = Store::all();
        foreach ($stores as $store) {
            Journal::factory()->count(15)->for($store)->state( new Sequence(
                fn ($sequence) => ['date' => Carbon::now()->sub($sequence->index, 'day')->format('Y-m-d')],
            ))->create();
        }

        $first_user = User::first();
        $first_user->update([
            'name' => 'Rob Rop',
            'email' => 'robrop92@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $first_user->save();
    }
}

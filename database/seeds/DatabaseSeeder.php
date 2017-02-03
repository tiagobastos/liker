<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class, 1)->create([
            'name' => 'Tiago Bastos',
            'email' => 'tiagobastos@laravel.dev',
            'password' => bcrypt('password')
        ]);

        factory(App\User::class, 1)->create([
            'name' => 'Jon Doe',
            'email' => 'jondoe@laravel.dev',
            'password' => bcrypt('password')
        ]);

        factory(App\Post::class, 3)->create(['user_id' => App\User::find(1)->id]);
        factory(App\Post::class, 3)->create(['user_id' => App\User::find(2)->id]);
    }
}

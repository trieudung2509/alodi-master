<?php

use App\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
           'user_type'     => 'admin',
           'name'    => 'Developer',
           'email'    => 'developer@gmail.com',
           'email_verified_at'    => date('Y-m-d H:i:s'),
           'password'    => Hash::make('fakepassword'),
        ]);
        DB::table('users')->insert([
            'user_type'     => 'admin',
            'name'    => 'Admin',
            'email'    => 'admin@gmail.com',
            'email_verified_at'    => date('Y-m-d H:i:s'),
            'password'    => Hash::make('fakepassword'),
        ]);
        DB::table('languages')->insert([
            'name'    => 'English',
            'code'    => 'en',
            'rtl'    => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         ]);
        DB::table('languages')->insert([
            'name'    => 'Vietnamese',
            'code'    => 'vn',
            'rtl'    => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        App\Category::factory()->count(10)->create();
        App\Blog::factory()->count(50)->create();
    }
}

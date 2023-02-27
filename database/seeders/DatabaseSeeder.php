<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Creates 10 dummy users
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'asdfg@hijk.com',
        ]);
        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);

         //
        //  DB::table('listing')->insert([
        //     'title' => 'Laravel S. Dev',
        //     'tags' => 'laravel, javascript',
        //     'company' => 'Acme corp',
        //     'location' => 'Canada',
        //     'email' => 'email@email.com',
        //     'website' => 'website.com',
        //     'description' => 'KLASDMMSALÉKDM KM M 
        //     aLDSAd aDa da ldkasmlkd mla dka da sdas
        //     a sjkdnakjsd klaslk da sjndjlasnj ldalsj njd,
        //     LKADMlkmasdlm alksd akldlal smdlkas.',
        // ]);
 
    }
}

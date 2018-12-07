<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->delete();
        DB::statement('alter table companies AUTO_INCREMENT = 1');
        Company::create(
                [ 'name' => 'Administrator',
                        'api_token' => '1234' ]
            );
       
        
    }
}
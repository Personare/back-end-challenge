<?php

use Illuminate\Database\Seeder;
use App\Company;
use App\Currency;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->delete();
        DB::statement('alter table currencies AUTO_INCREMENT = 1');
        Currency::create(
            [ 'name' => 'Real',
                'symbol' => 'R$',
                'exchange_rate' => 1]
            );
        Currency::create(
            [ 'name' => 'Dolar',
                'symbol' => 'US$',
                'exchange_rate' => 3.87]
            );
        Currency::create(
            [ 'name' => 'Euro',
                'symbol' => 'EUR',
                'exchange_rate' => 4.41]
            );
       
        
    }
}
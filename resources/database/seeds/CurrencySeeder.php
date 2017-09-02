<?php

use Phinx\Seed\AbstractSeed;

class CurrencySeeder extends AbstractSeed
{
    public function run()
    {
        $array = [
            ['iso' => 'USD', 'symbol' => '$'],
            ['iso' => 'BRL', 'symbol' => 'R$'],
            ['iso' => 'EUR', 'symbol' => '€'],
        ];

        $this->table('currencies')->truncate();
        $this->table('currencies')->insert($array)->save();
    }
}

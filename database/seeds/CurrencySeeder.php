<?php

use Illuminate\Database\Seeder;
use App\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
           'name' => 'US Dollars',
           'code' => 'USD',
           'country' => 'USA',
            'rate' => 1,
        ]);
        Currency::create([
            'name' => 'British Pounds Sterling',
            'code' => 'GBP',
            'country' => 'United Kingdom',
            'rate' => 0.73
        ]);
        Currency::create([
            'name' => 'Nigerian Naira',
            'code' => 'NGN',
            'country' => 'Nigeria',
            'rate' => 411,
        ]);
    }
}

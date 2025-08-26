<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setup;
class Currencies extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Currencies = [
            ["currency" , "SR" ,"Saudi Riyal" ],
            ["currency" , "USD" ,"US Dollar" ],
            ["currency" , "EUR" ,"Euro" ],
            ["currency" , "GBP" ,"British Pound" ],
            ["currency" , "JPY" ,"Japanese Yen" ],

            //key        //value  //additional info (meta)
        ];
        foreach($Currencies as $currency){
            Setup::updateOrCreate([
                "key" => $currency[0],
                "value" => $currency[1],
                "meta" => ["name" => $currency[2]]
            ]);
        }

    }
}

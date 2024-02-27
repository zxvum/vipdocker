<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filePath = public_path('all.json');
        $jsonData = File::get($filePath);
        $collect = collect(json_decode($jsonData, true));


        foreach ($collect as $country) {
            $name = $country['name']['common'];
            $ru_name = $country['translations']['rus']['common'];

            if (array_key_exists("postalCode", $country)){
                if (array_key_exists("regex", $country['postalCode'])){
                    Country::create([
                        'name' => $name,
                        'ru_name' => $ru_name,
                        'postal_code_regex' => $country['postalCode']['regex'],
                        'phone_number_code' => $country['idd']['root'],
                        'short_name' => $country['altSpellings'][0]
                    ]);
                }
                continue;
            }
        }
    }
}

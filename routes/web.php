<?php

use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;
use App\Models\Country;

Route::get('/', function () {
    $client = new Client();
    try {
        $response = $client->get('https://restcountries.com/v3.1/all');
        $countries = json_decode($response->getBody(), true);

        foreach ($countries as $countryData) {

            Country::updateOrCreate(
                ['name' => $countryData['name']['common']], // فیلد کد کشور به عنوان کلید یکتا
                [

                    'official_name' => $countryData['name']['official'] ?? 'Unknown',

                    'currencies_name'=> isset($countryData['currencies']) ? $countryData['currencies'][array_key_first($countryData['currencies'])]['name'] : 'Unknown',
                    'currencies_symbol' => isset( $countryData['currencies']) ? $countryData['currencies'][array_key_first($countryData['currencies'])]['symbol'] : 'Unknown',

                    'region' => $countryData['region'] ?? 'Unknown',
                    'languages' => isset($countryData['languages']) ?$countryData['languages'][array_key_first($countryData['languages'])] : 'Unknown',

                    'google_maps' => isset($countryData['maps']) ? $countryData['maps']['googleMaps'] : 'Unknown',
                    'open_street_maps' => isset($countryData['maps']) ? $countryData['maps']['openStreetMaps'] : 'Unknown',

                    'timezones' =>isset($countryData['timezones'])? $countryData['timezones'][array_key_first($countryData['timezones'])] : 'Unknown',
                    'flag_svg' => isset($countryData['flags']) ? $countryData['flags']['svg'] : 'Unknown',


                ]
            );
        }


    } catch (\Exception $e) {
        dd("خطا در دریافت اطلاعات کشورها: " . $e->getMessage());
    }
});

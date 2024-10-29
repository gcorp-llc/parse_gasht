<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Model;

#[ApiResource]
class Country extends Model
{

     protected $fillable = [
        'name',
        'official_name',
        'currencies_name',
        'currencies_symbol',
        'region',
        'languages',
        'google_maps',
        'open_street_maps',
        'timezones',
        'flag_svg'
    ];

    protected $visible = [
        'name',
        'official_name',
        'currencies_name',
        'currencies_symbol',
        'region',
        'languages',
        'google_maps',
        'open_street_maps',
        'timezones',
        'flag_svg'
    ];
}

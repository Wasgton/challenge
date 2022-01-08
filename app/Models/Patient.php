<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    const CREATED_AT = 'imported_t';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'first_name',
        'last_name',
        'title',
        'gender',
        'phone',
        'cell',
        'email',
        'username',
        'nat',
        'picture_large',
        'picture_medium',
        'picture_thumbnail',
        'registered',
        'uuid',
        'dob',
        'imported_t',
        'updated_at',
        'status',
        'street',
        'number',
        'city',
        'sttate',
        'postcode',
        'latitude',
        'longitude',
        'timezone',
        'timezone_description',
    ];

}

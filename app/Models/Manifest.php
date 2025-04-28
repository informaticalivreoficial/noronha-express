<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manifest extends Model
{
    use HasFactory;

    protected $table = 'manifests';

    protected $fillable = [
        'trip',
        'type',
        'company',
        'user',
        'status',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'information',
        'contact',
    ];
}

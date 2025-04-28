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

    /**
     * Scopes
    */

    /**
     * Relationships
    */
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function userObject()
    {
        return $this->hasOne(User::class, 'id', 'user');
    }

    public function items()
    {
        return $this->hasMany(ManifestItem::class, 'manifest', 'id');
    }

    /**
     * Accerssors and Mutators
    */
}

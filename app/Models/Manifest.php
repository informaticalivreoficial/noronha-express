<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\StatusOfManifestEnum;
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

    protected $casts = [
        'status' => StatusOfManifestEnum::class,
    ];

    /**
     * Scopes
    */

    /**
     * Relationships
    */
    public function tripObject()
    {
        return $this->belongsTo(Trip::class);
    }

    public function companyObject()
    {
        return $this->hasOne(Company::class, 'id', 'company');
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

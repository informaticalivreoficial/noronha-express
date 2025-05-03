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
        'object',
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
        'created',
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
        return $this->hasOne(Trip::class, 'id', 'trip');
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

    public function images()
    {
        return $this->hasMany(ManifestGb::class, 'manifest', 'id')->orderBy('cover', 'ASC');
    }

    /**
     * Accerssors and Mutators
    */
    public function getCreatedAtAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return date('d/m/Y', strtotime($value));
    }
}

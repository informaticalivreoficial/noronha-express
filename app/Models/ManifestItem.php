<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'manifest',
        'unit',
        'description',
        'quantity',
        'horti_fruit',
        'cubage',
        'secure',
        'dry_weight',
        'package',
        'glace',
        'tax',
    ];

    /**
     * Scopes
    */

    /**
     * Relationships
    */
    public function manifest()
    {
        return $this->hasOne(Manifest::class, 'id', 'manifest');
    }
}

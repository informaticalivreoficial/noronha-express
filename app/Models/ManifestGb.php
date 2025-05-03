<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ManifestGb extends Model
{
    use HasFactory;

    protected $table = 'manifest_gbs'; 

    protected $fillable = [
        'manifest',
        'path',
        'cover'
    ];

    public function getUrlCroppedAttribute()
    {
        return Storage::url($this->path);
    }

    public function getUrlImageAttribute()
    {
        return Storage::url($this->path);
    }
}

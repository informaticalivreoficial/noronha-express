<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableOfValue extends Model
{
    use HasFactory;

    protected $table = 'table_of_values';

    protected $fillable = [
        'horti_fruit',
        'cubage',
        'secure',
        'dry_weight',
        'package',
        'glace',
        'tax',
        'general_1000_5000',
        'general_above_5000'        
    ];
}

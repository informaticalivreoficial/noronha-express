<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'stop',
        'ship',        
        'information'
    ];

    protected $casts = [
        'start' => 'datetime',
        'stop' => 'datetime',
    ];

    /**
     * Accerssors and Mutators
    */
    public function setStartAttribute($value)
    {
        $this->attributes['start'] = (!empty($value) ? $this->convertStringToDate($value) : null);
    }
    
    public function getStartAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return date('d/m/Y', strtotime($value));
    }

    public function setStopAttribute($value)
    {
        $this->attributes['stop'] = (!empty($value) ? $this->convertStringToDate($value) : null);
    }
    
    public function getStopAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return date('d/m/Y', strtotime($value));
    }

    private function convertStringToDate(?string $param)
    {
        if (empty($param)) {
            return null;
        }
        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }
    
    private function clearField(?string $param)
    {
        if (empty($param)) {
            return null;
        }
        return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
    }
}
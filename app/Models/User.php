<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $fillable = [
        'name', 'password', 'remember_token', 'code',
        'gender',
        'cpf',
        'rg',
        'rg_expedition',
        'birthday',
        'naturalness',
        'civil_status',
        'avatar',  
        //Address      
        'postcode', 'street', 'number', 'complement', 'neighborhood', 'state', 'city',
        //Contato
        'phone', 'cell_phone', 'whatsapp', 'email', 'additional_email', 'telegram',
        //Social
        'facebook', 'instagram', 'linkedin',  
        //function
        'admin', 'client', 'editor', 'superadmin',
        'status',
        'information'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Scopes
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 1);
    }

    public function scopeUnavailable($query)
    {
        return $query->where('status', 0);
    }

    /**
     * Relationships
    */
    public function manifests()
    {
        return $this->hasMany(Manifest::class, 'user', 'id');
    }
    
    public function company()
    {
        return $this->hasMany(Company::class, 'user', 'id');
    }

    /**
     * Accerssors and Mutators
    */

    //Exibe a função do usuário
    public function getFuncao() {
        if($this->admin == 1 && $this->client == 0 && $this->superadmin == 0){
            return 'Administrador';
        }elseif($this->admin == 0 && $this->client == 1 && $this->superadmin == 0){
            return 'Cliente';
        }elseif($this->admin == 0 && $this->client == 0 && $this->editor == 1 && $this->superadmin == 0){
            return 'Editor';
        }elseif($this->admin == 1 && $this->client == 1 && $this->superadmin == 0){
            return 'Administrador/Cliente'; 
        }else{
            return 'Super Administrador'; 
        }
    }

    public function getUrlAvatarAttribute()
    {
        if (!empty($this->avatar)) {
            return Storage::url($this->avatar);
        }
        return '';
    }

    // public function setCpfAttribute($value)
    // {
    //     $this->attributes['cpf'] = (!empty($value) ? $this->clearField($value) : null);
    // }
    
    // public function getCpfAttribute($value)
    // {
    //     if (empty($value)) {
    //         return null;
    //     }

    //     return
    //         substr($value, 0, 3) . '.' .
    //         substr($value, 3, 3) . '.' .
    //         substr($value, 6, 3) . '-' .
    //         substr($value, 9, 2);
    // }

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = (!empty($value) ? $this->convertStringToDate($value) : null);
    }
    
    public function getBirthdayAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return date('d/m/Y', strtotime($value));
    }

    public function setCellPhoneAttribute($value)
    {
        $this->attributes['cell_phone'] = (!empty($value) ? $this->clearField($value) : null);
    }
    
    public function getCellPhoneAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return  
            substr($value, 0, 0) . '(' .
            substr($value, 0, 2) . ') ' .
            substr($value, 2, 5) . '-' .
            substr($value, 7, 4) ;
    }

    // public function setAdminAttribute($value)
    // {
    //     $this->attributes['admin'] = ($value === true || $value === 'on' ? 1 : 0);
    // }

    // public function setEditorAttribute($value)
    // {
    //     $this->attributes['editor'] = ($value === true || $value === 'on' ? 1 : 0);
    // }

    // public function setClientAttribute($value)
    // {
    //     $this->attributes['client'] = ($value === true || $value === 'on' ? 1 : 0);
    // }
    
    // public function setSuperAdminAttribute($value)
    // {
    //     $this->attributes['superadmin'] = ($value === true || $value === 'on' ? 1 : 0);
    // }

    private function convertStringToDouble(?string $param)
    {
        if (empty($param)) {
            return null;
        }

        return str_replace(',', '.', str_replace('.', '', $param));
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

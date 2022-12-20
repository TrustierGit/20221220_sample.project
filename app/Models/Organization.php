<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Organization extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;


    public function user(){
    return $this->hasMany(User::class,['domain_organization','mode_reserve'],['domain_organization','mode_reserve']);
    // return $this->hasMany(User::class,'domain_organization','domain_organization');
    // return $this->hasMany(User::class,'mode_reserve','mode_reserve');
    }
}


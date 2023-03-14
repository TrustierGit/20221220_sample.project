<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
//use App\Traits\AuthHistoryTrait;

class Reservation extends Model
{
    //use HasFactory, AuthHistoryTrait;
    use HasFactory;
    protected $fillable = [
        'domain_organization',
        'date_reservation',
        'email_staff',
    ];

    public static function boot()
    {
        parent::boot();

       // self::saveAuthHistory();
    }

   
}

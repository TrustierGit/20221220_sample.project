<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthHistory extends Model
{
	use HasFactory;

	protected $fillable = [
        'user_id','email','ip_address','user_agent','login_time'
    ];
}

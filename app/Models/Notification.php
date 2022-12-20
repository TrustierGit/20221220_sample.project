<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//sortable

use Kyslik\ColumnSortable\Sortable;

class Notification extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'date_post',
        'text_title',
        'text_message',
    ];

    public $sortable =
    [
        'id',
        'date_post',
        'text_title',
        'text_message',
    ];
}


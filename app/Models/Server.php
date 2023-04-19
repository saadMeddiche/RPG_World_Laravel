<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'address',
        'game_id',
        'user_id'
    ];
}

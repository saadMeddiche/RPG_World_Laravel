<?php

namespace App\Models;

use App\Models\Server;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $fillable=['name','description','image'];

    public function Servers()
    {
        return $this->hasMany(Server::class);
    }
}

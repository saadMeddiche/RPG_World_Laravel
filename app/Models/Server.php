<?php

namespace App\Models;

use App\Models\Game;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Server extends Model
{
    use HasFactory, Searchable;

    protected $fillable=['name','description','game_id','image'];
    
    public function Game()
    {
        return $this->belongsTo(Game::class);
    }
}

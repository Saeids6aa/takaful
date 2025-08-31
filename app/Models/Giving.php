<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giving extends Model
{
    use HasFactory;
   protected $fillable = [
        'name',
        'quantity',
        'category_id',
        'doner_id',
      
    ];  
        public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function doner()
    {
        return $this->belongsTo(Doner::class);
    }
}

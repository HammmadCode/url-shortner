<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;


    public function analytics()
    {
        return $this->hasMany(Analytics::class, 'short_url_id');
    }
}

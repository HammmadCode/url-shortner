<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Torann\GeoIP\Facades\GeoIP;

class Analytics extends Model
{
    use HasFactory;

     protected $fillable = [
        'short_url_id',
        'ip_address',
        'user_agent',
        'location',
        'clicked_at',
    ];

     public function logClick($shortUrl)
    {
        self::create([
            'short_url_id' => $shortUrl->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'location' => GeoIP::getLocation(request()->ip())->country ?? 'Unknown',
            'clicked_at' => now(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use App\Models\ShortUrl;

class RedirectController extends Controller
{
    public function redirect($shortConde)
    {
        $shortUrl = ShortUrl::where('short_code', $shortConde)->firstOrFail();

         $analytics = new Analytics();
        $analytics->logClick($shortUrl);

        return redirect($shortUrl->long_url);
    }
}

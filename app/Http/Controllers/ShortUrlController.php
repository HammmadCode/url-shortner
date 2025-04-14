<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortUrlRequest;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function store(ShortUrlRequest $request)
   {

    $shortUrl = new ShortUrl();
    $shortUrl->user_id = Auth::id();
    $shortUrl->long_url = $request->validated('long_url');
    $shortUrl->short_code = $request->validated('short_code') ?? Str::random(6);
    $shortUrl->save();

    return redirect()->route('dashboard')->with('success', 'Short URL created!');
   }
}

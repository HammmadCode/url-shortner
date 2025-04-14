<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
     public function showAnalytics($id)
    {
        $shortUrl = ShortUrl::with('analytics')->findOrFail($id);
        return view('analytics.show', compact('shortUrl'));
    }
}

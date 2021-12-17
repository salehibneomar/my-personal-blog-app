<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;

class SinglePostController extends Controller
{

    public function index($slug, $uuid)
    {
        $site_info = User::with('settings')
                          ->whereNotNull('created_at')  
                          ->orderBy('created_at', 'asc')
                          ->first();

        $post = Post::withoutTrashed()->where('uniq_code', $uuid)->firstOrFail();
        return view('frontend.pages.single', compact('post', 'site_info'));
    }

    
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $site_info = User::with('settings')
                          ->whereNotNull('created_at')  
                          ->orderBy('created_at', 'asc')
                          ->first();

        $posts = Post::whereNull('deleted_at')
                   ->orderBy('id', 'desc')
                   ->simplePaginate(15);

        return view('index', compact('site_info', 'posts'));                
    }

}

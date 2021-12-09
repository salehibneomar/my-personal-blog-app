<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author_id = 'S5210';
        $site_info = User::with('settings')->findOrFail($author_id);

        return view('index', compact('site_info'));                
    }

}

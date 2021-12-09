<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use App\Traits\AlertTrait;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    use AlertTrait;
    
    public function index()
    {
        return view('backend.pages.profile.view');
    }

    public function edit()
    {
        return view('backend.pages.profile.edit');
    }

    public function updateGeneral(Request $request){
        $request->validate([
            'name'  => 'required|min:3|max:100',
            'email' => 'required|email|min:5|max:250',
            'bio'   => 'required|min:3|max:150',
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name  = $request->name;
        $user->email = Str::lower($request->email);
        $user->bio   = $request->bio;
        $user->save();

        return redirect()
                ->route('author.profile.view')
                ->with($this->successful('General profile information updated!'));
    }

    public function updateImage(Request $request){
        $request->validate([
            'image' => 'required|file|mimes:png,jpg,jpeg|min:1|max:3080',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if(file_exists($user->image)){
            unlink($user->image);
        }

        $location  = 'images/settings/';
        $imageFile = $request->file('image');
        $imageName = mt_rand(10000, 99999).'_profile.'.         $imageFile->getClientOriginalExtension();
        
        Image::make($imageFile)->resize(200, 200)->save($location.$imageName);

        $user->image = $location.$imageName;
        $user->save();

        return redirect()
                ->route('author.profile.view')
                ->with($this->successful('Profile image updated!'));
    }

    public function updateBanner(Request $request){
        $request->validate([
            'banner' => 'required|file|mimes:png,jpg,jpeg|min:1|max:5150',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if(file_exists($user->banner)){
            unlink($user->banner);
        }

        $location  = 'images/settings/';
        $imageFile = $request->file('banner');
        $imageName = mt_rand(10000, 99999).'_banner.'.         $imageFile->getClientOriginalExtension();
        
        Image::make($imageFile)->resize(1350, 272)->save($location.$imageName);

        $user->banner = $location.$imageName;
        $user->save();

        return redirect()
                ->route('author.profile.view')
                ->with($this->successful('Banner image updated!'));
    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:8|max:32|confirmed',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if(!(Hash::check($request->current_password, $user->password))){
            return back()->with($this->failed('Current password was incorrect!'));
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()
                ->route('author.profile.view')
                ->with($this->successful('Password updated!'));

    }
    
}

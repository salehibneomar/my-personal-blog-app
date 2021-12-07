<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\AlertTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{

    use AlertTrait;
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $settings = Auth::user()->settings;
        return view('backend.pages.setting.edit', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateGeneral(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'initial_name' => 'required|min:2|max:10',
        ]);

        $user_id  = Auth::user()->id;
        $settings = Setting::where('user_id', $user_id)->firstOrFail();
        $settings->name         = $request->name;
        $settings->initial_name = $request->initial_name;
        $settings->save();
        
        return back()->with($this->successful('General site information updated!'));
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|file|mimes:png|min:1|max:130',
        ]);

        $user_id  = Auth::user()->id;
        $settings = Setting::where('user_id', $user_id)->firstOrFail();

        if(file_exists($settings->logo)){
            unlink($settings->logo);
        }

        $location  = 'images/settings/';
        $imageName = 'logo.png';
        $imageFile = $request->logo;
        
        Image::make($imageFile)->resize(32, 32)->save($location.$imageName);

        $settings->logo = $location.$imageName;
        $settings->save();

        return back()->with($this->successful('Site logo updated!'));
    }

}

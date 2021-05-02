<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function index(){
        return view('admin.settings.index');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'identitas' => 'required',
            'no_identitas' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'about' => 'required',
        ]);

        $user = User::findorfail(Auth::id());
        $user->name = $request->name;
        $user->identitas = $request->identitas;
        $user->no_identitas = $request->no_identitas;
        $user->alamat = $request->alamat;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->email = $request->email;
        $user->about = $request->about;
        $user->save();

        Toastr::success('Profile Successfully Updated ^_^, for Security your Account has been Logout', 'Success');
        Auth::logout();

        return redirect()->route('primary');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->old_password, $hashedPassword)){
            if(!Hash::check($request->password, $hashedPassword)){
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();

                Toastr::success('Password Successfully Changed ^_^, for Security your Account has been Logout', 'Success');
                Auth::logout();

                return redirect()->route('primary');
            } else{
                Toastr::error('New Password cannot be the same as old password', 'Error');
                return redirect()->back();
            }
        } else{
            Toastr::error('Current password not match', 'Error');
            return redirect()->back();
        }
    }

    public function updateImage(Request $request)
    {
        $this->validate($request,[
            'image' => 'mimes:jpeg,bmp,png,jpg',
        ]);

        if (Auth::user()->username == NULL){   
            $isSlug = str_slug(Auth::user()->name);
        } else {
            $isSlug = str_slug(Auth::user()->username);
        }

        $image = $request->file('image');
        $slug = $isSlug;
        $user = User::find(Auth::id());
        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('account'))
            {
                Storage::disk('public')->makeDirectory(('account'));
            }

            if(Storage::disk('public')->exists('account/'.$user->image))
            {
                Storage::disk('public')->delete('account/'.$user->image);
            }

            $userImage = Image::make($image)->resize(1024,1024)->stream();
            Storage::disk('public')->put('account/'.$imagename,$userImage);
        } else {
            $imagename = $user->image;
        }

        $user->image = $imagename;
        $user->save();

        Toastr::success('Your Image Profile Successfully Updated :))', 'Success');

        return redirect()->route('admin.settings');
    }
}

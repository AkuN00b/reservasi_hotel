<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index(){
        return view('customer.settings.index');
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
}

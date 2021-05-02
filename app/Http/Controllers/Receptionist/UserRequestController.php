<?php

namespace App\Http\Controllers\Receptionist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Brian2694\Toastr\Facades\Toastr;

class UserRequestController extends Controller
{
    public function request()
    {
        $user_request = User::where('user_id', Auth::user()->id)
                          ->where('req_status', 0)
                          ->orderBy('id', 'DESC')->get();

        $users = User::where('user_id', Auth::user()->id)
                  ->where('req_status', 1)->get();

        $user_accepted = User::where('user_id', Auth::user()->id)
                           ->where('req_status', 2)
                           ->orderBy('id', 'DESC')->get();

        $user_canceled = User::where('user_id', Auth::user()->id)
                           ->where('req_status', 9)
                           ->orderBy('id', 'DESC')->get();

        return view('receptionist.user.index', compact('users', 'user_request', 'user_accepted', 'user_canceled'));
    }

    public function toActive($id)
    {
        $user = User::find($id);

        if ($user->status != 1)
        {   
            if ($user->req_status != 1)
            {
                Toastr::error('Sorry, This User can not to Edit and Use', 'Error');
            } else {
                $user->status = 1;
                $user->save();

                Toastr::success('This User Status Successfully Active :))', 'Success');
            }    
        } else {
            Toastr::error('This User has Already to Active :))', 'Error');
        }

        return redirect()->back();
    }

    public function toNonActive($id)
    {
        $user = User::find($id);

        if ($user->status != 0)
        {   
            if ($user->req_status != 1)
            {
                Toastr::error('Sorry, This User can not to Edit and Use', 'Error');
            } else {
                $user->status = 0;
                $user->save();

                Toastr::success('This User Status Successfully Non-Active :))', 'Success');
            }    
        } else {
            Toastr::error('This User has Already to Non-Active :))', 'Error');
        }

        return redirect()->back();
    }
}

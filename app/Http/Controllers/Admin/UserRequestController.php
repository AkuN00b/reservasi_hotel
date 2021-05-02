<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;

class UserRequestController extends Controller
{
    public function index()
    {
        $users = User::where('req_status', 0)->get();

        $user_active = User::where('req_status', 1)->get();

        $user_accepted = User::where('req_status', 2)
                           ->orderBy('id', 'DESC')->get();

        $user_canceled = User::where('req_status', 9)
                           ->orderBy('id', 'DESC')->get();

        return view('admin.user.index', compact('users', 'user_active', 'user_accepted', 'user_canceled'));
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

    // public function create(Request $request, $id){
    //     $user = User::find($id);

    //     $this->validate($request, [
    //         'status' => 'required',
    //     ]);

    //     if ($user->req_status != 1)
    //     {   
    //         $user->req_status = 1;
    //         $user->save();

    //         $userr = new User();
    //         $userr->name = $user->name;
    //         $userr->room_id = $user->room_id;
    //         $userr->status = $request->status;
    //         $userr->user_id = $user->user_id;
    //         $userr->room_number_id = $id;
    //         $userr->req_status = 2;
    //         $userr->save();

    //         Toastr::success('User Data Successfully Confirmed :))', 'Success');
    //     } else {
    //         Toastr::error('User Data has Already Confirmed :))', 'Error');
    //     }

    //     return redirect()->back();
    // }

    // public function edit(Request $request, $id)
    // {
    //     $user = User::find($id);

    //     $this->validate($request, [
    //         'status' => 'required',
    //     ]);

    //     $userr = $user->users_id;
    //     $users_id = User::find($userr);

    //     if ($user->req_status != 2)
    //     {
    //         $users_id->name = $user->name;
    //         $users_id->room_id = $user->room_id;
    //         $users_id->status = $user->status;
    //         $users_id->user_id = $user->user_id;
    //         $users_id->save();

    //         $user->status = $request->status;
    //         $user->req_status = 2;
    //         $user->save();
    
    //         Toastr::success('User Data Successfully Confirmed :))', 'Success');
    //     } else {
    //         Toastr::error('User Data has Already Confirmed :))', 'Error');
    //     }

    //     return redirect()->back();
    // }

    public function delete(Request $request, $id)
    {
        $user = User::find($id);

        // $this->validate($request, [
        //     'status' => 'required',
        // ]);

        $userr = $user->users_id;
        $users_id = User::find($userr);

        if ($user->req_status != 2)
        {
            // $user->status = $request->status;
            $user->req_status = 2;
            $user->save();

            $users_id->delete();

            Toastr::success('User Data Successfully Confirmed :))', 'Success');
        } else {
            Toastr::error('User Data has Already Confirmed :))', 'Error');
        }

        return redirect()->back();
    }
    
    public function cancel(Request $request, $id)
    {
        $user = User::find($id);

        // $this->validate($request, [
        //     'status' => 'required',
        // ]);

        if ($user->req_status != 9)
        {   
            // $user->status = $request->status;
            $user->req_status = 9;
            $user->save();

            Toastr::success('User Data Successfully Rejected :))', 'Success');
        } else {
            Toastr::error('User Data has Already Rejected :))', 'Error');
        }

        return redirect()->back();
    }
}

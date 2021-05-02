<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('role_id', 'asc')
                     ->where('req_status', 1)->get();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'identitas' => 'required',
            'no_identitas' => 'required|unique:users,no_identitas',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);

        $users = new User();
        $users->name = $request->name;
        $users->identitas = $request->identitas;
        $users->no_identitas = $request->no_identitas;
        $users->alamat = $request->alamat;
        $users->jenis_kelamin = $request->jenis_kelamin;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);
        $users->status = 1;
        $users->req_status = 1;
        $users->save();

        Toastr::success('User Data Successfully Saved :))', 'Success');

        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('admin.user.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->email == $user->email)
        {
            $a = '';
        } else {
            $a = '|unique:users,email';
        }

        if ($request->no_identitas == $user->no_identitas)
        {
            $a = '';
        } else {
            $a = '|unique:users,no_identitas';
        }

        if ($request->username == $user->username)
        {
            $a = '';
        } else {
            $a = '|unique:users,username';
        }

        $this->validate($request, [
            'name' => 'required',
            'identitas' => 'required',
            'no_identitas' => 'required'.$a.'',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'username' => 'required'.$a.'',
            'email' => 'required'.$a.'',
            'role_id' => 'required',
            'about' => 'required',
        ]);

        $users = User::find($id);
        $users->name = $request->name;
        $users->identitas = $request->identitas;
        $users->no_identitas = $request->no_identitas;
        $users->alamat = $request->alamat;
        $users->jenis_kelamin = $request->jenis_kelamin;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->role_id = $request->role_id;
        $users->about = $request->about;
        $users->save();

        Toastr::success('User Data Successfully Updated :))', 'Success');
        
        return redirect()->route('admin.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        Toastr::success('User Data Successfully Deleted :))', 'Success');
        return redirect()->back();
    }

    public function updateImage(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request,[
            'image' => 'mimes:jpeg,bmp,png,jpg',
        ]);

        if ($user->username == NULL){   
            $isSlug = str_slug($user->name);
        } else {
            $isSlug = str_slug($user->username);
        }

        $image = $request->file('image');
        $slug = $isSlug;
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

        Toastr::success('Image Profile Successfully Updated :))', 'Success');

        return redirect()->back();
    }
}

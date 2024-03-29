<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Country;
use App\Http\Requests\PostRegisterRequest;

class AdminRegisterController extends Controller
{
    public function GetRegister(){
        return view('admin.register.register');
    }
    public function PostRegister(PostRegisterRequest $request){
        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->password = bcrypt($request->password);
        $newUser->email = $request->email;
        $newUser->phone = $request->phone;
        $newUser->save();
        return redirect()->intended('admin/login');
    }
}

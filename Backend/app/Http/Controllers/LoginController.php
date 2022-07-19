<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    function login(){
        return view('auth.login');
    }
    function register(){
        return view('auth.register');
    }
    function save(Request $request){
        //Validate the request...
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6',
        ]);

        //Insert data into the database...
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();
        if($admin->save()){
            return back() -> with('success', 'Admin created successfully');
        }else{
            return back() -> with('error', 'Error creating admin');
        }
    }
    function check(Request $request){
        // Validate the request...
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        $userInfo = Admin::where('email',$request->email)->first();
        if(!$userInfo){
            return back() -> with('error', 'Invalid email or password');
        }else{
            //check password
            if(Hash::check($request->password, $userInfo->password)){
               $request->session()->put('userInfo', $userInfo->id);
               return redirect('admin/dashboard');
            }else{
                return back() -> with('error', 'Invalid email or password');
            }
        }
    }
    function dashboard(){
        return view('admin.dashboard');
    }
}

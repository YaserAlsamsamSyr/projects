<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\File;
class ProfileController extends Controller
{
    public function index(){
        return view('profile');
    }

    public function update(){
        $data=request()->validate([
            'name'=>['required','min:3'],
            'email'=>['required','email'],
            'password'=>['confirmed','min:8'],
            'img'=>['mimes:jpeg,jpg,png']
        ]);
        $userId=auth()->id();
        $user=User::findOrFail($userId);
        if(request()->has('password')){
            $data['password']=Hash::make(request('password'));   
        }
        // upload one image
        if(request()->hasfile('img')) {  
            $file=request()->file('img');
            $name = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('/images/users/'),$name);
            if($user->img!="no img"){
            $n=explode("/images/users/",$user->img)[1];
                if(File::exists(public_path().'/images/users/'.$n)) {
                    File::delete(public_path().'/images/users/'.$n);     
                }
            }
            //
            $data['img']=asset('/images/users/'.$name);
        }
        $user->update($data);
        return back();
    }
}

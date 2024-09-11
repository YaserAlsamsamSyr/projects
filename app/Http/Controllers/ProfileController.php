<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
        if(request()->has('password')){
            $data['password']=Hash::make(request('password'));   
        }
        if(request()->hasFile('img')){
            $path= request('img')->store('users');
            $data['img']=$path;
        }
        $userId=auth()->id();
        User::findOrFail($userId)->update($data);
        return back();
    }
}

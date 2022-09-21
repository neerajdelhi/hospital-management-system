<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;

class HomeController extends Controller
{
    //
	public function redirect(){
		
		if(Auth::id()){
			
			if(Auth::user()->usertype=='0'){
				return view('user.home');
			}
			elseif(Auth::user()->usertype=='1'){
					return view('admin.home');
			}
			
		}else{
			return redirect()->back();
		}
	}
	
	public function index(){
		$doctor = Doctor::all();
		return view('user.home', compact('doctor',$doctor));
	}
}

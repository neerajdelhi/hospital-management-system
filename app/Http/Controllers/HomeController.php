<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;

class HomeController extends Controller
{
    //
	public function redirect(){
		
		if(Auth::id()){
			
			if(Auth::user()->usertype=='0'){
				$doctor = Doctor::all();
				return view('user.home', compact('doctor',$doctor));
			}
			elseif(Auth::user()->usertype=='1'){
					$doctor = Doctor::all();
					return view('admin.home',compact('doctor',$doctor));
			}
			
		}else{
			return redirect()->back();
		}
	}
	
	public function index(){

		if(Auth::id()){
			return redirect('home');
		}
		$doctor = Doctor::all();
		return view('user.home', compact('doctor',$doctor));
	}

	public function appointment(Request $request){

		$validate = Validator::make($request->all(),
			[  
				'name' => 'required',
				'email' => 'required',
				'date' => 'required',
				'doctor' => 'required',
				'phone' => 'required',
				'message' => 'required',
				'user_id' => Auth::auth()->id,
			]
		);

		if($validate->failed()){
			return redirect('/')->with('fail','validation failed.');
		}

		$user_id = !empty(Auth::id()) ? (Auth::id()) : '';

		try{
			Appointment::create([
				'name' => $request->name,
				'email' => $request->email,
				'date' => $request->date,
				'doctor' => $request->date,
				'phone' => $request->phone,
				'message' => $request->message,
				'status' => 'In Progress',
				'user_id' => $user_id,
			]);
		}
		catch(\Exception $e){
			return redirect('/')->with('fail',$e->getMessage());
		}

		return redirect('/')->with('success','Appointment booked successfully.We will contact you soon.');
	}

	public function myappointment(){
		
		$doctor = Doctor::all();
		
		$user_id = Auth::user()->id;
		$appoint = Appointment::where('user_id',$user_id)->get();
		
		if(Auth::id())
		return view('user.home', compact('doctor','appoint'));

		return redirect()->back();
	}

	public function cancel_appointment($id){

		$appoint = Appointment::find($id);

		if($appoint->delete())
			return redirect('myappointments')->with('success','Appointment deleted successfully');
	}

	public function test(){
		return 'tesst';
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Doctor;

class AdminController extends Controller
{
    //
    public function addview(){
        return view('admin.add_doctor');
    }

    public function upload(Request $request){
        // $doctor = new Doctor;

        $file = $request->file;
        $imageName  = time().'.'.$file->getClientOriginalExtension();

        $request->file->move('doctorimage',$imageName);
        
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required',
            'room' => 'required',
            'specility' => 'required',
            'image' => $imageName,
        ]);


        if($validator->failed()){
            $this->redirect('/add_doctor_view')->with('fail','Validation rule failed');
        }

        try{
            Doctor::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'room' => $request->room,
                'speciality' => $request->speciality,
                'image' => $imageName
            ]);

            return redirect('/add_doctor_view')->with('success','Doctor add successfully!');
        } catch(\Exception $e){
            return redirect('/add_doctor_view')->with('fail',$e->getMessage());
        }

        
        
    }
}

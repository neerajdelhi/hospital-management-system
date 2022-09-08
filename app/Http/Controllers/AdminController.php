<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Doctor;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function addview(){
        return view('admin.add_doctor');
    }

    public function upload(Request $request){
        $doctor = new Doctor;

        $file = $request->file;
        $imageName  = time().'.'.$file->getClientOriginalExtension();

        $validator = Validator::make([
            'name' => 'required',
            'phone' => 'required',
            'room' => 'required'
        ]);


        if($validator->fails){
            $this->redirect('/')->with('data not saved');
        }else{
            $this->redirect('/')->with('success');
        }

        try{
            Doctor::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'room' => $request->room,
                'image' => $imageName
            ]);
        } catch(\Exception $e){
            return redirect('/')->with($e->Message());
        }

        
        
    }
}

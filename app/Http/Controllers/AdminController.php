<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 

class AdminController extends Controller
{
    //
    public function addview()
    {
        return view('admin.add_doctor');
    }

    public function upload(Request $request)
    {
        // $doctor = new Doctor;

        $file = $request->file;
        $imageName  = time() . '.' . $file->getClientOriginalExtension();

        $request->file->move('doctorimage', $imageName);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'room' => 'required',
            'specility' => 'required',
            'image' => $imageName,
        ]);


        if ($validator->failed()) {
            $this->redirect('/add_doctor_view')->with('fail', 'Validation rule failed');
        }

        try {
            Doctor::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'room' => $request->room,
                'speciality' => $request->speciality,
                'image' => $imageName
            ]);

            return redirect('/add_doctor_view')->with('success', 'Doctor add successfully!');
        } catch (\Exception $e) {
            return redirect('/add_doctor_view')->with('fail', $e->getMessage());
        }
    }

    public function showappointment()
    {

        $appointment = Appointment::all();

        return view('admin.showappointment', compact('appointment'));
    }

    public function appointmentApprove($id)
    {

        DB::beginTransaction();

        try {
            Appointment::find($id)->update([
                'status' => 'approved',
            ]);
            DB::commit();
            return redirect('/showappointment')->with('success', 'status updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/showappointment')->with('fail', $e->getMessage());
        }
    }

    public function appointmentCancel($id)
    {

        DB::beginTransaction();

        try {
            Appointment::find($id)->update([
                'status' => 'canceled',
            ]);
            DB::commit();
            return redirect('/showappointment')->with('success', 'status updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/showappointment')->with('fail', $e->getMessage());
        }
    }

    public function showdoctor()
    {

        $doctor = Doctor::all();
        return view('admin.showdoctor', compact('doctor'));
    }

    public function deletedoctor($id)
    {
        $doctor = Doctor::find($id);

        $doctor->delete();

        return redirect()->back();
    }

    public function edit($id)
    {

        $doctor = Doctor::find($id);

        return view('admin.add_doctor', compact('doctor'));
    }

    public function update_doctor(Request $request)
    {
    
        if ($request->file) {
            $file = $request->file;
            $imageName  = time() . '.' . $file->getClientOriginalExtension();
            
            $oldimageName = Doctor::where('id',$request->id)->pluck('image');
            // dd($oldimageName[0]);

            File::delete("doctorimage/$oldimageName[0]");
            // unlink(public_path('doctorimage/$oldimageName'));
            $request->file->move('doctorimage', $imageName);
        } else {
            $imageName = $request->file;
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'room' => 'required',
            'specility' => 'required',
        ]);


        if ($validator->failed()) {
            $this->redirect('/add_doctor_view')->with('fail', 'Validation rule failed');
        }

        try {

            $doctor = Doctor::where('id',$request->id)->first();

            $doctor->name = $request->name;
            $doctor->phone = $request->phone;
            $doctor->room = $request->room;
            $doctor->speciality = $request->speciality;
            if (isset($imageName))
                $doctor->image = $imageName;

            $doctor->save();

            return redirect("/edit/$doctor->id")->with('success', 'Doctor updated successfully!');
        } catch (\Exception $e) {
            return redirect('/add_doctor_view')->with('fail', $e->getMessage());
        }
        return $request->all();
    }
}

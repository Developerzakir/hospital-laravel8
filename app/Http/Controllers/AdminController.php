<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
Use App\Models\Appoinment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendMailNotification;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function createDoctor()
    {

        if(Auth::id()){
            if(Auth::user()->usertype==1){
             return view('admin.add_doctor');

            }else{
                return redirect()->back();
            }
        }else{
            return redirect('login');
        }
    }

    public function storeDoctor(Request $request)
    {

        $doctor = new Doctor();

        $image = $request->image;
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('uploads/',$imageName);
        $doctor->doctor_image = $imageName;

        $doctor->doctor_name = $request->doctor_name;
        $doctor->doctor_phone = $request->doctor_phone;
        $doctor->doctor_room = $request->doctor_room;
        $doctor->doctor_speciality = $request->doctor_speciality;

        $doctor->save();

        return redirect('/add-doctor')->with('message', 'Doctor Added Successfully!');
    }

    public function show_appointment()
    {
        $appointment = Appoinment::all();
        return view('admin.showappointment', compact('appointment'));
    }

    public function approved($id)
    {
        $data = Appoinment::find($id);
        $data->status = 'approved';
        $data->save();

        return redirect()->back()->with('message', 'Appointment Approved!');
    }
    public function cancel($id)
    {
        $data = Appoinment::find($id);
        $data->status = 'Canceled';
        $data->save();

        return redirect()->back()->with('message', 'Appointment Canceled!');
    }

    public function show_doctors()
    {
        $data = Doctor::all();
        return view('admin.showdoctors', compact('data'));
    }

    public function destroyDoctor($id)
    {
        $doctor = Doctor::find($id);
        if($doctor->doctor_image){

            $path = 'uploads/'.$doctor->doctor_image;
            if(File::exists($path)){
                File::delete($path);
            }
         }
        $doctor->delete();

        return redirect()->back()->with('message', 'Doctor Deleted!');

    }

    public function editDoctor($id)
    {
        $data = Doctor::find($id);
        return view('admin.updateDoctor', compact('data'));
    }

    public function updateDoctor(Request $request, $id)
    {
        $data = Doctor::find($id);
        $data->doctor_name       = $request->doctor_name;
        $data->doctor_phone      = $request->doctor_phone;
        $data->doctor_speciality = $request->doctor_speciality;
        $data->doctor_room       = $request->doctor_room;

        if($request->hasFile('doctor_image'))

        {
            $path = 'uploads/'.$data->doctor_image;

            if(File::exists($path))

            {

                File::delete($path);

            }

            $file = $request->file('doctor_image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/',$filename);
            $data->doctor_image = $filename;

            
        }

        $data->save();
        return redirect('/show-doctors')->with('message', 'Doctor data updated!');

    }

    public function emailView($id)
    {
        $data = Appoinment::find($id);
        return view('admin.email_view', compact('data'));

    }

    public function sendEmail(Request $request, $id)
    {
        $data = Appoinment::find($id);

        $details = [
            'greeting'    =>$request->greeting,
            'body'        =>$request->body,
            'action_text' =>$request->action_text,
            'action_url'  =>$request->action_url,
            'end_part'    =>$request->end_part,
        ];
        Notification::send($data, new SendMailNotification($details));

        return redirect()->back()->with('message', 'Mail send Successfully Done!');

    }

  

}

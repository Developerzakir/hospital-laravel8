<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appoinment;


class HomeController extends Controller
{
    public function redirect()
    {

        if(Auth::id()){

            if(Auth::user()->usertype == '0'){
                $doctor = Doctor::all();
                return view('user.home', compact('doctor'));
            }
            else{
                return view('admin.home');
            }

        }else{
            return redirect()->back();
        }

    }

    public function index()
    {
        if(Auth::id()){
            return redirect('home');
        }
        else{
            $doctor = Doctor::all();
            return view('user.home', compact('doctor'));
        }
       
    }


    public function appointment(Request $request)
    {

        $appointMent  = new Appoinment();
    
        $appointMent->name     = $request->name;
        $appointMent->email    = $request->email;
        $appointMent->date     = $request->date;
        $appointMent->phone    = $request->phone;
        $appointMent->message  = $request->message;
        $appointMent->doctor   = $request->doctor;
       

        $appointMent->status   = 'In progress';

        if(Auth::id()){
            $appointMent->user_id  = Auth::user()->id;
        }
     
        $appointMent->save();

        return redirect()->back()->with('message', 'Successfully appoinment request');

    }


    public function myappointment()
    {
        if(Auth::id()){

            $userId = Auth::user()->id;
            $appointment = Appoinment::where('user_id', $userId)->get();

            return view('user.my_appointment', compact('appointment'));
        }else{
            return redirect()->back();
        }
    }

    public function cancel_appointment($id)
    {
        $data = Appoinment::find($id);

        $data->delete();

        return redirect()->back()->with('message', 'Your Appointment cancel successfully done');

    }
}

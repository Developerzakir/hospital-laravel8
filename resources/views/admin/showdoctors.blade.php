@extends('admin.home')

@section('content')

<div class="container-fluid page-body-wrapper">

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">

            @if(session('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{session('message')}}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
        
            <table class="table table-bordered">
                <thead>
                    <tr class="text-light">
                        <th>Doctor Name</th>
                        <th>Doctor Phone</th>
                        <th>Doctor Speciality</th>
                        <th>Doctor Room</th>
                        <th>Doctor Photo</th>
                        <th>Created At</th>  
                        <th>Edit/Delete</th>  
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach( $data as $doctor)
                    <tr>
                        <td>{{$doctor->doctor_name}}</td>
                        <td>{{$doctor->doctor_phone}}</td>
                        <td>{{$doctor->doctor_speciality}}</td>
                        <td>{{$doctor->doctor_room}}</td>
                        <td>
                        <img src="{{asset('uploads/'.$doctor->doctor_image )}}" width="80px" height="80px" alt="">
                        </td>
                        <td>{{$doctor->created_at->format('d-m-Y')}}</td>     
                        <td>
                            <a href="{{url('edit-doctor',$doctor->id)}}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{url('destroy-doctor',$doctor->id)}}" onclick="return confirm('are you sure want to delete?')" class="btn btn-danger btn-sm">Delete</a>
                            
                        </td>     
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

@endsection
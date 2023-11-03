@extends('admin.home')

@section('content')

<div class="container-fluid page-body-wrapper">

<div class="container">
    <div class="row">
        <div class="col-md-12">
          

            <form  action="{{url('update-doctor', $data->id)}}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                  <label for="name" class="form-label">Doctor Name</label>
                  <input type="text" class="form-control" value="{{$data->doctor_name}}" name="doctor_name" placeholder="Enter Doctor Name">
                </div>
    
                <div class="mb-3">
                    <label for="phone" class="form-label">Doctor Phone</label>
                    <input type="number" class="form-control" value="{{$data->doctor_phone}}" name="doctor_phone" placeholder="Enter Doctor phone">
                </div>
    
                <div class="mb-3">
                    <label for="" class="form-label">Doctor Speciality</label>
                   <input type="text" class="form-control" name="doctor_speciality" value="{{$data->doctor_speciality}}">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Doctor Room</label>
                    <input type="text" class="form-control" value="{{$data->doctor_room}}"  name="doctor_room" placeholder="Enter Doctor Room No">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Doctor Image</label>
                    <input type="file" class="form-control" name="doctor_image">
                    <img src="{{asset('uploads/'.$data->doctor_image)}}" alt="">
                </div>
                
              
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
        </div>
    </div>
</div>
</div>



@endsection
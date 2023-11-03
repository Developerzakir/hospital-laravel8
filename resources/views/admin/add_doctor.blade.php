@extends('admin.home')

@section('content')

<div class="container-fluid page-body-wrapper">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('message'))
            <div class="alert alert-success" data-dismiss="alert">{{session('message')}}</div>
            @endif

            <form action="{{url('store-doctor')}}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                  <label for="name" class="form-label">Doctor Name</label>
                  <input type="text" class="form-control" name="doctor_name" placeholder="Enter Doctor Name">
                </div>
    
                <div class="mb-3">
                    <label for="phone" class="form-label">Doctor Phone</label>
                    <input type="number" class="form-control" name="doctor_phone" placeholder="Enter Doctor phone">
                </div>
    
                <div class="mb-3">
                    <label for="" class="form-label">Doctor Speciality</label>
                    <select class="form-control" name="doctor_speciality">
                        <option selected>Select Doctor Specialists</option>
                        <option value="Neurosurgeons">Neurosurgeons</option>
                        <option value="Orthopedic surgeons">Orthopedic surgeons</option>
                        <option value="Cardiologists">Cardiologists</option>
                      </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Doctor Room</label>
                    <input type="text" class="form-control" name="doctor_room" placeholder="Enter Doctor Room No">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Doctor Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
                
              
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div>
</div>



@endsection
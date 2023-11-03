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
                        <th>Patient Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Doctor Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Approved/Cancel</th>
                        <th>Send Mail</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach( $appointment as $patient)
                    <tr>
                        <td>{{$patient->name}}</td>
                        <td>{{$patient->email}}</td>
                        <td>{{$patient->phone}}</td>
                        <td>{{$patient->doctor}}</td>
                        <td>{{$patient->date}}</td>
                        <td>{{$patient->status}}</td>
                        <td>
                            <a class="btn btn-success btn-sm" href="{{url('approved',$patient->id)}}">Approved</a>
                            <a class="btn btn-danger btn-sm" href="{{url('cancel',$patient->id)}}">Cancel</a>
                        </td>
                        <td>
                            <a href="{{url('email-view',$patient->id)}}" class="btn btn-primary btn-sm">Send Mail</a>
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
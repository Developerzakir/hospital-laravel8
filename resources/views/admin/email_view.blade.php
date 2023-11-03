@extends('admin.home')

@section('content')

<div class="container-fluid page-body-wrapper">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('message'))
            <div class="alert alert-success" data-dismiss="alert">{{session('message')}}</div>
            @endif

            <form action="{{url('send-email', $data->id)}}" method="POST">

                @csrf

                <div class="mb-3">
                  <label for="name" class="form-label">Greeting</label>
                  <input type="text" class="form-control" name="greeting">
                </div>
    
                <div class="mb-3">
                    <label for="phone" class="form-label">Body</label>
                    
                    <textarea name="body" id=" " class="form-control"  rows="5"></textarea>
                </div>
    

                <div class="mb-3">
                    <label for="" class="form-label">Action Text</label>
                    <input type="text" class="form-control" name="action_text">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Action Url</label>
                    <input type="text" class="form-control" name="action_url">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">End Part</label>
                    <input type="text" class="form-control" name="end_part">
                </div>

               
              
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div>
</div>



@endsection
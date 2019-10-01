@extends('layouts.app')

@section('content')
    
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <a class="btn btn-secondary" href="{{route('dashboard')}}">Back</a>
        <div class="card">
            <div class="card-header">
            <div class="row justify-content-between">
                <p class="h1">
                        DETAILS OF {{strtoupper($user->name)}}
                    </p>
                    <p class="float-right"><strong>
                        {{strtoupper($user->department)}}
                    </strong>
                    |
                    {{strtoupper($user->position)}}
                </p>
            </div>
            </div>
            <div class="card-body">
                <div class="row">

                    <h3 class="ml-3">Employment status: <u>{{$user->emp_status}}</u></h3>
                    <button class="btn btn-danger float-right" style="margin-left:500px">Terminate</button>

                    @if ($user->emp_status != 'REGULAR')
                    
                        <button class="btn btn-success ml-5" 
                        data-myid="{{$user->id}}" data-myname="{{$user->name}}" data-mystatus="{{$user->emp_status}}"
                        data-toggle="modal" data-target="#promote" >Promote</button>

                    @endif

                    
                </div>
                <hr>
                <div class="row">

                    <div class="col-md-6">
                        <label for="name">Employee Name</label>
                        <input type="text" name="name" class="form-control" required value="{{$user->name}}">
                    </div>
                        {{-- <div class="col-md-6">
                            <label for="hired">Date Hired</label>
                            <input type="date" name="hired" id="hired" class="form-control mb-3" required value="{{$user->date_hired}}">
                        </div> --}}
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="email">Username</label>
                            <input type="text" name="email" class="form-control" required value="{{$user->email}}">
                        </div>
                    </div>

                    <hr>
            
                    <div class="row">

                        <div class="col-md-6">

                            <label for="rate"><strong>DAILY RATE:</strong></label>
                            <input type="number" name="rate" class="form-control" required value="{{$user->rate}}" min="1" max="10000">
                        </div>
                        <div class="col-md-6">

                            <label for="inlineRadio1">WEEKS OF TRAINING:</label>
                            <input type="number" name="weeks_of_training"  class="form-control" required value="{{$user->weeks_of_training}}" min="1" max="10000">
                        </div>
                    </div>

            </div>

            <div class="card-footer">
                <a href="" class="btn btn-primary float-right">Save Changes</a>
            </div>
        </div>
    </div>


    <div class="modal fade" id="promote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('employee.promote',$user->id)}}" method="POST">
        <div class="modal-dialog" role="document">
          <div class="modal-content modal-lg">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">PROMOTION</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
                    @csrf
                    {{-- @method('PATCH') --}}
                    <h3>
                        <p class="ml-3">Are you sure you want to promote:  </p>
                            <strong><label id="myname" class="ml-3"></label></strong>
                        <p class="ml-3">Employee will be promoted as:  </p>
                        <strong>
                            <h3>
                            <label id="mystatus" class="ml-3 badge badge-success" ></label>
                            </h3>
                        </strong>
                    </h3>
                    
                    <input type="text" name="myid" id="myid" hidden>
                    <a href="" class="badge badge-light" name="myname" id="myname"></a>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Continue</button>
                </div>
                
            </div>
        </div>
    </form>
    </div>

    
@endsection
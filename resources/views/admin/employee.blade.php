@extends('layouts.app')

@section('content-dashboard')

    <div class="container">

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $err)
                    <li>{{$err}}</li>
                @endforeach
            </div>
        @endif

        <a class="btn btn-secondary" href="{{route('dashboard')}}">Back</a>
        <div class="card">
            @csrf
            <div class="card-header">
                <div class="row justify-content-between">

                    <p class="h1 ml-3">
                        DETAILS OF {{strtoupper($user->name)}}
                    </p>
                    <p class="float-right"><strong>
                        {{strtoupper($user->department)}}
                        </strong>|
                        {{strtoupper($user->position)}}
                    </p>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <h3 class="ml-3 ">Employment status: <u>{{$user->emp_status}}</u></h3>

                    <h3 class="ml-5 ">Salary type: <u>{{$user->salary_type}}</u></h3>

                    <button class="btn btn-danger float-right" style="margin-left:200px"
                        data-myid="{{$user->id}}" data-myname="{{$user->name}}"
                        data-target="#terminate" data-toggle="modal">Terminate</button>

                    @if ($user->emp_status != 'REGULAR')
                        <button class="btn btn-success ml-5"
                        data-myid="{{$user->id}}" data-myname="{{$user->name}}" data-mystatus="{{$user->emp_status}}"
                        data-toggle="modal" data-target="#promote" >Promote</button>
                    @endif
                </div>
                <hr>
                <form action="{{route('employee.editEmp', $user->id)}}" method="post">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Employee Name</label>
                            <input type="text" name="name" class="form-control" required value="{{$user->name}}" disabled>

                        </div>
                        <div class="col-md-6">
                            {{-- <a class="btn btn-primary float-right" onclick="runedit()"><i class="fas fa-pencil-alt"></i></a> --}}
                            <label for="email">Username</label>
                            <input type="text"  id="email" name="email" class="form-control" required value="{{$user->username}}" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="rate"><strong>DAILY RATE:</strong></label>
                            <input type="number"  id="rate" name="rate" class="form-control" required value="{{$user->rate}}" min="1" max="10000" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="inlineRadio1">WEEKS OF TRAINING:</label>
                            <input type="number"  id="weeks_of_training" name="weeks_of_training"  class="form-control" required value="{{$user->weeks_of_training}}" min="1" max="10000" disabled>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right">Save Changes</a>
                </form>
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

            <div class="modal-body text-center">
                @csrf
                {{-- @method('PATCH') --}}
                <h3>
                    <p class="ml-3">Are you sure you want to promote:  </p>
                        <strong><label id="myname" class="ml-3"></label></strong>
                    <p class="ml-3">Employee will be promoted to:  </p>
                    <strong>
                        <h3>
                        <label id="mystatus" class="ml-3 badge badge-success" ></label>
                        </h3>
                    </strong>
                </h3>
                <input type="text" name="myid" id="myid" hidden>
                <a href="" class="badge badge-light" name="myname" id="myname"></a>
                <div class="row">

                    <div class="col-md-6">
                        <label for="new_rate">Enter New Rate / Day:</label>
                        <input type="number" name="new_rate" min="1" max="999999" class="form-control" required value="{{old('new_rate')}}">
                    </div>
                    <div class="col-md-6">
                        @if ($user->emp_status == 'TRAINEE')
                            <label for="new_rate">Enter Weeks as Probationary:</label>
                            <input type="number" name="new_training" min="1" max="999999" class="form-control" required value="{{old('new_training')}}">
                        @endif
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Continue</button>
                </div>

            </div>
        </div>
        </form>
    </div>

    <div class="modal fade" id="terminate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{route('employee.terminate',$user->id)}}" method="POST">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-lg">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">TERMINATE</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body text-center">
                    @csrf
                    <h3>
                        <p class="ml-3">Are you sure you want to TERMINATE:  </p>
                            <strong><label id="mynameterminate" class="text-center"></label></strong>
                            <p>This cannot be undone</p>
                    </h3>
                    <input type="text" name="myidterminate" id="myid" hidden>
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

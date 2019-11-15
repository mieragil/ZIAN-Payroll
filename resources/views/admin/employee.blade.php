@extends('layouts.app')

@section('content-dashboard')

    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
                <p>Please set the employee's deductions.</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $err)
                    <li>{{$err}}</li>
                @endforeach
            </div>
        @endif


        <div class="row">

            <div class="col-lg-9">
                <div class="card shadow">
                    @csrf
                    <h4 class="card-header text-light bg-dark">
                        <a class="btn btn-light mr-2" href="{{route('dashboard')}}"><i class="fas fa-arrow-left"></i> Back</a> EMPLOYEE DETAILS
                    </h4>
                    <div class="card-body">
                            <div class="jumbotron py-5 jumbotron-fluid">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h1 class="display-5">{{strtoupper($user->name)}}</h1>
                                            <h5 class="lead">{{strtoupper($user->department)}} | {{strtoupper($user->position)}}</h5>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="text-secondary">Employee's Username</small>
                                            <p class="lead">{{$user->username}}</p>
                                            <small class="text-secondary">Employment Status</small>
                                            <p class="lead">{{$user->emp_status}}</p>
                                            <small class="text-secondary">Salary Type</small>
                                            <p class="lead">{{$user->salary_type}}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="text-secondary">Employee's time-in</small>
                                            <p class="lead">{{$in}}</p>
                                            <small class="text-secondary">Employee's time-out</small>
                                            <p class="lead">{{$out}}</p>
                                            <small class="text-secondary">Employee's day-off</small>
                                            <p class="lead">{{$day}}</p>
                                        </div>
                                    </div>

                                    <hr>

                                </div>
                            </div>

                        <form action="{{route('employee.editEmp', $user->id)}}" method="post">
                            @method('PATCH')
                            @csrf
                            <div class="text-right">
                                <hr>
                                <a id="editemp" href="#" class="text-primary">edit <i class="fas fa-pencil-alt"></i></a>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Employee Name</label>
                                    <input type="text" name="name" class="form-control" required value="{{$user->name}}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="email">Username</label>
                                    <input type="text"  id="email" name="email" class="form-control" required value="{{$user->username}}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Employee's Rquired Time-in</label>

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="rate"><strong>DAILY RATE:</strong></label>
                                    <input type="number"  id="rate" name="rate" class="form-control" required value="{{$user->rate}}" min="1" max="10000" disabled>
                                </div>
                                <div class="col-md-3">
                                    <label for="inlineRadio1">WEEKS OF TRAINING:</label>
                                    <input type="number"  id="weeks_of_training" name="weeks_of_training"  class="form-control" required value="{{$user->weeks_of_training}}" min="1" max="10000" disabled>
                                </div>
                            </div>
                            <div class="text-right py-3" id="divsave" style="display:none">
                                <button class="btn btn-secondary mr-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">Save Changes</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card shadow">
                    <h4 class="card-header bg-secondary text-light">Actions</h4>
                    <div class="card-body">
                            @if ($user->emp_status != 'REGULAR')
                                    <button class="btn btn-success btn-lg btn-block"
                                    data-myid="{{$user->id}}" data-myname="{{$user->name}}" data-mystatus="{{$user->emp_status}}"
                                    data-toggle="modal" data-target="#promote" >Promote</button>
                                @endif
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            <br>
                            <button class="btn btn-outline-danger btn-lg btn-block"
                                data-myid="{{$user->id}}" data-myname="{{$user->name}}"
                                data-target="#terminate" data-toggle="modal">Terminate</button>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

                    </div>
                </div>
            </div>
        </div>


    </div>








    {{-- <form action="{{route('attendance.store',$user->id)}}" method="post">
    <div class="card">
            @csrf
            <div class="card-body">
                <input type="text" name="emp_id" id="emp_id" value="{{$user->id}}">
                <button type="submit">submit</button>
            </div>
        </div>
    </form> --}}


    <div class="modal fade" id="promote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{route('employee.promote',$user->id)}}" method="POST">
        <div class="modal-dialog" role="document">
          <div class="modal-content modal-lg">
            <div class="modal-header text-light bg-success">
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
                    <button type="submit" class="btn btn-success">Continue</button>
                </div>
            </div>
        </div>
        </form>
    </div>

    <div class="modal fade" id="terminate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{route('employee.terminate',$user->id)}}" method="POST">
            <div class="modal-dialog" role="document">
              <div class="modal-content modal-lg">
                <div class="modal-header text-light bg-danger">
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
                            <br>
                            This cannot be undone

                    </h3>
                    <input type="text" name="myidterminate" id="myid" hidden>
                    <a href="" class="badge badge-light" name="myname" id="myname"></a>
                </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-danger">Continue</button>
                    </div>

                </div>
            </div>
        </form>
    </div>



@endsection

@extends('layouts.app')

@section('content-dashboard')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-5">
            <div class="card text-center mb-3 shadow">
                <div class="card-body">
                    <h3 class="card-title muted">Hello {{Auth::user()->name}}!</h3>
                    <p class="card-text">Welcome to Zian's Payroll Management System.</p>
                    <h1 class="text-secondary font-weight-bold">{{ date("h:i A") }}</h1>
                    <p class="text-secondary"> {{ date("l") }}</p>
                    <p class="text-secondary"> {{ date("M. d, Y") }}</p>
                </div>
            </div>

            <div class="card shadow ">
                <h5 class="card-header text-light bg-info">
                    Incoming Holidays
                </h5>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col" class="text-info">Holiday Name</th>
                            <th scope="col" class="text-info">Date</th>
                            <th scope="col" class="text-info">Day</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($holidays as $item)
                            <tr  class="text-muted">
                                <td>{{$item->holiday_name}}</td>
                                <td>{{date("M. d, Y", strtotime($item->holiday_date))}}</td>
                                <td>{{$item->holiday_day}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                      </table>
                      <small><i> <p class="text-muted">Make sure to always update the list of Holidays in the settings.</p></i></small>
                </div>
            </div>



        </div>
        <div class="col-lg-7">
            <div class="row">
                <div class="col-4">
                    <div class="card text-white bg-primary mb-3 shadow" style="max-width: 18rem;">
                    <div class="card-body">
                    <h2><i class="far fa-building mr-3"></i></i> {{count($department)}}</h2>
                        <p class="card-text text-white">Departments</p>
                        <hr class="bg-white">
                    <div class="text-right"><small><a href="{{'/settings'}}"class="text-light">Show All</a></small></div>
                    </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-white bg-success mb-3 shadow" style="max-width: 18rem;">
                    <div class="card-body">
                        <h2><i class="fas fa-user-friends mr-3"></i>{{count($users)}}</h2>
                        <p class="card-text text-white">Total Employees</p>
                        <hr class="bg-white">
                    <div class="text-right"><small><a href="{{route('dashboard')}}"class="text-light">Show All</a></small></div>
                    </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-white orange mb-3 shadow" style="max-width: 18rem;">
                    <div class="card-body">
                    <h2><i class="fas fa-plane-departure mr-3"></i>{{count($leave)}}</h2>
                        <p class="card-text text-white">On Leave</p>
                        <hr class="bg-white">
                    <div class="text-right"><small><a href="{{route('leave')}}"class="text-light">Show All</a></small></div>
                    </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3 shadow bg-secondary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <h2 class="text-white"><i class="fas fa-clock"></i> <span class="{{count($overtime) > 0 ? 'badge badge-danger bounce ' : ''}}">{{count($overtime)}}</span></h2>
                                        <p class="card-text text-white">Overtime Requests</p>
                                    </div>
                                    <div class="col-3 text-right">
                                        <small><a href="#" class="text-light" data-toggle="modal" data-target="#overtime">Show All</a></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            <div class="row">
                <div class="col-lg-12">
                        <div class="card mb-3 shadow">
                            <div class="card-body">
                                    <h3><small class="text-muted">TIME IN TODAY</small></h3>
                                    {{-- <h1 class="text-secondary display-4"> Time In<span class="text-primary"> Today</span></h1> --}}
                                    <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th scope="col" class="text-secondary">Emp ID</th>
                                            <th scope="col" class="text-secondary">Employee</th>
                                            <th scope="col" class="text-info"><i class="fas fa-clock"></i> Time In</th>
                                            <th scope="col" class="text-danger"><i class="far fa-clock"></i> Time Out</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($attendance as $item)

                                            <tr>
                                            <th scope="row">{{$item->id}}</th>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->time_in}}</td>
                                            <td>{{$item->time_out}}</td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                      </table>
                                      <hr>
                                    <div class="text-right"><small><a href="{{route('attendance')}}"class="">Show All</a></small></div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- overtime modal --}}

<div class="modal fade" id="overtime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="text-primary">Here are the lists of Overtime Requests</p>

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Reason of OT</th>
                        <th scope="col">Minutes of OT</th>
                        <th scope="col">Date of OT</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($overtime as $x)
                    <tr>
                        <td>{{$x->name}}</td>
                        <td>{{$x->reason}}</td>
                        <td>{{$x->reason}}</td>
                        <td>{{date("F jS, Y", strtotime($x->date))}}</td>
                        <td>
                            <form action="{{route('OT.status', $x->emp_id)}}" method="post">
                                @csrf
                                <button class="btn btn-primary btn-sm" name="status" value="accepted">Accept OT</button>
                                <button class="btn btn-danger btn-sm" name="status" value="declined">Decline OT</button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

@endsection

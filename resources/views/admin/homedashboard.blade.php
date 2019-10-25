@extends('layouts.app')

@section('content-dashboard')
<div class="container-fluid">
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
            <div class="card shadow">
                <h4 class="card-header bg-secondary text-light">
                    <div class="row">
                        <div class="col-md-10">
                                Holidays List
                        </div>
                        <div class="col-md-2 text-right">
                            <button class="btn btn-sm btn-primary shadow" data-target="#new-holiday" data-toggle="modal"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>


                </h4>
                <div class="card-body">
                        <table class="table table-hover">
                                <thead>
                                  <tr class="text-secondary">
                                    <th scope="col">Holiday Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Day</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($holidays as $item)
                                        <tr>
                                            <td>{{$item->holiday_name}}</td>
                                            <td>{{date("M. d, Y", strtotime($item->holiday_date))}}</td>
                                            <td>{{$item->holiday_day}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="row">
                <div class="col-4">
                    <div class="card text-white bg-primary mb-3 shadow" style="max-width: 18rem;">
                    <div class="card-body">
                    <h2><i class="far fa-building mr-3"></i></i> {{count($department)}}</h2>
                        <p class="card-text">Departments</p>
                        <hr class="bg-white">
                    <div class="text-right"><small><a href="{{'/settings'}}"class="text-light">Show All</a></small></div>
                    </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-white bg-success mb-3 shadow" style="max-width: 18rem;">
                    <div class="card-body">
                        <h2><i class="fas fa-user-friends mr-3"></i>{{count($users)}}</h2>
                        <p class="card-text">Total Employees</p>
                        <hr class="bg-white">
                    <div class="text-right"><small><a href="{{route('dashboard')}}"class="text-light">Show All</a></small></div>
                    </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-white orange mb-3 shadow" style="max-width: 18rem;">
                    <div class="card-body">
                    <h2><i class="fas fa-plane-departure mr-3"></i>{{count($leave)}}</h2>
                        <p class="card-text">On Leave</p>
                        <hr class="bg-white">
                    <div class="text-right"><small><a href="{{route('leave')}}"class="text-light">Show All</a></small></div>
                    </div>
                    </div>
                </div>
            </div>
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

{{-- New holiday modal --}}
<div class="modal fade" id="new-holiday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{route('newHoliday')}}" method="POST">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-lg">
                <div class="modal-header text-light bg-primary">
                    <h3>Add Holiday</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <br>
                    <p class="mb-0">Holiday Name:</p>
                    <input type="text" class="form-control" name="holiday_name" id="edit-position" placeholder="holiday name" required>
                    <br>
                    <p class="mb-0">Date:</p>
                    <input type="date" name="holiday_date" id="hired" class="form-control new-employee-input mb-3" required value="{{old('hired')}}">
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">SAVE</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- New holiday modal  --}}
@endsection

@extends('layouts.app')

@section('content-dashboard')
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card mb-3 shadow">
            <h4 class="card-header text-light bg-secondary">ATTENDANCE</h4>
            <div class="card-body">
                <form action="{{route('attendance.seekdate')}}" method="POST">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="input-group">
                            <h4 class="mr-3"><small class="text-muted">SELECT EMPLOYEE</small></h4>
                            <select class="form-control" name="name" id="employees" required>
                                <option value="">--ALL--</option>
                                @foreach ($users as $item)
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="input-group">

                            <h4 class="mr-3"><small class="text-muted">SELECT DATE</small></h4>
                            <input type="date" name="date" id="date" class="form-control mb-3" required value="{{date('Y-m-d')}}">
                            <span class="input-group-btn">
                                @csrf
                                <button class="btn btn-primary px-3 mx-3">SEARCH</button>
                            </span>
                        </div>
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col" class="text-secondary">#</th>
                                    <th scope="col" class="text-secondary">Employee</th>
                                    <th scope="col" class="text-info">Time In</th>
                                    <th scope="col" class="text-danger">Time Out</th>
                                    <th scope="col" class="text-primary">Status</th>
                                    <th scope="col" class="text-secondary">Date</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendance as $item)
                                        <tr>
                                            <th scope="row">{{$item->id}}</th>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->time_in}}</td>
                                            <td>{{$item->time_out}}</td>
                                            <td><i class="fas fa-circle mr-2 text-success"></i> Present</td>
                                            <td>{{date("M. d, Y", strtotime($item->attend_date))}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>

                    </div>
                </div>
        </div>
</div>


@endsection

@extends('layouts.app')

@section('content-dashboard')
<div class="container-fluid">
        <div class="col-lg-12">
                <div class="card mb-3 shadow">
                    <h4 class="card-header text-light bg-secondary">ATTENDANCE</h4>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">

                                <div class="input-group">
                                    <h4 class="mr-3"><small class="text-muted">SELECT EMPLOYEE</small></h4>
                                    <select class="form-control" name="id" id="employees" required>
                                        <option value="">--ALL--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">

                                    <div class="input-group">
                                            <h4 class="mr-3"><small class="text-muted">SELECT DATE</small></h4>
                                            <input type="date" name="hired" id="hired" class="form-control mb-3" required value="{{old('hired')}}">
                                            <span class="input-group-btn">
                                            <button class="btn btn-primary px-3 mx-3">SEARCH</button>
                                            </span>
                                        </div>
                                </div>
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
                                        <td>{{$item->attend_date}}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                              </table>

                    </div>
                </div>
        </div>
</div>


@endsection

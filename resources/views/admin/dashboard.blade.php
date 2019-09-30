@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            {{-- Error message --}}
            @if ($errors->any())
                <p class="badge badge-danger"><h3>Error in adding new employee:</h3></p>
                @foreach ($errors->all() as $error)
                    <p style="color:red">{{$error}}</p>
                @endforeach
            @endif

            <h3 class="title">
                You are logged in, 
                <strong>
                    {{Auth::user()->name}}!
                </strong>
            </h3>

            <div class="card mt-3">
                <div class="card-header">ADMIN DASHBOARD</div>

                <div class="card-body">

                    {{-- Success message --}}
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Employee table --}}
                    <table class="table table-bordered table-hover table-striped table-dark">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Employee Name</th>
                                <th scope="col">Department</th>
                                <th scope="col">Position</th>
                                <th scope="col">Rate / Day</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="col">{{$user->name}}</th>
                                <th scope="col">{{$user->department}}</th>
                                <th scope="col">{{$user->position}}</th>
                                <th scope="col">{{$user->rate}}</th>
                                <th scope="col"><a href="{{route('employee.show', $user->id)}}" class="btn btn-success">View Employee</a></th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

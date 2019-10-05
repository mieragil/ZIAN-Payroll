@extends('layouts.app')

@section('content-dashboard')

<div class="container-fluid">

    <div class="row">

        <div class="col-lg-12">

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

            <div class="card mt-3 col-md-10 offset-1">
                <div class="card-header">ADMIN DASHBOARD</div>

                <div class="card-body">

                    {{-- Success message --}}
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Employee table --}}
                    <table class="table table-bordered table-hover table-striped table-dark table-fluid">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Employee Name</th>
                                <th scope="col">Department</th>
                                <th scope="col">Position</th>
                                <th scope="col">Rate / Day</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td scope="col">{{$user->name}}</td>
                                <td scope="col">{{$user->department}}</td>
                                <td scope="col">{{$user->position}}</td>
                                <td scope="col">{{$user->rate}}</td>
                                <td class="">

                                    <div class="text-center">
                                        <a href="{{route('employee.show', $user->id)}}" class="btn btn-success ">
                                                <i class="far fa-eye"></i>&nbsp;View Details</a>
                                        <a href="{{route('employee.accountability', $user->id)}}" class="btn btn-secondary ">
                                                <i class="fas fa-archive"></i>&nbsp;Accountability</a>
                                        <a href="{{route('leave.show', $user->id)}}" class="btn btn-warning ">
                                                <i class="fas fa-plane-departure"></i>&nbsp;Leave</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            {{$users->links()}}
        </div>
    </div>
</div>

@endsection

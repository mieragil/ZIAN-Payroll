@extends('layouts.app')

@section('content-dashboard')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5">
            <div class="card text-center mb-3 shadow">
                <div class="card-body">
                    <h4 class="card-title">Hello {{Auth::user()->name}}!</h4>
                    <p class="card-text">Welcome to Zian's Payroll Management System.</p>
                    <h1 class="text-secondary font-weight-bold">12:36 PM</h1>
                   <p class="text-secondary">Oct 6, 2019</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="row">
                <div class="col-4">
                    <div class="card text-white bg-primary mb-3 shadow" style="max-width: 18rem;">
                    <div class="card-body">
                        <h2><i class="far fa-building mr-3"></i></i> 3</h2>
                        <p class="card-text">Departments</p>
                        <hr class="bg-white">
                        <div class="text-right"><small><a href=""class="text-light">Show All</a></small></div>
                    </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-white bg-success mb-3 shadow" style="max-width: 18rem;">
                    <div class="card-body">
                        <h2><i class="fas fa-user-friends mr-3"></i>65</h2>
                        <p class="card-text">Total Employees</p>
                        <hr class="bg-white">
                        <div class="text-right"><small><a href=""class="text-light">Show All</a></small></div>
                    </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-white bg-danger mb-3 shadow" style="max-width: 18rem;">
                    <div class="card-body">
                        <h2><i class="fas fa-plane-departure mr-3"></i>2</h2>
                        <p class="card-text">On Leave</p>
                        <hr class="bg-white">
                        <div class="text-right"><small><a href=""class="text-light">Show All</a></small></div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@extends('layouts.app')

@section('content-dashboard')

    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <h5 class="card-header bg-dark text-light">Deductions</h5>
                <div class="card-body">
                    <table class="table table-hover">
                    <thead>
                        <tr>

                        <th scope="col">Employee</th>
                        <th scope="col">PHIC</th>
                        <th scope="col">PAG IBIG</th>
                        <th scope="col">SSS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                        <td>sa</td>
                        <td>ss</td>
                        <td>ss</td>
                        <td>ss</td>
                        </tr>

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

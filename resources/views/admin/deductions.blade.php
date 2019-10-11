@extends('layouts.app')

@section('content')
    
@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
    <div class="container">
        <form action="{{route('deduction.store', $user->id)}}" method="POST">
            <div class="card">
                <div class="card-header card-title  " style="background-color:#f1f1f1">Deductions for {{$user->name}}</div>
                <div class="card-body">

                    <div class="row">
                        <input type="text" name="SSS" id="SSS" placeholder="SSS deduction" class="form-control form-control-lg col-md-3">
                        <input type="text" name="pag_ibig" id="pag_ibig" placeholder="Pag-ibig deduction" class="form-control form-control-lg col-md-3 ml-3">
                        <input type="text" name="philhealth" id="philhealth" placeholder="PHIC deduction" class="form-control form-control-lg col-md-3 ml-3">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right">Save Deduction</button>
                </div>
            </div>
        </form>
    </div>

@endsection
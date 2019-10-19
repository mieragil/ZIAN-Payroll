@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-6">
            <table class="table table-striped table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Employee Name</th>
                        <th scope="col">SSS</th>
                        <th scope="col">PHIC</th>
                        <th scope="col">PAG-IBIG</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $x)
                        <tr>
                            <td>{{$x->name}}</td>
                            <td>{{$x->SSS}}</td>
                            <td>{{$x->PHIC}}</td>
                            <td> {{$x->PAG_IBIG}}</td>
                            <td><button class="btn btn-primary" id="editbt"><i class="far fa-edit"></i>&nbsp;Edit</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-6" id="edit">
            <div class="card">
                <form action="" method="post">
                    <div class="card-body">
                        <div class="row">
                                <h3 id="name"></h3>
                                <i href="#" id="close" class="ml-5 fas fa-times float-right fa-2x red">
                                
                                </i>
                        </div>
                        <label for="sss">SSS deduction:</label>
                        <input type="text" class="form-control" id="sss">

                        <label for="phic">PHIC deduction:</label>
                        <input type="text" class="form-control" id="phic">

                        <label for="pi">PAG-IBIG deduction:</label>
                        <input type="text" class="form-control" id="pi">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    @endsection
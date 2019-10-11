@extends('layouts.app')

@section('content')
{{-- user view --}}
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="card shadow">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-6">
                                <h1>4:20 PM</h1>
                            </div>
                            <div class="col text-right">
                                Tuesday <br>
                                October 1, 2019
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 col-xs-12 text-center px-5" min-height="150px;">
                                <img src="{{ asset('/img/wew.jpg') }}" alt="..." class="rounded-circle img-fluid" >
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <br>
                                <table class="table table-striped">
                                    <tr>
                                    <td class="font-weight-bold text-dark">Admiral Kunkka</td>
                                    <td>IT</td>
                                    </tr>
                                    <tr>
                                    <td>Probationary</td>
                                    <td>Programmer</td>
                                    </tr>
                                    <tr>
                                    <td>Admiral Kunkka</td>
                                    <td>IT</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><br>

                <div class="card shadow-sm">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-6">
                                <h5>Current Pay Period</h5>
                                <small><p>Sep. 26, 2019 - Oct 10, 2019</p></small>
                            </div>
                            <div class="col-6 text-right">

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Period</th>
                                    <th scope="col">Payment</th>
                                    <th scope="col">Date Received</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>Oct. 2,2019 - Oct 10, 2019 </td>
                                    <td>Php 7,000</td>
                                    <td>Oct 15, 2019</td>
                                  </tr>
                                </tbody>
                              </table>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card shadow-sm">
                    <h5 class="card-header text-light bg-primary">Attendance SHIT</h5>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item py-0">Friday - 10/02/2019 <br>
                            <p class ="text-success"> <i class="fas fa-circle mr-2"></i></i> Present</p>
                            </li>
                            <li class="list-group-item py-1">Thursday - 10/02/2019 <br>
                            <p class="text-danger"> <i class="fas fa-circle mr-2"></i></i> Absent</p>
                            </li>
                            <li class="list-group-item py-1">Wednesday - 10/02/2019 <br>
                            <p class ="text-success"> <i class="fas fa-circle mr-2"></i> Present</p>
                            </li>
                            <li class="list-group-item py-1">Tuesday - 10/02/2019 <br>
                            <p class ="text-success"> <i class="fas fa-circle mr-2"></i> Present</p>
                            </li>
                            <li class="list-group-item py-1">Tuesday - 10/02/2019 <br>
                            <p class ="text-success"> <i class="fas fa-circle mr-2"></i> Present</p>
                            </li>
                        </ul>
                        <br>
                        <div class="text-right">
                            <a href="#" class="">View More...</a>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card shadow-sm">
                        <h5 class="card-header text-light bg-primary">Accountability</h5>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item py-0">
                                <p>Laptop</p>
                                <p>Tablet</p>
                                </li>
                            </ul>
                            <div class="text-right">
                                <a href="#" class="">View More...</a>
                            </div>
                        </div>
                    </div>
                <br>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content-dashboard')
<div class="container-fluid">
        <div class="col-lg-12">
                <div class="card mb-3 shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                    <h2 class="text-secondary"><label for="hired">Select date</label></h2>
                                    <div class="input-group">
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
                                    <th scope="col" class="text-secondary">Name</th>
                                    <th scope="col" class="text-info">Time In</th>
                                    <th scope="col" class="text-danger">Time Out</th>
                                    <th scope="col" class="text-primary">Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td><i class="fas fa-circle mr-2 text-success"></i> Present</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                    <td><i class="fas fa-circle mr-2 text-orange"></i> Absent</td>
                                  </tr>
                                  <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <td><i class="fas fa-circle mr-2 text-orange"></i> Absent</td>
                                      </tr>
                                </tbody>
                              </table>

                    </div>
                </div>
        </div>
</div>


@endsection

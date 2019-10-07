@extends('layouts.app')

@section('content-dashboard')
<div class="container">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                        <h2 class="text-secondary">Departments <i class="fas fa-cog"></i></h2>
                        <button class="btn btn-outline-primary" data-target="#new-department-modal" data-toggle="modal">  New Department <i class="far fa-building"></i></button>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-9"><h3>IT</h3></div>
                                            <div class="col-3 text-right"><button class="btn btn-primary" id="new-position"><i class="fas fa-plus"></i> Add New Position</button></div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                       <h5>Positions</h5>
                                       <table class="table table-hover">
                                            <tbody>
                                              <tr>
                                                <td>Sr. Programmer</td>
                                                <td class="text-right">
                                                    <i class="fas fa-edit text-primary"></i>
                                                    <i class="fas fa-trash text-danger"></i>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>Jr. Programmer</td>
                                                <td class="text-right">
                                                    <i class="fas fa-edit text-primary"></i>
                                                    <i class="fas fa-trash text-danger"></i>
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        <div id="new-position-input" style="display:none">
                                            <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Enter New Position" aria-label="Enter New Position" aria-describedby="button-addon4">
                                            <div class="input-group-append" id="button-addon4">
                                                <button class="btn btn-success px-5" type="button">Save</button>
                                                <button class="btn btn-secondary btn-cancel" type="button">Cancel</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                </div>

            </div>
        </div>
</div>


{{-- New Department Mondal --}}
<div class="modal fade" id="new-department-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="" method="POST">
        <div class="modal-dialog" role="document">
          <div class="modal-content modal-lg">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New Department</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center">
                @csrf
                <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Department Name: </span>
                        </div>
                        <input type="text" class="form-control" placeholder="..." aria-label="Username" aria-describedby="basic-addon1">
                      </div>
                <input type="text" name="myidterminate" id="myid" hidden>
                <a href="" class="badge badge-light" name="myname" id="myname"></a>
            </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Continue</button>
                </div>

            </div>
        </div>
    </form>
</div>

{{-- end of new department modal --}}

@endsection

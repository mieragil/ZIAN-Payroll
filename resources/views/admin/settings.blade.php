@extends('layouts.app')

@section('content-dashboard')
<div class="container-fluid">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                        <h2 class="text-secondary">Departments <i class="fas fa-cog"></i></h2>
                        <button class="btn btn-outline-primary" data-target="#new-department-modal" data-toggle="modal">  New Department <i class="far fa-building"></i></button>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                                @endif

                            @foreach ($department as $row)
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                        <div class="col-9"><h3>{{$dept = $row->department_name}}</h3></div>
                                            <div class="col-3 text-right"><button class="btn btn-primary btn-new-position" id=""><i class="fas fa-plus"></i> Add New Position</button></div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                    <h5>Position</h5>
                                       <table class="table table-hover">
                                        <tbody>

                                            @foreach ($position as $item)
                                                @if($item->department_name == $dept)
                                                    <tr>
                                                    <td>{{$item->position}}</td>
                                                    <td class="text-right">
                                                        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-outline-danger" type="submit"> <i class="fas fa-trash"></i></button>
                                                    </td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                            </tbody>
                                          </table>

                                        <form action="{{route('department.position', $row->department_name)}}" method="POST">
                                            @csrf
                                            <div class="new-position-input" style="display:none">
                                                <div class="input-group">
                                                <input type="hidden" name="department_name" value="{{$row->department_name}}">
                                                <input type="text" class="form-control new-pos-text" name="new_position" placeholder="Enter New Position" aria-label="Enter New Position" aria-describedby="button-addon4">
                                                <div class="input-group-append" id="button-addon4">
                                                    <button class="btn btn-success px-5" type="submit">Save</button>
                                                    <button class="btn btn-secondary btn-cancel" type="button">Cancel</button>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br>
                                @endforeach
                            </div>
                        </div>
                        <br>
                </div>

            </div>
        </div>
</div>


{{-- New Department Mondal --}}
<div class="modal fade" id="new-department-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{route('department.store')}}" method="POST">
        <div class="modal-dialog" role="document">
          <div class="modal-content modal-lg">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New Department</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                @csrf

                <p class="mb-0">Department Name:</p>
                <input type="text" class="form-control" name="department_name" id="department_name" placeholder="department" required>
                <br>

                <p class="mb-0">Position under this department:</p>
                <input type="text" class="form-control" name="position" id="position" placeholder="position" required>

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

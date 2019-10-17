@extends('layouts.app')

@section('content-dashboard')



        <div class="container-fluid">

            @if ($errors->any())
                <div class="alert alert-danger col-md-10">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow">
                        <h5 class="card-header bg-dark text-white">Leave Records:</h5>
                            <div class="card-body">
                                {{-- <div class="alert alert-primary">No Leave Record</div> --}}
                                <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First</th>
                                            <th scope="col">Last</th>
                                            <th scope="col">Handle</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($leavers as $row)
                                            <tr>
                                            <th scope="row">1</th>
                                            <td>{{$row->emp_name}}</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                      </table>
                            </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow">
                        <div class="card-header text-light orange">
                            New Leave Request
                        </div>
                        <div class="card-body">
                            <form action="" method="">
                                @csrf
                                    <label for="employees">Choose Employee:</label>
                                    <select class="form-control" name="employees" id="employees">
                                        <option value="">--SELECT EMPLOYEE--</option>
                                        @foreach ($data as $item)
                                        <option value="{{$item->name}}" name="">{{$item->name}}</option>
                                        @endforeach


                                    </select>
                                    <br>
                                    <label for="reason">Reason for leave</label>
                                    <textarea type="text" class="form-control" name="reason" id="reason" required>
                                    </textarea>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <label for="firstdate">From:</label>
                                            <input type="date" name="firstdate" id="firstdate" class="form-control mb-3" required value="{{old('firstdate')}}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="seconddate">To:</label>
                                            <input type="date" name="seconddate" id="seconddate" class="form-control mb-3" required value="{{old('seconddate')}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="paid">Is it a paid leave?</label>
                                        <select multiple class="form-control" name="paid" id="paid" style="height:60px" required>
                                            <option value="yes">Yes, it's a paid leave.</option>
                                            <option value="no">No, it's not.</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Accept Leave</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
    </div>


@endsection

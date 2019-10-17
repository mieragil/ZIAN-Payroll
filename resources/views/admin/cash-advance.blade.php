@extends('layouts.app')

@section('content-dashboard')

    <div class="container-fluid">

        <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <h5 class="card-header bg-dark text-white">Cash Advance Records:</h5>
                <div class="card-body">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['tables'] as $x)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{$x->name}}</td>
                            <td>{{$x->request}}</td>
                            <td>{{$x->months_to_pay}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-light">
                    New Cash Advance Request
                </div>
                <form action="{{route('ded.storeCA', 'accept')}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="employees">Choose Employee:</label>
                            <select class="form-control" name="employees" id="employees">
                                @foreach ($data['users'] as $user)
                                    <option value="{{$user->id}}" name="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            <label for="reason" class="mt-3">Reason for Cash Advance</label>
                            <textarea type="text" name="reason" id="reason" class="form-control" placeholder="Reason" style="height:75px">{{ old('reason') }}</textarea>
                            <label for="amount" class="mt-3">Amount Requested</label>
                            <input type="number" min="1" max="99999" class="form-control" name="request" placeholder="Amount Requested">
                            <label for="amount" class="mt-3">Deduction per Payroll</label>
                            <input type="number" min="1" max="99999" class="form-control" name="ded_per_pay" placeholder="Deduction per Payroll">
                            <label for="amount" class="mt-3">Months to Pay</label>
                            <input type="number" min="1" max="99999" class="form-control" name="months_to_pay" placeholder="Months to Pay">
                            <label for="date_issued" class="mt-3">Date Issued for Request:</label>
                            <input type="date" name="date_issued" id="date_issued" class="form-control">

                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Save Record</button>
                    </div>
                </form>
            </div>
        </div>

        </div>
    </div>

@endsection

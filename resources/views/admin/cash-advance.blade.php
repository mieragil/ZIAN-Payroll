@extends('layouts.app')

@section('content')
    
    <div class="container">

        <div class="row">
            
        <div class="col-md-8">
            @if ($errors->any())
                <div class="alert alert-success" role="alert">
                    @foreach ($errors->all() as $err)
                        {{$err}}
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Employee Name</th>
                        <th scope="col">Balance</th>
                        <th scope="col"># of Payroll Left to Pay</th>
                        <th scope="col">Deduction / Payroll</th>
                        <th scope="col">Date Issued</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['tables'] as $x)
                        <tr>
                            <td>{{$x->name}}</td>
                            <td>{{$x->request}}</td>
                            <td>{{$x->months_to_pay}}</td>
                            <td>{{$x->ded_per_pay}}</td>
                            <td>{{$x->date_issued}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
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
                            <textarea type="text" name="reason" id="reason" class="form-control" placeholder="Reason" style="height:75px" required>{{ old('reason') }}</textarea>
                            <label for="amount" class="mt-3">Amount Requested</label>
                            <input type="number" min="1" max="99999" class="form-control" name="request" placeholder="Amount Requested" required>
                            <label for="amount" class="mt-3">Deduction per Payroll</label>
                            <input type="number" min="1" max="99999" class="form-control" name="ded_per_pay" placeholder="Deduction per Payroll" required>
                            <label for="amount" class="mt-3">Months to Pay</label>
                            <input type="number" min="1" max="99999" class="form-control" name="months_to_pay" placeholder="Months to Pay" required>
                            <label for="date_issued" class="mt-3">Date Issued for Request:</label>
                            <input type="date" name="date_issued" id="date_issued" class="form-control" req>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Save Record</button>
                    </div>
                </form>
            </div>
        </div>

        </div>
    </div>

@endsection
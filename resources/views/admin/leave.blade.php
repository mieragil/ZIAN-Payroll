@extends('layouts.app')

@section('content')
    


        <div class="container">
            
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
                

            <div class="card col-md-7">
                <h5 class="card-header">Application for Leave of {{$data['user']->name}}</h5>
                <div class="card-body">
                    <form action="{{route('leave.accept-leave',$data['user']->id)}}" method="POST">
                        @csrf
                            <label for="reason">Reason for leave</label>
                            <textarea type="text" class="form-control" name="reason" id="reason" required>
                                {{old('reason')}}
                            </textarea>
                            <div class="row mt-3">
                                <div class="col-md-5">
                                    <label for="firstdate">From:</label>
                                    <input type="date" name="firstdate" id="firstdate" class="form-control mb-3" required value="{{old('firstdate')}}">
                                </div>
    
                                <div class="col-md-5 offset-2">
                                        <label for="seconddate">To:</label>
                                        <input type="date" name="seconddate" id="seconddate" class="form-control mb-3" required value="{{old('seconddate')}}">
                                    </div>
                            </div>
                            <div class="form-group">
                            <label for="paid">Is it a paid leave?</label>
                                <select multiple class="form-control col-md-5" name="paid" id="paid" style="height:60px" required>
                                    <option value="yes">Yes, it's a paid leave.</option>
                                    <option value="no">No, it's not.</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Accept Leave</button>
                    </form>
                </div>
            </div>
            
            <div class="card col-md-4 ml-5">
                <h5 class="card-header orange text-white">Leave Record:</h5>

                @if (!$data['leave']->isEmpty())
                    @foreach ($data['leave'] as $liv)
                        <div class="card-body">
                            <h5 class="card-title font-weight-bolder">{{$liv->reason}}</h5>
                            <p>{{$liv->dates_of_leave}}</p>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        </div>
                    <hr>
                    @endforeach
                @else
                    <div class="alert alert-primary">No Leave Record</div>
                @endif
            </div>
        </div>
    </div>


@endsection
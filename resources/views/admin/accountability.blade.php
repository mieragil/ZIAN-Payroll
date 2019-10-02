@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>
            Accountability of:
            <p class="font-weight-bold">{{$data['user']->name}}</p>
        </h1>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <button class="btn btn-success float-right" data-toggle="modal" data-target="#newitem">Add Item</button>
            </div>
            <div class="card-body">
                <ul class="list-group col-md-6">
                    @foreach ($data['items'] as $item)

                        <li class="list-group-item"> 
                            <h3>
                                {{$item->item_name}} x {{$item->quantity}}
                                <button class="btn btn-danger float-right" 
                                    data-myitemded="{{$item->item_name}}" data-myitemidded="{{$item->id}}" data-target="#minus" data-toggle="modal">
                                    <i class="fas fa-minus-circle mr-2"></i>Remove
                                </button>
                            </li>
                            </h3>
                    @endforeach
                </ul>
            </div>
        </div>
        
    </div>


    {{-- New Item Modal --}}
    <div class="modal fade" id="newitem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Accountability for {{$data['user']->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('item.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <label for="item_name">Item:</label>
                        <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Item Name" required>

                        <label for="item_name">Quantity: </label>
                        <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity" required>

                        <input type="text" name="emp_id" id="emp_id" value="{{$data['user']->id}}" hidden> 

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Subtract quantity --}}
    <div class="modal fade" id="minus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deduct Quantity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('item.subtract','test')}}" method="POST">
                        @csrf
                        <div class="modal-body">
    
                            <label for="item_name">Item:</label>
                            <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Item Name" disabled readonly>
    
                            <label for="item_name">Quantity to Deduct: </label>
                            <input type="text" class="form-control" name="dedquantity" id="dedquantity" placeholder="Quantity" required>
    
                            <input type="text" name="emp_id" id="emp_id" value="" hidden> 
    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
@endsection
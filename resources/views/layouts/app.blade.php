<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @auth
        @if (Auth::user()->priority == 'HI')
            
        <a href="#" class="float">
            <i class="fa fa-plus my-float fa-3x" data-toggle="modal" data-target="#addnew"></i>
        </a>
        @endif
    @endauth
    


    <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"><strong>Add New Employee Details</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('users.create')}}" method="POST">
                @csrf
                <div class="modal-body">
                    
                    <div class="row">

                        <div class="col-md-6">
                            <label for="name">Employee Name</label>
                            <input type="text" name="name" class="form-control" required value="{{old('name')}}">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="hired">Date Hired</label>
                            <input type="date" name="hired" id="hired" class="form-control mb-3" required value="{{old('hired')}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="email">Username</label>
                            <input type="text" name="username" class="form-control" required value="{{old('username')}}">
                        </div>
                        <div class="col-md-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" required value="{{old('password')}}">
                        </div>
                        <div class="col-md-4">
                            <label for="password">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" required value="{{old('password')}}">
                        </div>
                    </div>

                    <hr class="col-md-5">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label for="rate"><strong>Enter DAILY RATE:</strong></label>
                            <input type="number" name="rate" class="form-control" required value="{{old('rate')}}" min="1" max="10000">
                        </div>
                        <div class="col-md-6">

                            <label for="inlineRadio1">Enter WEEKS of training:</label>
                            <input type="number" name="weeks_of_training" class="form-control" required value="{{old('rate')}}" min="1" max="10000">
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-md-6">
                            <label for="select1">Department</label>
                            <select name="department" id="department" class="form-control">
                                <option value="test1">test1</option>
                                <option value="test2">test2</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="select2">Position</label>
                            <select name="position" id="position" class="form-control">
                                <option value="test11">test1</option>
                                <option value="test22">test2</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>

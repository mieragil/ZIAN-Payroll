<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ZIAN') }}</title>


    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body >

    <div id="app">

        <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'ZIAN') }}
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

        @auth
            @if (Auth::user()->priority == 'HI')
            <div id="wrapper">
                <!-- Sidebar -->
                <div id="sidebar-wrapper" class="bg-dark">
                    <ul class="sidebar-nav">
                        <li class="sidebar-brand bg-primary px-5">
                            <a href="#" class="text-white">
                                Zian Payroll
                            </a>
                        </li>
                        <li>
                            <a href="{{route('homedashboard')}}"> <i class="fas fa-home m-3"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="{{route('dashboard')}}"><i class="fas fa-users m-3"></i> Employees</a>
                        </li>
                        <li>
                            <a href="{{route('attendance')}}"><i class="fas fa-chart-bar m-3"></i>Attendance</a>
                        </li>
                        <li>
                            <a href=""><i class="fas fa-comments-dollar m-3"></i>Deductions</a>
                        </li>
                        <li>
                            <a href="{{route('ded.showCA')}}"><i class="fas fa-cash-register m-3"></i>Cash Advance</a>
                        </li>
                        <li>
                            <a href="#"><i class="fas fa-cogs m-3"></i>Settings</a>
                        </li>

                    </ul>
                </div>
                <!-- /#sidebar-wrapper -->
                <div id="page-content-wrapper">
                <a href="#menu-toggle" class="btn btn-lg btn-default" id="menu-toggle"><i class="fas fa-bars"></i></a>
                    <main class="py-4">
                        @yield('content-dashboard')
                    </main>
                </div>
                </div>
            @endif
        @endauth

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
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Employee Details</a>
                        </li>
                        <li class="nav-item ">
                          <a class="nav-link disabled" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Deductions</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                             {{-- modalbody --}}
                <div class="modal-body">
                    <div class="alert alert-warning" id="error-empty" role="alert" style="display:none;">
                        Please fill out all the fields. lol
                      </div>
                        <div class="row">

                            <div class="col-md-6">
                                <label for="name">Employee Name</label>
                                <input type="text" name="name" class="form-control new-employee-input" required value="{{old('name')}}">
                            </div>

                            <div class="col-md-6">
                                <label for="hired">Date Hired</label>
                                <input type="date" name="hired" id="hired" class="form-control new-employee-input mb-3" required value="{{old('hired')}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="email">Username</label>
                                <input type="text" name="username" class="form-control new-employee-input" required value="{{old('username')}}">
                            </div>
                            <div class="col-md-4">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control new-employee-input" required value="{{old('password')}}">
                            </div>
                            <div class="col-md-4">
                                <label for="password">Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control new-employee-input" required value="{{old('password')}}">
                            </div>
                        </div>

                        <hr class="col-md-5">

                        <div class="row">
                            <div class="col-md-4">
                                <label for="rate"><strong>Enter DAILY RATE:</strong></label>
                                <input type="number" name="rate" class="form-control new-employee-input" required value="{{old('rate')}}" min="1" max="10000">
                            </div>
                            <div class="col-md-4">

                                <label for="inlineRadio1">Enter WEEKS of training:</label>
                                <input type="number" name="weeks_of_training" class="form-control new-employee-input" required value="{{old('rate')}}" min="1" max="10000">
                            </div>
                            <div class="col-md-4">
                                <label for="salary_type">FIXED SALARY?</label>
                                <select class="form-control" name="salary_type" id="salary_type">
                                    <option value="FIXED">Yes</option>
                                    <option value="UNFIXED">No</option>
                                </select>
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
                    {{-- endmodalbody --}}
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-lg-12 p-4">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">PHIC</label>
                                                <input type="" class="form-control" id="inputEmail4" placeholder="amount">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">SSS</label>
                                                <input type="" class="form-control" id="inputPassword4" placeholder="amount">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">PAGIVIF</label>
                                                <input type="" class="form-control" id="inputEmail4" placeholder="amount">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">MORE</label>
                                                <input type="" class="form-control" id="inputPassword4" placeholder="amount">
                                            </div>
                                        </div>
                                </div>
                             </div>
                        </div>

                      </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="button" id="btnNext">NEXT</button>
                    <button type="submit" class="btn btn-success" id="btnSave" style="display:none;">SAVE</button>
                </div>
            </form>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>

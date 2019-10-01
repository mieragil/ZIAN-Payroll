<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Carbon\Carbon;
use App\User;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Hash;


    

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('employee', 'PivotController');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::post('/employee/{id}/promote','PivotController@promote')->name('employee.promote');

    
Route::post('users/create-new', function (Request $request) {
    request()->validate([
        'username' => 'unique:users',
        'password' => 'required|min:3',
    ]);

    User::create([
        'name' => $request->name,
        'date_hired' => $request->hired,
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'weeks_of_training' => $request->weeks_of_training,
        'emp_status' => 'TRAINEE',
        'department' => $request->department,
        'rate' => $request->rate,
        'position' => $request->position,
        'priority' => 'LO',
        'active' => '1',
        ]);
    return redirect()->route('dashboard')->with('success', 'SUCCESSFULLY ADDED NEW EMPLOYEE: '. $request->name);


})->name('users.create');

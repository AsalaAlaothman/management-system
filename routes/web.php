<?php
use Illuminate\Http\Request;
use App\Models\Request_work;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    $email = auth()->user()->email;
    // dd($email);
    $req = User::where('email', $email)->first();
    // dd($req->usertype);

    if ($req->usertype == 'Admin') {
        return redirect('mainadmin');
    } elseif ($req->usertype == 'Management') {
        return redirect('partadmin');
    } elseif ($req->usertype == 'Accountant') {
        return redirect('partadmin');
    } elseif ($req->usertype == 'HR') {
        return redirect('partadmin');
    } elseif ($req->usertype == 'Employee') {
        return redirect('/request');
    }
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

/********************** *************************/
/************** User Routes ************/
Route::get('/request', 'App\Http\Controllers\ControllerSystem@index');
Route::post('/request', 'App\Http\Controllers\ControllerSystem@store');
Route::get('/myRequests/{email}', 'App\Http\Controllers\ControllerSystem@Myreq');
Route::get('/request/{id}', 'App\Http\Controllers\ControllerSystem@MyApp');
Route::post('/request/{id}', 'App\Http\Controllers\ControllerSystem@update');
// Route::get('/dashboard',function(){return view('dashboard');});



// Route::group(['prefix' => 'request'], function(){
//     Route::get('create', 'App\Http\Controllers\ControllerSystem@index');
//     Route::post('store', 'App\Http\Controllers\ControllerSystem@store');
//     Route::get('myRequests/{email}', 'App\Http\Controllers\ControllerSystem@Myreq');
//     Route::get('{id}', 'App\Http\Controllers\ControllerSystem@MyApp');
//     Route::post('{id}', 'App\Http\Controllers\ControllerSystem@update');
// });





/********************** *************************/
/************** Admins Routes ************/
//Part Admin

Route::get('/partadmin', 'App\Http\Controllers\adminController@indexPart');
Route::get('/partadmin/show/{id}', 'App\Http\Controllers\adminController@show');
Route::post('/partadmin/show/{id}', 'App\Http\Controllers\adminController@approved');


Route::get('/mainadmin', 'App\Http\Controllers\adminController@index');
Route::post('/mainadmin', 'App\Http\Controllers\adminController@store');
Route::get('/mainadmin/editUser/{id}', 'App\Http\Controllers\adminController@showUser');
Route::post('/mainadmin/editUser/{id}', 'App\Http\Controllers\adminController@updateUser');
Route::post('delete/{id}', 'App\Http\Controllers\adminController@destroy')->name('admin.delete');
Route::get('editUser/{id}', 'App\Http\Controllers\adminController@showUser');
Route::post('/partadmin/rej/{id}', 'App\Http\Controllers\adminController@rejection')->name('partadmin.reject');


// Error page
Route::get('/404',function(){
return view(('404'));
});
Route::get('/404/goback',function(){
    return url()->previous();
})->name('404.goback');
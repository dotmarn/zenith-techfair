<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::group(['namespace' => '\App\Http\Livewire'], function() {

    Route::get('/', \Participant\Index::class)->name('welcome');

    Route::group(['prefix' => 'portal', 'as' => 'portal.'], function() {

        Route::get('/login', \Portal\Login::class)->name('login');

        Route::group(['middleware' => 'auth'], function() {

            Route::get('/dashboard', \Portal\Dashboard::class)->name('dashboard');

            Route::get('/masterclass', \Portal\MasterClass::class)->name('master-class');

            Route::get('/masterclass/participant/{id}', \Portal\ClassParticipants::class)->name('participant');

            Route::get('/registration/view/{token}', \Portal\View::class)->name('view-registration');

            Route::get('/attendance', \Portal\Attendances::class)->name('attendance');

            Route::get('/attendance/{id}', \Portal\Attendances::class)->name('attendance-report');

        });

        Route::get('/logout', function() {
            Auth::logout();
            return redirect()->to(route('portal.login'));
        })->name('logout');
    });

});

Route::get('/portal/registration/details', function(Request $request) {
    $name = $request->query('name');
    // split name into two
    if (strpos($name, ' ') !== false) {
        list($first_name, $last_name) = explode(" ", $name);
    }
    return view('print', [
        'first_name' => $first_name,
        'last_name' => $last_name
    ]);
})->name('print')->middleware('auth');

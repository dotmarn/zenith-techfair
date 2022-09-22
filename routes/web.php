<?php

use App\Jobs\DefaultNotificationJob;
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

            Route::get('/registration/view/{token}', \Portal\View::class)->name('view-registration');

            // Route::get('/verify-participant', \Portal\Verify::class)->name('verify');

            // Route::get('/participant/{id}', \Portal\View::class)->name('view');

        });

        Route::get('/logout', function() {
            Auth::logout();
            return redirect()->to(route('portal.login'));
        })->name('logout');
    });

});


Route::get('/quick-test', function() {
    $body = "<p>Thank you for registering for the Zenith Tech Fair.</p>";
    $body .= "<div style='text-align:center'><img src='https://res.cloudinary.com/igbalode/image/upload/v1663755729/s9z1f0zaxsog9ebijdma.png' style='width:50%' /></div>";

    $payload = [
        'username' => "Ridwan",
        'email' => "kasimsheyi20@gmail.com",
        'subject' => "Ridwan, thank you for registering for the event",
        'body' => $body
    ];

    $payload = json_encode($payload);
    DefaultNotificationJob::dispatch($payload);
});

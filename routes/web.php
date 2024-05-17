<?php

use App\Http\Controllers\logout;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\UbahPassword;
use App\Livewire\Dashboard;
use App\Livewire\DataMaster\DataNoSurat;
use App\Livewire\DataMaster\DataPt;
use App\Livewire\DataMaster\DataUsers;
use App\Livewire\DataMaster\Role;
use App\Livewire\NomorSurat\HariIni;
use App\Livewire\NomorSurat\Kastem;
use App\Livewire\NomorSurat\KastemAdmin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', Login::class)->name('login');
Route::get('/ubah-password', UbahPassword::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [logout::class, 'logout']);

    Route::middleware(['checkRole:1'])->group(function () {
        Route::get('/', function () {
            return redirect('/dashboard');
        });
        Route::get('/dashboard', Dashboard::class);
        Route::get('/role', Role::class);
        Route::get('/data-pt', DataPt::class);
        Route::get('/data-users', DataUsers::class);
        Route::get('/data-no-surat', DataNoSurat::class);
    });



    Route::get('/hari-ini', HariIni::class);
    Route::get('/kastem', Kastem::class);
    Route::get('/kastem-admin', KastemAdmin::class);
});

<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\admin\{
    DashboardController,
    MasterSuplemenController,
    MasterPaketController,
    WhatsappApiController,
};
use App\Http\Controllers\web\{
    WebController,
};

use App\Http\Controllers\{
    LoginController,
    RegisterController,
};
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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//user
// Route::group(['middleware' => ['role:user']], function () {
    Route::get('/', [WebController::class, 'index'])->name('web.home');
// });
//user


//admin
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('masterSuplemen', MasterSuplemenController::class);
    Route::resource('masterPaket', MasterPaketController::class);
    Route::get('whatsappApi', [WhatsappApiController::class, 'index'])->name('whatsappApi.index');
    Route::post('whatsappApi', [WhatsappApiController::class, 'storeorupdate'])->name('whatsappApi.storeorupdate');
});
//admin

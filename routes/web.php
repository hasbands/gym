<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\admin\{
    DashboardController,
    MasterSuplemenController,
    MasterPaketController,
    WhatsappApiController,
    AddMembershipController,
    PaketHarianController,
};
use App\Http\Controllers\web\{
    WebController,
    ListPaketController,
    TransaksiController,
    RiwayatTransaksiController,
    ProfilUserController,
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

// CEK STATUS MEMBERSHIP
Route::get('cekstatus', [AddMembershipController::class, 'cekstatus'])->name('add-membership.cekstatus');
// CEK STATUS MEMBERSHIP

// SEND MESSAGE
Route::get('sendmessage', [AddMembershipController::class, 'sendmessage'])->name('add-membership.sendmessage');
// SEND MESSAGE

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



//admin
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('masterSuplemen', MasterSuplemenController::class);
    Route::resource('masterPaket', MasterPaketController::class);
    Route::get('whatsappApi', [WhatsappApiController::class, 'index'])->name('whatsappApi.index');
    Route::post('whatsappApi', [WhatsappApiController::class, 'storeorupdate'])->name('whatsappApi.storeorupdate');
    Route::resource('add-membership', AddMembershipController::class);
    Route::resource('paket-harian', PaketHarianController::class);
});
//admin

//user
// Route::group(['middleware' => ['role:user']], function () {
Route::get('/', [WebController::class, 'index'])->name('web.home');
Route::get('/listpaket', [ListPaketController::class, 'index'])->name('web.listpaket');
Route::get('/tentang-kami', [WebController::class, 'about'])->name('web.about');
Route::get('/transaksi/{id}', [TransaksiController::class, 'transaksi'])->name('web.transaksi');
Route::post('/add-membership', [TransaksiController::class, 'addMembership'])->name('web.add-membership');
Route::get('/transaksi-detail/{id}', [TransaksiController::class, 'transaksi_detail'])->name('web.transaksi_detail');
Route::get('/transaksi/success/{order_id}', [TransaksiController::class, 'success'])->name('web.success_membership');
Route::get('/riwayat-transaksi', [RiwayatTransaksiController::class, 'index'])->name('web.riwayat_transaksi');
Route::get('/profil', [ProfilUserController::class, 'index'])->name('web.profil');
Route::put('/profil/update/{id}', [ProfilUserController::class, 'update'])->name('web.profil.update');
Route::get('/cetak-kartu', [ProfilUserController::class, 'cetakkartu'])->name('web.cetak_kartu');
// });
//user
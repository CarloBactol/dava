<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    Payment,
    AdminOwner,
    UserBranch,
    AdminAnimal,
    AdminBranch,
    AccountGcash,
    AdminService,
    VetSpecialize,
    AdminDashboard,
    AdminVeterinary,
    ChartController,
    UserAppointment,
    VetMedical,
    NewRegisterController,
};
use App\Http\Controllers\Veterinary\{
    VetDashboard,
    BranchPayment,
    CartController,
    ChartController as VeterinaryChartController,
    MedecineInventory,
    Subcriber,
    VetConsumption,
};



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

    return view('home');
    // return view('auth.weslcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('user_branches', UserBranch::class)->except('show');
        Route::resource('admin_dashboards', AdminDashboard::class)->only('index', 'show');
        Route::resource('admin_owners', AdminOwner::class)->except('show');
        Route::resource('admin_animals', AdminAnimal::class)->except('show');
        Route::resource('admin_veterinaries', AdminVeterinary::class)->except('show');
        Route::resource('admin_branchs', AdminBranch::class)->except('show');
        Route::resource('admin_services', AdminService::class)->except('show');
        Route::resource('payments', Payment::class)->except('show');
        Route::resource('account_gcashes', AccountGcash::class)->except('show');
        Route::resource('vet_specializes', VetSpecialize::class)->except('show');
        Route::resource('user_appoitments', UserAppointment::class);
        Route::get('/chart', [ChartController::class, '_Chart'])->name('chart');
        Route::get('/', [ChartController::class, 'newBooks']);
        Route::get('/chart-medical', [ChartController::class, '_medical'])->name('medical');

        // medical
        Route::resource('medicals', VetMedical::class)->except('show');
        Route::resource('new_registere_controllers', NewRegisterController::class)->except('show');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'isVet', 'prefix' => 'veterinary', 'as' => 'veterinary.'], function () {

        Route::resource('vet_dashboards', VetDashboard::class)->only('index', 'show');
        Route::resource('payments', Payment::class)->except('show');
        Route::resource('branch_payments', BranchPayment::class)->except('show');
        Route::get('/vetchart', [VeterinaryChartController::class, '_medical'])->name('vetmedical');
        Route::resource('vet_consumptions', VetConsumption::class)->except('show');
        Route::post('/delete-item', [CartController::class, '_delete'])->name('delete');
        Route::get('/count-item', [CartController::class, '_getCart'])->name('cartCount');
        Route::get('/subcription', [Subcriber::class, 'index'])->name('subcription');
        Route::post('/store-cart', [CartController::class, '_storecCart'])->name('storeCart');
        Route::resource('medecine_inventories', MedecineInventory::class)->except('show');
    });
});

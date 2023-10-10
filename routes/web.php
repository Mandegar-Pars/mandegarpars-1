<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\InvoiceController;
use App\Http\Controllers\Panel\PrinterController;
use App\Http\Controllers\Panel\ProductController;
use App\Http\Controllers\Panel\RoleController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\PanelController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('test/{id?}',function ($id = null){
//    dd(\App\Models\Product::whereJsonContains('printers',['sony'])->get());
//    return \auth()->loginUsingId($id);

//    $pdf = PDF::loadView('pdfs.invoice',[],[],[
//        'orientation' => 'L'
//    ]);
//    return $pdf->stream('document.pdf');
});

Route::middleware('auth')->prefix('/panel')->group(function (){
    Route::get('/', [PanelController::class, 'index'])->name('panel');

    // Users
    Route::resource('users',UserController::class)->except('show');

    // Roles
    Route::resource('roles', RoleController::class)->except('show');

    // Categories
//    Route::resource('categories',CategoryController::class)->except('show');

    // Products
    Route::resource('products', ProductController::class)->except('show');

    // Printers
    Route::resource('printers', PrinterController::class)->except('show');

    // Invoices
    Route::resource('invoices', InvoiceController::class);
    Route::post('calcProductsInvoice', [InvoiceController::class, 'calcProductsInvoice'])->name('calcProductsInvoice');
});

Auth::routes(['register' => false, 'reset' => false, 'confirm' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::fallback(function (){
    abort(404);
});

<?php

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

Auth::routes();
/**
 * Home route
 */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Routes for customer
 */
Route::get('/customers', [\App\Http\Controllers\CustomerController::class, 'getCustomers'])->name('customers_view');
Route::get('/search/customer', [\App\Http\Controllers\CustomerController::class, 'searchCustomer'])->name('search_customer');
Route::get('/create/customer', [\App\Http\Controllers\CustomerController::class, 'createCustomerView'])->name('create_customer_view');
Route::post('/add/customer', [\App\Http\Controllers\CustomerController::class, 'createCustomer'])->name('crete_customer');
Route::get('/edit/customer/{id}', [\App\Http\Controllers\CustomerController::class, 'editCustomerView'])->name('edit_customer_view');
Route::post('/edit/customer', [\App\Http\Controllers\CustomerController::class, 'editCustomer'])->name('edit_customer');
Route::get('/delete/customer/{id}', [\App\Http\Controllers\CustomerController::class, 'deleteCustomerView'])->name('delete_customer_view');
Route::post('/delete/customer', [\App\Http\Controllers\CustomerController::class, 'deleteCustomer'])->name('delete_customer');

/**
 * Routes for companies
 */
Route::get('/companies', [\App\Http\Controllers\CompanyController::class, 'getCompanies'])->name('companies_view');
Route::get('/company/{company_id}', [\App\Http\Controllers\CustomerController::class, 'getCustomersByCompanyId'])->name('getCustomersById');
Route::get('/create/company', [\App\Http\Controllers\CompanyController::class, 'createCompanyView'])->name('create_company_view');
Route::post('/add/company', [\App\Http\Controllers\CompanyController::class, 'createCompany'])->name('create_company');
Route::get('/edit/company/{id}', [\App\Http\Controllers\CompanyController::class, 'editCompanyView'])->name('edit_company_view');
Route::post('edit/company', [\App\Http\Controllers\CompanyController::class, 'editCompany'])->name('edit_company');
Route::get('/delete/company/{id}', [\App\Http\Controllers\CompanyController::class, 'deleteCompanyView'])->name('delete_company_view');
Route::post('/delete/company', [\App\Http\Controllers\CompanyController::class, 'deleteCompany'])->name('delete_company');

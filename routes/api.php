<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Adding routes for ari requests.
 * Request example : http://testcrm.loc/api/v1/get/companies/paginate=/10
 */
Route::prefix('/get/companies')->group(function () {
    Route::get('/', [\App\Http\Controllers\CompanyController::class, 'getCompaniesForApi']);
    Route::prefix('/paginate=')->group(function () {
        Route::get('/{paginate}', [\App\Http\Controllers\CompanyController::class, 'getCompaniesForApi']);
    });
});

/**
 * Request example : http://testcrm.loc/api/v1/get/clients/company_id/554/paginate=/1
 */
Route::prefix('/get/clients/company_id/{id}')->group(function () {
    Route::get('/', [\App\Http\Controllers\CustomerController::class, 'getCustomersForApi']);
    Route::prefix('/paginate=')->group(function () {
        Route::get('/{paginate}', [\App\Http\Controllers\CustomerController::class, 'getCustomersForApi']);
    });
});

/**
 * Request example : http://testcrm.loc/api/v1/get/clients_companies/554
 */
Route::get('/get/clients_companies/{id}', [\App\Http\Controllers\CompanyController::class, 'getCompanyByCustomerIdForApi']);


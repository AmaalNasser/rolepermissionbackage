<?php

use App\Http\Controllers\Api\ApiTicketController;
use App\Http\Controllers\ApiAuthController;

use App\Http\Controllers\MyTicketsController;
use App\Http\Controllers\SupportController;
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


Route::post('support', [SupportController::class, 'support']);
Route::post('support/crate', [SupportController::class, 'create']);
Route::get('support', [SupportController::class, 'show']);

//submit ticket Route
Route::post('submit_new_complain/', [MyTicketsController::class, 'submit_ticket']);

//list of complian by client_id & client_id route
Route::get('list_complains/{clinet_id}', [ApiTicketController::class, 'list_complains']);

//list of response by complain_id route
Route::get('list_response/{clinet_id}/{complain_id}', [ApiTicketController::class, 'list_response']);

//submit response Route
Route::post('submit_response/', [ApiTicketController::class, 'submit_response']);





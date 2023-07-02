<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TicketsViewController;
use App\Http\Controllers\MyTicketsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\Rols_and_Permission\UserRolsController;
use App\Http\Controllers\Admin\Rols_and_Permission\RolsController;
use App\Http\Controllers\NewEditProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ClientControlController;
use amaal\complain\ComplainServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


Route::get('contact', function () {
    return view('contact::contact');
})->name('contact');

Route::post('contact', function (Request $request) {
    return $request->all();
})->name('contact');

//Complain System
Auth::routes();
// dashboard controller
Route::get('/complaint', [UserController::class, 'dash'])->name('user.complaint');
Route::get('/profile', [NewEditProfileController::class, 'edit_profile'])->name('edit_profile');
Route::post('/profile/update/password', [NewEditProfileController::class, 'updatePassword'])->name('update.password');
Route::post('/profile/update/profile', [NewEditProfileController::class, 'updateProfile'])->name('update.profile');



// ticket controller
Route::get('/ticket', [TicketsViewController::class, 'ticket'])->name('ticket');

// Route::get('/ticket/{id}', [TicketsViewController::class, 'showwTicket'])->name('ticket.show')->middleware('auth');

Route::get('/ticket/open', [TicketsViewController::class, 'open_ticket'])->name('open_ticket');
Route::get('/ticket/close', [TicketsViewController::class, 'close_ticket'])->name('close_ticket');

Route::post('/ticket/{id}/close', [TicketsViewController::class, 'close_at'])->name('tickets.close');


//ticket viwe controller 
Route::get('/ticketview', [TicketsViewController::class, 'ticketview'])->name('ticketview');

Route::get('welcome', [UserController::class, 'welcome'])->name('welcome');

// yajra table controller
Route::get('users', [UserController::class, 'index'])->name('users.index');

Route::get('home', [HomeController::class, 'index'])->name('home');
// //edit
Route::get('ticket/{id}/edit', [TicketsViewController::class, 'edit'])->name('ticket.edit');
// Route::get('ticket/{id}/store.response', [TicketsViewController::class, 'store'])->name('store.response');
// Route::get('/responses/users', [TicketsViewController::class,'users'])->name('responses.users');

//update ticket
Route::put('ticket/{id}/update', [TicketsViewController::class, 'update'])->name('ticket.update');
Route::post('ticket/{id}/set_close', [TicketsViewController::class, 'set_close'])->name('set_close');
Route::post('ticket/{id}/re_open', [TicketsViewController::class, 're_open'])->name('re_open');
Route::post('/ticket/{id}/update_priority', [TicketsViewController::class, 'updatePriority'])->name('update_priority');
Route::post('/ticket/{id}/update-status', [TicketsViewController::class, 'updateStatus'])->name('update_status');
Route::get('ticket/{id}/edit-message', [TicketsViewController::class, 'editMessage'])->name('ticket.edit-message');
Route::put('ticket/{id}/update-message', [TicketsViewController::class, 'updateMessage'])->name('update.message');


Route::post('ticket/{id}/close', [TicketsViewController::class, 'close'])->name('ticket.close');


// Route::match(['post', 'put'], 'ticket/{id}/update', [TicketsViewController::class, 'update'])->name('ticket.update');

//delete ticket
Route::delete('ticket/{id}/delete', [TicketsViewController::class, 'delete']);

// creat message controller (in ticket control)
Route::post('messageticket', [TicketsViewController::class, 'creatMessage'])->name('messageticket');
// Route::get('ticket/{id}', [SupportController::class, 'showMyTickets']);

//---------------------------------------------------------------------------------//
//                            Rols And Permission
//---------------------------------------------------------------------------------//

Route::get('user_control', [UserRolsController::class, 'user_control'])->name('user_control');
Route::delete('/user_control/delete/{id}', [UserRolsController::class, 'deleteRequest']);

Route::get('/user_control/{id}/edit_user_control', [UserRolsController::class, 'edit_user_control']);
Route::put('/user_control/update/{id}', [UserRolsController::class, 'updateuser'])->name('user_control_update');

Route::get('/user_control/show/{id}', [UserRolsController::class, 'showuser']);
Route::post('store', [UserRolsController::class, 'store'])->name('store');
Route::get('/change_password/{id}', [UserRolsController::class, 'change_password'])->name('change_password');
Route::post('/user_control/updatepassword/{id}', [UserRolsController::class, 'updatepassword'])->name('updatepassword');




Route::get('/user_control/{id}/edit', [UserRolsController::class, 'edituser'])->name('user_control.edit');
Route::get('/user_control/{id}/remove_role/{role}', [UserRolsController::class, 'remove_role'])->name('remove_role');
Route::post('/user_control/add_role/{id}', [UserRolsController::class, 'add_role'])->name('add_role');


//creat new user
Route::get('new_user', [UserRolsController::class, 'new_user'])->name('new_user');

//mail route
Route::get('/send-email', [UserRolsController::class, 'sendEmail']);

//creat new role
Route::get('new_role', [RolsController::class, 'new_role'])->name('new_role');

//role page
Route::get('rols_control', [RolsController::class, 'rols_control'])->name('rols_control');
Route::delete('/rols_control/deleterole/{id}', [RolsController::class, 'delete']);
Route::get('/rols_control/editrole/{id}', [RolsController::class, 'editrole']);

Route::put('/rols_control/updaterole/{id}', [RolsController::class, 'updaterole'])->name('rols_control_update');;
Route::post('/rols_control/storerole', [RolsController::class, 'storerole'])->name('storerole');
// Route::get('/rols_control/showrole/{id}', [RolsController::class, 'showrole']);

Route::get('/rols_control/{id}/edit_permission', [RolsController::class, 'edit_permission'])->name('rols_control.edit_permission');
Route::get('/rols_control/{id}/remove_permission/{permission}', [RolsController::class, 'remove_permission'])->name('remove_permission');
Route::post('/rols_control/{id}/add_permission', [RolsController::class, 'add_permission'])->name('add_permission');

//Client Controler Routes
Route::get('client_control', [ClientControlController::class, 'client_control'])->name('client_control');
Route::get('new_client', [ClientControlController::class, 'new_client'])->name('new_client');
Route::get('clients/{id}', [ClientControlController::class, 'show'])->name('clients.show');
Route::get('clients/{id}/edit', [ClientControlController::class, 'edit'])->name('clients.edit');
Route::delete('clients/{id}', [ClientControlController::class, 'destroy'])->name('clients.delete');
Route::post('clients', [ClientControlController::class, 'store'])->name('clients.store');
Route::put('clients/{id}', [ClientControlController::class, 'update'])->name('clients.update');


Route::get('/roles-permissions', function () {
    $roles = Role::all();
    $permissions = Permission::all();

    return view('contact::roles_permissions', compact('roles', 'permissions'));
});


// Route::get('contact', [ContactController::class, 'index'])->name('contact');
// Route::post('contact', [ContactController::class, 'send'])->name('send');
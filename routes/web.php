<?php


Route::get('/admin', 'Auth\LoginController@showLoginForm')->name('login');
Route::any('/', 'Auth\LoginController@showLoginForm')->name('login');

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
// Route::post('admin/register', 'Auth\RegisterController@register')->name('register');
Route::any('admin/logout', 'Auth\LoginController@logout')->name('logout');

// Route::get('/admin/register', 'Auth\LoginController@showLoginForm')->name('register');

// Route::get('/admin/home', function () {
//     if (session('status')) {
//         return redirect()->route('admin.home')->with('status', session('status'));
//     }

//     return redirect()->route('admin.home');
// });



Route::group(['namespace' => 'Admin', 'middleware' => ['auth']], function () {
Route::get('/', 'DashboardController@dashboard');
Route::redirect('/home', '/');
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');


    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Permissions
    Route::delete('expense/destroy', 'ExpenseController@massDestroy')->name('expense.massDestroy');
    Route::resource('expense', 'ExpenseController');    

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Clients
    Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientsController');

    // Client Payment
  
    Route::resource('clients-payments', 'ClientsPaymentController');    

    // Fuel
    Route::delete('fuel/destroy', 'FuelController@massDestroy')->name('fuel.massDestroy');
    Route::resource('fuel', 'FuelController');   

    // Petrol Station
    Route::delete('petrol-stations/destroy', 'PetrolStationsController@massDestroy')->name('petrol-stations.massDestroy');
    Route::resource('petrol-stations', 'PetrolStationsController');             

    //Meter Reading 
    Route::resource('readings', 'ReadingController');    
    Route::post('timeout', 'ReadingController@timeout')->name("readings.timeout");    

    //Vendor
    Route::resource('vendors', 'VendorController');   

    //Vendor Payment
    // Route::resource('vendor-payment', 'VendorPaymentController');

    //Shifts     
    Route::resource('shifts', 'ShiftsController');

    //Shift Trail 
    Route::resource('shiftTrails', 'ShiftTrailsController'); 

    Route::post('shift-management', 'ShiftsController@shiftManagement')->name("shift-management");     

    //Tanks     
    Route::resource('tanks', 'TanksController'); 

    //Pumps     
    Route::resource('pumps', 'PumpsController'); 

    //Hose     
    Route::resource('hoses', 'HosesController');         

    //OrderTrail
    Route::get('orders-trail', 'OrderController@ordersTrail')->name("orders-trail");     

    //VendorFuel     
    Route::resource('vendorFuel', 'VendorFuelController');

    //Order
    Route::resource('order', 'OrderController');      
    Route::post('getFuelDetails', 'OrderController@getFuelDetails')->name("order.getFuelDetails"); 


    // Route::get('/', 'HomeController@index');
    // Route::get('set-id', 'HomeController@setSiteId');

    // // Permissions
    // Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    // Route::resource('permissions', 'PermissionsController');

    // // Roles
    // Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    // Route::resource('roles', 'RolesController');

    // // Users
    // Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    // Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    // Route::resource('users', 'UsersController');

    
});

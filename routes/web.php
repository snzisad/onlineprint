<?php

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

    if(Auth::user()){
        return redirect('/order/new');
    }
    return view('auth.login');
})->name('home');

Auth::routes();


Route::get('/verify/{id}', 'Auth\RegisterController@showVerificationForm')->name('showVerifyForm');
Route::post('/verify/{id}', 'Auth\RegisterController@verify')->name("verify");

Route::middleware(['auth'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'ProfileController@showProfileForm')->name('my_profile');
    Route::post('/profile', 'ProfileController@saveProfile');

    Route::get('/order/new', 'OrderController@showOrderForm');
    Route::post('/order/new', 'OrderController@addOrder')->name("new_order");

    Route::get('/get_division', 'DivisionController@getDivisionJSON');
    Route::get('/get_district/{div_id}', 'DistrictController@getDistrictJSON');
    Route::get('/get_upazila/{dist_id}', 'UpazilaController@getUpazilaJSON');
    Route::get('/get_postoffice/{upa_id}', 'PostOfficeController@getPostOfficeJSON');

    Route::get('/get_courier', 'CourierController@getCourierJSON');
    Route::get('/get_branch/{courier_id}', 'CourierController@getCourierBranchJSON');

    Route::post('/get_rate', 'RateController@getPrintRateJSON');

});

Route::middleware(['admin'])->group(function(){
    Route::get('/dashboard/order/{id}', 'OrderController@showOrderDetails')->name('order_details');
    Route::get('/order/remove/{id}', 'OrderController@removeOrder')->name('remove_order');
    Route::get('/envelop/{id}', 'OrderController@printEnvelop')->name('envelop');

    Route::post('/division/new', 'DivisionController@addDivision')->name('new_division');
    Route::post('/district/new', 'DistrictController@addDistrict')->name('new_district');
    Route::post('/upazila/new', 'UpazilaController@addUpazila')->name('new_upazila');
    Route::post('/post_office/new', 'PostOfficeController@addPostOffice')->name('new_post_office');
    Route::post('/courier/new', 'CourierController@addCourier')->name('new_courier');
    Route::post('/branch/new', 'CourierController@addBranch')->name('new_courier_branch');

    Route::get('/color/get', 'PrintColorController@getPrintColorJSON');
    Route::post('/color/new', 'PrintColorController@addColor')->name('new_color');
    Route::get('/print_type/get', 'PrintTypeController@getPrintTypeJSON');
    Route::post('/print_type/new', 'PrintTypeController@addPrintType')->name('new_print_type');
    Route::get('/print_side/get', 'PrintSideController@getPrintSideJSON');
    Route::post('/print_side/new', 'PrintSideController@addPrintSide')->name('new_print_side');
    Route::get('/paper_size/get', 'PaperSizeController@getPaperSizeJSON');
    Route::post('/paper_size/new', 'PaperSizeController@addPaperSize')->name('new_paper_size');
    Route::get('/paper_type/get', 'PaperTypeController@getPaperTypeJSON');
    Route::post('/paper_type/new', 'PaperTypeController@addPaperType')->name('new_paper_type');
    Route::post('/print_rate/new', 'RateController@addPrintRate')->name('new_print_rate');
    
    Route::get('/download/{type}/{file}', function($type, $file){
        return response()->download(public_path('/storage/'.$type."/".$file));
        // return Storage::get($type."/".$file);
    })->name('download');
});
// Route::get('/test', 'TestController@addRandomPrintRate');

  <?php

  /*
|-------------------------------------------------------------------------- |
Web Routes
|-------------------------------------------------------------------------- |
| Here is where you can register web routes for your application. These |
routes are loaded by the RouteServiceProvider within a group which | contains
the "web" middleware group. Now create something great! | */

    Route::get('/', function () {
      return view('welcome');
    });
    Route::group(['middleware' => ['App\Http\Middleware\AdminMiddleware']], function () {
      
    });
    Route::get('/goldy', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:cache');
     
     
    return "Cache is cleared";
});
    Route::get('admin', 'Auth\\LoginController@admin');
  //=====================Admin Authentication work rout======================
    Route::group(['middleware' => ['auth', 'admin']], function() {
      //my routing here
  
  
   Route::resource('admin/feestudent', 'Admin\\FeeStudentController');
   Route::resource('admin/feestructure', 'Admin\\FeestructureController');
   Route::POST('admin/feestructure/{id}', 'Admin\\FeestructureController@update');
   Route::resource('admin/studenttotalfee', 'Admin\\StudentTotalFeeController');
  Route::resource('admin/feetype', 'Admin\\FeeTypeController');
      Route::resource('admin/role', 'Admin\\RoleController');
      Route::get('/importcsvdata', 'Admin\\FeeStudentController@importcsv');
       Route::get('admin/feestudent/active/{id}/{type}', 'Admin\\FeeStudentController@active');
      
      Route::post('admin/feestudent/uploadcsv', 'Admin\\FeeStudentController@uploadcsv');
      Route::post('savedata', 'Admin\\FeeStudentController@savedatacsv');
      // AJAX CALL Function ==========================
       Route::post('admin/structurelistajax', 'Admin\\FeestructureController@structurelistajax');
        Route::post('admin/studentlistajax', 'Admin\\FeestructureController@studentlistajax');
           Route::post('admin/uploaddataajax', 'Admin\\FeestructureController@uploaddataajax');
      

      //Route::get('admin/users', 'Admin\\SubcategorysController@users');
      Route::resource('admin/users', 'Admin\\UsersController');
      

    });
//======================================MMS User Login ===================================
//======================================Finance Login ===================================studenttotalfee
    Route::group(['middleware' => ['auth']], function() {
      
      Route::get('admin/fees-details','Admin\\FinaceController@index');
      Route::get('admin/getmasterfeesdetails','Admin\\FinaceController@view')->name('admin.getmasterfeesdetails');
      Route::get('admin/student-master-fee-details','Admin\\FinaceController@index');
      Route::get('view_fees_details/{id}','Admin\\FinaceController@viewdetails');
      Route::get('admin/feesallocations','Admin\\FinaceController@feesallocationslist')->name('admin/feesallocations');
      Route::get('admin/fee-report','Admin\\FinaceController@feereport');
      Route::post('admin/studentfeeslist','Admin\\FinaceController@studentfeeslist');
      Route::resource('admin/studenttotalfee', 'Admin\\StudentTotalFeeController');
      Route::POST('admin/studenttotalfee/{id}', 'Admin\\StudentTotalFeeController@update');
    });


//==========================End MMS User===================================
    Auth::routes();

  //===========================Login User =============================
       Route::group(['middleware' => ['auth', 'userlogin']], function() {
         Route::get('/previewpdf', 'HomeController@previewpdf');
    
        Route::get('feepay', 'HomeController@feepay');
        Route::post('feedetails', 'HomeController@feedetails');
          Route::post('feedetailspaytm', 'HomeController@feedetailspaytm');
        Route::get('payment/{id}', 'HomeController@payment');
        Route::get('paymentpaytm/{id}', 'HomeController@paymentpaytm');
        
        Route::get('paymentpartial/{id}', 'HomeController@paymentpartial');
        
    });
//======================================Finance Login ===================================
 

  Auth::routes();
  Route::get('sendmail', 'HomeController@sendmail');
  Route::get('/redirect', 'SocialAuthGoogleController@redirect');
  Route::get('/callback', 'SocialAuthGoogleController@callback');
  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
  Route::get('notify/index', 'NotificationController@index');
  ///Route::resource('admin/subcategorys', 'Admin\\SubcategorysController');
  Route::get('/home', 'HomeController@index')->name('home');
  // Route::get('/classroombook', 'Admin\\Feedback_allocationController@classroombook');
Route::any('subscribecancel', 'HomeController@subscribecancel');
 

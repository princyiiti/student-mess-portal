  <?php

  /*
|-------------------------------------------------------------------------- |
Web Routes
|-------------------------------------------------------------------------- |
| Here is where you can register web routes for your application. These |
routes are loaded by the RouteServiceProvider within a group which | contains
the "web" middleware group. Now create something great! | */

    Route::get('/', function () {
    //  return view('welcome');
      return view('webfront/index');
    });

    Route::group(['middleware' => ['App\Http\Middleware\AdminMiddleware']], function () {
      
    });
    
    Route::get('/webfront', function () {
      return view('webfront/index');
       // return view('welcome');
    });


    Route::get('/goldy', function() {
      Artisan::call('cache:clear');
      Artisan::call('view:clear');
      Artisan::call('route:clear');
      Artisan::call('config:cache');
      
      return "Cache is cleared";
    });

    Route::get('dummy_student_upload',function(){
      return view('dummy_import');
    });
    Route::post('importExcel', 'Admin\\UsersController@importExcel');
    Route::get('admin', 'Auth\\LoginController@admin');
  //=====================Admin Authentication work rout======================
    Route::group(['middleware' => ['auth', 'admin']], function() {

//============ELECTIVE COURSE LIST=================================
 Route::get('electivelist', 'HomeController@electivelist');
  Route::get('addelectivelist', 'HomeController@addelectivelist');
   Route::get('/deletecouse/{id}', 'HomeController@deletecouse');
  Route::post('saveelectivelist', 'HomeController@saveelectivelist');
//=====================saveelectivelist ELECTIVE COURSE LIST================
  //============New Student =============
  
   Route::get('/newstudentregistration', 'HomeController@newstudentregistration');
  Route::get('newusercreateform', 'HomeController@newusercreateform');
  Route::post('newusercreate', 'HomeController@newusercreate');
   Route::post('savestudentdata', 'HomeController@savestudentdata');
  

  

    Route::get('importnewuser', 'HomeController@importnewuser');
  Route::get('adminremovecourse/{id}', 'HomeController@adminremovecourse');
  Route::get('copycourseallocation', 'HomeController@copycourseallocation');
  
  
      //====================================
      Route::resource('admin/courseregiration', 'Admin\\CourseregirationController');

    Route::get('admin/deletchield/{id}','Admin\\CourseregirationController@deletchield');
      //=====================================Courtse Regitration work ======================
      //my routing here

     //Import User List 
     Route::get('admin/user/importcsv', 'Admin\\UsersController@importcsv')->name('admin/user/importcsv');
     Route::post('admin/user/uploadcsv', 'Admin\\UsersController@uploadcsv');
     Route::get('admin/messgetresponse/{id}','HomeController@messgetresponse');
    Route::get('admin/scanqrcode','HomeController@scanqrcode');
   
Route::resource('admin/student_mess_data', 'Admin\\Student_mess_dataController');
//Route::resource('admin/slot', 'Admin\\SlotController');
Route::resource('admin/rebate', 'Admin\\RebateController');
  Route::resource('admin/role', 'Admin\\RoleController');

  Route::resource('admin/messlist', 'Admin\\MesslistController');
  
   Route::resource('admin/feestudent', 'Admin\\FeeStudentController');
   Route::resource('admin/feestructure', 'Admin\\FeestructureController');
   Route::POST('admin/feestructure/{id}', 'Admin\\FeestructureController@update');
   
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
      Route::resource('admin/studenttotalfee', 'Admin\\StudentTotalFeeController');
      Route::POST('admin/studenttotalfee/{id}', 'Admin\\StudentTotalFeeController@update');
      Route::get('admin/rebate/active/{id}/{state}', 'Admin\\RebateController@active');
      Route::get('admin/rebetreportlist','Admin\\RebateController@demolist')->name('admin.rebetreportlist');
      Route::get('AllFeeExcel','Admin\\FeeStudentController@Allfeeexport')->name('AllFeeExcel');
      Route::get('admin/mess_data/delete/{id}','Admin\\Student_mess_dataController@destroy');
  

    });
//======================================MMS User Login ===================================



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
        Route::resource('admin/rebate', 'Admin\\RebateController');
         Route::get('courseregistration', 'HomeController@courseregistration');
           Route::post('courseregirationsave', 'HomeController@courseregirationsave');

        Route::get('paymentpartial/{id}', 'HomeController@paymentpartial');
         Route::post('saveremissiondata', 'HomeController@saveremissiondata');
        
        
    });
//======================================Finance Login ===================================studenttotalfee
    Route::group(['middleware' => ['auth']], function() {
      
      Route::get('admin/fees-details','Admin\\FinaceController@index');
      Route::get('admin/getmasterfeesdetails','Admin\\FinaceController@view')->name('admin.getmasterfeesdetails');
      Route::get('admin/mess_subcription','Admin\\Student_mess_dataController@Studentmessdata')->name('admin.mess_subcription');
      Route::get('admin/','Admin\\RebateController@demolist')->name('custom_demo_list');
      Route::get('admin/student-master-fee-details','Admin\\FinaceController@index')->name('admin/student-master-fee-details');
      Route::get('view_fees_details/{id}','Admin\\FinaceController@viewdetails');
      Route::get('admin/feesallocations','Admin\\FinaceController@feesallocationslist')->name('admin/feesallocations');
      Route::get('admin/fee-report','Admin\\FinaceController@feereport')->name('admin/fee-report');
      Route::post('admin/studentfeeslist','Admin\\FinaceController@studentfeeslist');
      Route::resource('admin/feetype', 'Admin\\FeeTypeController');
      Route::resource('admin/feestructure', 'Admin\\FeestructureController');
      Route::POST('admin/feestructure/{id}', 'Admin\\FeestructureController@update');
      Route::resource('admin/studenttotalfee', 'Admin\\StudentTotalFeeController');
      Route::POST('admin/studenttotalfee/{id}', 'Admin\\StudentTotalFeeController@update');
      Route::post('admin/structurelistajax', 'Admin\\FeestructureController@structurelistajax');
      Route::post('admin/studentlistajax', 'Admin\\FeestructureController@studentlistajax');
      Route::post('admin/uploaddataajax', 'Admin\\FeestructureController@uploaddataajax');
      Route::post('admin/user/uploadcsv', 'Admin\\UsersController@uploadcsv');
      Route::get('AllFeeExcel','Admin\\FeeStudentController@Allfeeexport')->name('AllFeeExcel');
      Route::get('messrebatExcel','Admin\\RebateController@Allmessrebat')->name('messrebatExcel');
      Route::get('admin/mess_data/delete/{id}','Admin\\Student_mess_dataController@destroy');
      
    });

    Route::group(['middleware' => ['auth', 'mmsuser']], function() {
      //my routing here
        //Report Section 
        Route::resource('admin/student_mess_data', 'Admin\\Student_mess_dataController');
         Route::get('admin/todayattendances','HomeController@todayattendances');
         Route::get('admin/todayrebate','HomeController@todayrebate');
         
         
        Route::get('admin/messgetresponse/{id}','HomeController@messgetresponse');

        Route::get('admin/scanqrcode','HomeController@scanqrcode');
      Route::get('admin/reportlist','Admin\\purchase_indentController@reportlist');
      Route::resource('admin/users', 'Admin\\UsersController');
      Route::resource('admin/denominations', 'Admin\\denominationsController');
      Route::resource('admin/subcategorys', 'Admin\\SubcategorysController');
      Route::resource('admin/subcription', 'Admin\\SubcriptionController');
      

    });
    Route::group(['middleware' => ['auth', 'studentaffairs']], function() {
  
      Route::resource('admin/messlist', 'Admin\\MesslistController');
      Route::get('admin/user/importcsv', 'Admin\\UsersController@importcsv')->name('admin/user/importcsv');
      // Route::resource('admin/studenttotalfee', 'Admin\\StudentTotalFeeController');
      // Route::POST('admin/studenttotalfee/{id}', 'Admin\\StudentTotalFeeController@update');
      Route::get('admin/rebate/active/{id}/{state}', 'Admin\\RebateController@active');
      Route::get('custom_demo_list','Admin\\RebateController@demolist')->name('custom_demo_list');
  
      Route::resource('admin/feestudent', 'Admin\\FeeStudentController');
      // Route::resource('admin/feestructure', 'Admin\\FeestructureController');
      Route::POST('admin/feestructure/{id}', 'Admin\\FeestructureController@update');
      
         Route::get('/importcsvdata', 'Admin\\FeeStudentController@importcsv');
          Route::get('admin/feestudent/active/{id}/{type}', 'Admin\\FeeStudentController@active');
         
         Route::post('admin/feestudent/uploadcsv', 'Admin\\FeeStudentController@uploadcsv');
         Route::post('savedata', 'Admin\\FeeStudentController@savedatacsv');
         Route::get('messrebatExcel','Admin\\RebateController@Allmessrebat')->name('messrebatExcel');
         Route::get('admin/rebetreportlist','Admin\\RebateController@demolist')->name('admin.rebetreportlist');
         Route::post('admin/rebate_approved','Admin\\RebateController@rebate_approved')->name('admin.rebate_approved');
    });


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
Route::get('current-plan','Admin\\RebateController@deletecurrentplan');
Route::get('/admin/deleteactiveplan/{id}','Admin\\RebateController@deleteplan');
 
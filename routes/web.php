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

Route::get('/',function(){
	return redirect('/login');
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return redirect()->back()->with('success','Successfully Clear Cache facade value.');
});
//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return redirect('/')->with('success','Successfully Clear Config cache.');
});

Auth::routes();
Route::get('/register',function(){
	return redirect('/login');
});

Route::group(['middleware' =>'auth'], function(){
	/*Settings*/
	Route::resource('/modality', 'SetModalityController');
	Route::resource('/procedure', 'SetProcedureController');
	Route::resource('/macros', 'SetMacrosController');
	Route::resource('/radiologist', 'RadiologistController');
	Route::resource('/radiologist-macro', 'RadiologistMacrosController');
	Route::resource('/hospital', 'HospitalController');
	Route::resource('/hospital-entry', 'HospitalEntryController');
	Route::get('/hospital-entry-show/{id}', 'HospitalEntryController@single');
	Route::post('/upload-images/{id}', 'HospitalEntryController@uploadImages');
	Route::get('/delete-photo/{id}', 'HospitalEntryController@deletePhoto');
	Route::resource('studylist','StudylistController');
	

	/*/Settings*/



	/*System Configuration*/
	Route::get('truncate', 'DashboardController@allTable');
	Route::get('truncate/{table}', 'DashboardController@truncateTable');
	Route::resource('acl-permission', 'AclPermissionController');
	Route::post('acl-permission-role', 'AclPermissionController@storeRole');
	Route::get('/dashboard', 'DashboardController@index');
	Route::resource('/users', 'UsersController');
	Route::post('change-password',['as'=>'password','uses'=>'UsersController@password']);
	Route::get('change-password','UsersController@changePass');
	Route::get('my-profile','UsersController@profile');
	/*======= My profile =====*/
	Route::resource('/my-profile', 'MyProfileController');
	Route::get('/change-my-password', 'MyProfileController@viewPassword');
	Route::post('/change-my-password', 'MyProfileController@changeMyPassword');

	/*company setting section*/
	Route::resource('company-info', 'CompanyInfoController');
	// logout
	Route::get('/logout', 'Auth\LoginController@logout');
	Route::resource('menu','MenuController');
	Route::resource('sub-menu','SubMenuController');
	Route::resource('sub-sub-menu','SubSubMenuController');
	/*/System Configuration*/

});

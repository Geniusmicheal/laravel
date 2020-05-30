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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');
// Route::get('/download/{id}', 'AuthController@download')->name('download');
Route::get('/oluwasegun', 'Backend\Backup@index');
Route::get('/download/{id}', function ($id) {
    return response()->streamDownload(function ()  use ($id) {
        echo file_get_contents(base64_decode($id));
    }, basename(base64_decode($id)));

})->name('download');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::group(['prefix'=>'control'], function () {

    Route::get('/', 'AuthController@index')->name('stafflogin');
    Route::post('/', 'AuthController@login');

    Route::group(['middleware' => 'auth:staff','namespace' => 'Backend' ,'prefix' => 'dashboard'], function () {
        
        Route::get('/', 'Home@dashboard')->name('staffdashboard');
        Route::get('/profile', 'Account@index')->name('staffprofile');

        Route::get('/editprofile', 'Account@edit')->name('staffeditprofile');
        Route::post('/editprofile', 'Account@update');
        Route::get('/editpassword', 'Account@editpassword')->name('staffeditpassword');
        Route::post('/editpassword', 'Account@changepassword');

        Route::get('/stafflog', 'Account@stafflog')->name('stafflog');
        Route::get('/category', 'Categtry@index')->name('staffcategory');
        Route::post('/category', 'Categtry@category');
        Route::get('/delete/{id}', 'Categtry@delete')->name('staffdelete');

        Route::get('/location', 'Categtry@location')->name('stafflocation');
        Route::post('/location', 'Categtry@country');
        Route::get('/overview', 'NewsContent@index')->name('staffoverview');
        Route::get('/addnews', 'NewsContent@show')->name('staffAddNews');

        Route::post('/addnews', 'NewsContent@upload');
        Route::get('/addnews/{id}', 'NewsContent@show')->name('staffEditNews');
        Route::post('/addnews/{id}', 'NewsContent@upload');
        Route::get('/viewnews/{id}', 'NewsContent@show')->name('staffViewNews');

        Route::get('/eventadd', 'Event@show')->name('staffaddevent');
        Route::post('/eventadd', 'Event@upload');
        Route::get('/event', 'Event@index')->name('staffevent');

        Route::get('/eventadd/{id}', 'Event@show')->name('staffEditevent');
        Route::get('/event/{id}', 'Event@show')->name('staffviewevent');
        Route::post('/eventadd/{id}', 'Event@upload');

        Route::get('/eventswitch/{id}', 'Event@switch')->name('staffeventswitch');
        // Route::get('/addnews/{id}', 'NewsContent@show')->name('staffEditNews');
        
        Route::get('/menu', 'Menu@index')->name('staffmenu');
        Route::get('/addMenu', 'Menu@create')->name('staffAddMenu');
    });
    // Route::get('/category', 'Category@index');
    // Route::get('dashboard', 'Admin@dashboard');dashboard/profile
});

Route::group(['namespace' => 'Userend'], function () {
    // Route::get('/', 'Home@index')->name('home')->middleware('auth:user');
    Route::get('/', 'Home@index')->name('home');
    Route::get('/tag-{type}/{id}', 'Home@read')->name('readnews');

    Route::post('/forumsignup', 'AuthController@signup')->name('usersignup');
    Route::post('/forumlogin', 'AuthController@login')->name('userlogin');
   

    Route::get('/tag-{tag}', 'Tags@index')->name('newstags');
    
    Route::get('/user/{id}', 'User@index')->name('userprofile');
    Route::get('/policy', 'Tags@policy')->name('userpolicy');
    Route::get('/contact', 'Tags@contact')->name('usercontact');
    Route::post('/contact', 'Tags@contactIpt');

    Route::post('/search/{id}', 'Search@index')->name('usersearch');
    

    Route::group(['middleware' => 'auth:user'], function () {

        Route::get('/userevent/{id}', 'User@event')->name('userevent');

        Route::post('comment', 'Comment@index')->name('comment');
        Route::post('like', 'Comment@vote')->name('like');

        Route::get('/updateprofile/{id}', 'User@edit')->name('editprofile');
        Route::post('/updateprofile', 'User@update')->name('updateprofile');

        Route::get('/changepassword/{id}', 'User@password')->name('userchangepassword');
        Route::post('/updatepassword', 'User@updatepassword')->name('userupdatepassword');

        Route::get('/add-{id}', 'Insert@index')->name('insertNews');

        Route::get('/edit-{type}/{id}', 'Insert@index')->name('editNews');
        Route::post('/news_event', 'Insert@event')->name('insertEvent');

        Route::post('/news_event/{id}', 'Insert@event')->name('editEvent');

        Route::post('/news_add', 'Insert@upload')->name('insertupload');

        Route::post('/news_add/{id}', 'Insert@upload')->name('editupload');
        
    });

});





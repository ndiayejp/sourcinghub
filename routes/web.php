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

Route::get('/',['as'=>'root_path','uses' =>'PagesController@home']);

Route::get('/a-propos',['as'=>'about_path','uses' =>'PagesController@about']);

Route::get('/cgu',['as'=>'cgu_path','uses' =>'PagesController@cgu']);

Route::get('/contact',['as'=>'contact_path','uses' =>'ContactsController@create']);

Route::post('/contact',['as'=>'contact_path','uses' =>'ContactsController@store']);



Route::get('account/{username}','UsersController@account')->name('account');

Route::get('myposts/{slug}','PostsController@index')->name('posts.index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/confirm/{id}/{token}','Auth\RegisterController@confirm');



Route::resource('posts','PostsController');

Route::resource('companies', 'CompaniesController');

Route::resource('tenders','TendersController');

Route::get('/quotation/{id}', 'TendersController@details')->name('quotation.details');

Route::get('/quotations',['as'=> 'quotations','uses'=> 'TendersController@getAll']);

Route::post('subscriber','SubscribersController@store')->name('subscriber.store');

Route::get('/myposts',['as'=>'myposts','uses' =>'PostsController@index']);

Route::get('/drafts',['as'=>'drafts','uses' =>'PostsController@drafts']);

Route::get('/inprogress',['as'=>'inprogress','uses' =>'PostsController@inprogress']);

Route::get('/archived',['as'=>'archived','uses' =>'PostsController@archived']);

Route::get('/archivedf',['as'=>'archivedf','uses'=>'UsersController@getArchived']);

Route::get('/posts',['as'=>'posts','uses' =>'PostsController@getAllPosts']);


Route::get('/user',['as'=>'user_path','uses' =>'UsersController@create']);

Route::post('/user',['as'=>'users.store','uses'=>'UsersController@store']);

Route::get('/entreprises',['as'=>'mycompanies','uses' =>'CompaniesController@index']);

Route::get('/search',['as'=>'search','uses'=>'SearchController@index']);

Route::get('/offre/{slug}',['as'=>'offre','uses'=>'PostsController@show']);

Route::post('items/{post_id}',['as'=>'items.store','uses'=>'ItemsController@store']);

Route::get('favoris',['as'=>'favourite','uses'=>'PostsController@favourite']);

Route::get('getCities/ajax/{id}',array( 'as'=>'getCities.ajax','uses'=>'PostsController@getCitiesAjax'));

Route::delete('/files/{file_id?}', array('as'=>'files.destroy','uses'=>'FilesController@destroy'));

Route::put('setting-update','SettingsController@updateProfile')->name('setting.update');

Route::put('password-update','SettingsController@updatePassword')->name('password.update');


Route::get('category/{category}','PostsController@category');

Auth::routes();

 

Route::group(['middleware'=>['auth']], function (){
    
    Route::post('favorite/{post}/add',['as'=>'post.favorite','uses'=>'FavoriteController@add' ]);
    
    Route::post('offre/{slug}','PostsController@reply')->name('posts.reply');

    Route::post('quotation/{id}', 'TendersController@reply')->name('tenders.reply');

    Route::post('/assign/{post}','AssignController@store')->name('assign.store');

    Route::post('/invite/post', 'InvitesController@store');

    Route::put('profile-update','ProfilesController@updateProfile')->name('profile.update');

    Route::get('providers','UsersController@getProviders')->name('providers');

 
    Route::get('profile/{company}/{id}','ProfilesController@profile')->name('profile');

    Route::post('profile/{id}','ProfilesController@store')->name('profile.store');

    Route::get('customers','UsersController@getCustomers')->name('customers');
});
 
Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'admin','middleware'=>['auth'=>'admin']],function(){

    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::resource('category','CategoriesController');
    Route::resource('country','CountriesController');
    Route::resource('state','StatesController');
    Route::resource('open','OpensController');
    Route::resource('unit','UnitsController');
    Route::resource('user','UserController');
    Route::resource('post','PostController');
    Route::resource('tender','TenderController');
    Route::resource('incoterm','IncotermController');

    Route::get('post/{slug}','PostController@show')->name('post.show');

    Route::get('/subscribers', 'UserController@subscribers')->name('user.subscribers');
    Route::get('/country','CountriesController@index')->name('country.index');
    Route::delete('/country/{country}','CountriesController@destroy')->name('country.destroy');

    Route::get('/city','CitiesController@index')->name('city.index');
    Route::delete('/city/{city}','CitiesController@destroy')->name('city.destroy');

    Route::get('/incoterm','IncotermController@index')->name('incoterm.index');
    Route::delete('/incoterm/{incoterm}','IncotermController@destroy')->name('incoterm.destroy');

    Route::get('settings','SettingsController@index')->name('settings');
    Route::put('profile-update','SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update','SettingsController@updatePassword')->name('password.update');
});

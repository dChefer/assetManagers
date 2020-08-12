<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::group([
    'prefix' => 'manufacturer',
    'middleware'=>['auth']
], function() {
    Route::get('/', 'ManufacturerController@index')->name('manufacturer');
    Route::post('/', 'ManufacturerController@store')->name('manufacturer_store');
    Route::get('/form', 'ManufacturerController@form')->name('manufacturer_form');
    Route::get('/{manufacturer}/form_update', 'ManufacturerController@formUpdate')->name('manufacturer_form_update');
    Route::put('/{manufacturer}/update', 'ManufacturerController@update')->name('manufacturer_update');
    Route::delete('/{manufacturer}/delete', 'ManufacturerController@delete')
        ->name('manufacturer_delete');


});

Route::group([
    'prefix' => 'place',
    'middleware' => 'auth'
], function () {
    Route::get('/', 'PlaceController@index')
        ->name('place');
    Route::post('/', 'PlaceController@store')
        ->name('place_store');
    Route::get('/form', 'PlaceController@form')
        ->name('place_form');
    Route::get('/{place}/form_update', 'PlaceController@formUpdate')
        ->name('place_form_update');
    Route::put('/{place}/update', 'PlaceController@update')
        ->name('place_update');
    Route::delete('/{place}/delete', 'PlaceController@delete')
        ->name('place_delete');
});

Route::group([
    'prefix' => 'category',
    'middleware' => 'auth'
], function () {
    Route::get('/', 'CategoryController@index')
        ->name('category');
    Route::post('/', 'CategoryController@store')
        ->name('category_store');
    Route::get('/form', 'CategoryController@form')
        ->name('category_form');
    Route::get('/{category}/form_update', 'CategoryController@formUpdate')
        ->name('category_form_update');
    Route::put('/{category}/update', 'CategoryController@update')
        ->name('category_update');
    Route::delete('/{category}/delete', 'CategoryController@delete')
        ->name('category_delete');
});


Route::group([
    'prefix' => 'equipment',
    'middleware' => 'auth'
], function () {
    Route::get('/', 'EquipmentController@index')
        ->name('equipment');
    Route::post('/', 'EquipmentController@store')
        ->name('equipment_store');
    Route::get('/form', 'EquipmentController@form')
        ->name('equipment_form');
    Route::get('/{equipment}/form_update', 'EquipmentController@formUpdate')
        ->name('equipment_form_update');
    Route::put('/{equipment}/update', 'EquipmentController@update')
        ->name('equipment_update');
    Route::delete('/{equipment}/delete', 'EquipmentController@delete')
        ->name('equipment_delete');
});


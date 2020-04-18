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

Auth::routes();

Route::middleware('auth')->get('/',function(){
    return redirect('/dashboard');
});
Route::middleware('auth')->get('/dashboard','DashboardController@index');

// Route::group(['prefix'=>'users'],function(){
//     Route::get('/')->name('users.index')->middleware('auth');
// });

Route::get('change-password','UsersController@change_password_index')->name('change.password');
Route::put('change-password/{id}','UsersController@change_password')->name('change.password.submit');
Route::resource('users','UsersController')->middleware('auth');
Route::resource('roles','RolesController')->middleware('auth');
Route::resource('expenses','ExpensesController')->middleware('auth');
Route::resource('expenses-category','ExpensesCategoryController')->middleware('auth');
Route::get('user-expenses/{user}','ExpensesController@user_expenses')->name('expenses.user')->middleware('auth');
Route::get('category-expenses/{user}/{category}','ExpensesController@category_expenses')->name('expenses.category')->middleware('auth');
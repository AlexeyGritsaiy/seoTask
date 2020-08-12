<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

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

Route::group([
   'as' => 'task.',
    'prefix' => '/task'
],function(Router $route) {
    $route->get('/', 'TaskController@index')->name('index');
    $route->get('/create', 'TaskController@showTaskForm')->name('create');
    $route->post('/create', 'TaskController@store')->name('create');
});

Route::get('/', function () {
    return redirect(route('task.index'));
});

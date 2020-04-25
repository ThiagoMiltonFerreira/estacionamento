<?php

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

/*

 Iniciar servidor artisan php - php artisan serve 
 ultiliza a porta 8000

 */

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
	
});

Route::get('/exitPatio', 'exitPatio@exit')->name("exitPatio");

Route::get('/principal', function () {
    return view('home');
	
});


Route::get('/home/{idVeiculo?}', 'HomeController@index')->name('home');

Route::resource('/patio','PatioController');
Route::resource('/veiculo','VeiculoController')->middleware('auth');
Route::post('/veiculo/relatorio', 'VeiculoController@relVeiculos')->name('relPatio');


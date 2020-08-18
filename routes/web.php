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

Route::get('/', 'DashboardController@index')->name('dashboard.index')->middleware(['auth']);
Route::get('/ajuda', 'DashboardController@ajuda')->name('ajuda.index')->middleware(['auth']);

Route::resource('/supports', 'SupportController')->middleware(['auth']);
Route::get('/supports/get/anexo/{nome}', 'SupportController@getAnexo')->middleware(['auth']);
Route::get('/supports/{chamado}/interacoes', 'SupportController@show')->name('chamado.show')->middleware(['auth']);
Route::get('/supports/{chamado}/print-os', 'SupportController@print')->name('chamado.print')->middleware(['auth']);
Route::get('/supports/print-os/avulsa', 'SupportController@printAvulsa')->name('chamado.print.avulsa')->middleware(['auth']);
Route::get('/supports/relatorio/export/{filter}', 'SupportController@export')->middleware(['auth']);
Route::get('/supports/{filter}', 'SupportController@fetch')->middleware(['auth']);

Route::resource('subdepartments', 'SubdepartmentController')->middleware(['auth']);

Route::get('sectors', 'SectorController@index')->middleware(['auth']);
Route::get('services', 'ServiceController@index')->middleware(['auth']);
Route::get('environments', 'EnvironmentController@index')->middleware(['auth']);
Route::get('spots', 'SpotController@index')->middleware(['auth']);

Route::get('/charts/setores', 'ChartController@chartSetores')->middleware(['auth']);
Route::get('/charts/servicos', 'ChartController@chartServicos')->middleware(['auth']);
Route::get('/charts/status', 'ChartController@chartStatus')->middleware(['auth']);

Route::post('/supports/{chamado}/interacoes', 'InteracaoController@store')->name('interacao.store')->middleware(['auth']);

// Google Auth
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/login/{provider}', 'Auth\SocialAccountController@redirectToProvider')->name('socialite.provider');
Route::get('/auth/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::get('/ajuda', 'DashboardController@ajuda')->name('ajuda.index');

    Route::get('/chamados', 'SupportController@index')->name('home');
    Route::post('/chamados/create', 'SupportController@store');
    Route::get('/chamados/create', 'SupportController@create')->name('chamado.create');
    Route::patch('/chamados/{chamado}/edit', 'SupportController@update');
    Route::get('/chamados/get/anexo/{nome}', 'SupportController@getAnexo');
    Route::get('/chamados/{chamado}/interacoes', 'SupportController@show')->name('chamado.show');
    Route::get('/chamados/{chamado}/print-os', 'SupportController@print')->name('chamado.print');
    Route::get('/chamados/print-os/avulsa', 'SupportController@printAvulsa')->name('chamado.print.avulsa');
    Route::get('/chamados/relatorio/export/{filter}', 'SupportController@export');
    Route::get('/chamados/{filter}', 'SupportController@fetch');

    Route::get('/charts/setores', 'ChartController@chartSetores');
    Route::get('/charts/servicos', 'ChartController@chartServicos');
    Route::get('/charts/status', 'ChartController@chartStatus');

    Route::post('/chamados/{chamado}/interacoes', 'InteracaoController@store')->name('interacao.store');
});

// Google Auth
Route::group(['middleware' => ['web']], function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/login/{provider}', 'Auth\SocialAccountController@redirectToProvider')->name('socialite.provider');
    Route::get('/auth/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Models\Pages;

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
    return redirect('/pages');
});
Route::resource('pages', PagesController::class);

// dynamic route to get last page content

Route::get('{page}', function ($all) {
    $ids = explode('/',$all);
    $last_id = end($ids);
    return view('admin.pages.view', [
        'page' => Pages::where('slug', $last_id)->firstOrFail(),
    ]);
})->where('page', '.*');

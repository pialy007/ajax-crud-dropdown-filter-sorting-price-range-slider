<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductFilterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::controller(StudentController::class)->group(function(){
    route::get('/addstudent', 'add_student')->name('add.student');
    route::post('/addstudent/store', 'addstudent_store')->name('addstudentst');
    route::get('/all/student', 'all_student')->name('student');
    route::get('/allstudent/view', 'allstudent_view')->name('allstudent.view');
    route::get('/editUser/{id}', 'getstudent')->name('getstudent');
    route::post('/updatestudent', 'updatestudent')->name('updatestudent');
    route::get('/deletedata/{id}', 'deletedata')->name('deletedata');
});

Route::controller(SearchController::class)->group(function(){
    route::get('/search', 'search_student')->name('search');
});

Route::controller(CategoryController::class)->group(function(){
    Route::get('/category', 'category')->name('category');
    Route::post('/category/store', 'category_store')->name('category.store');
});

Route::controller(ProductController::class)->group(function(){
    Route::get('/product', 'product')->name('product');
    Route::post('/product/store', 'product_store')->name('product.store');
    Route::get('/product/filter', 'product_filter')->name('product_filter');
});
Route::controller(DropdownController::class)->group(function(){
    Route::get('/dropdown', 'index');
    Route::post('api/fetch-state', 'fetch_state');
    Route::post('api/fetch-cities', 'fetch_city');

});
Route::controller(ProductFilterController::class)->group(function(){
    Route::get('/add/product', 'add_product')->name('add.product');
    Route::post('/productfilter/store', 'productfilter_store')->name('productfilter.store');
    Route::get('/productfilter', 'all_product')->name('all.product');
    Route::get('/search-product','search_products')->name('search.products');
    Route::get('/sort-by','sort_by')->name('sort.by');
});









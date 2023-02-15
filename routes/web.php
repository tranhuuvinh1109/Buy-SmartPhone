<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckLoginFrontend;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckLogout;


use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\FrontendController;

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminRegisterController;

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
Route::group(['namespace'=>'Frontend','prefix'=>'frontend'],function(){
    Route::group(['prefix'=>'login'],function (){
        Route::get('/', [LoginController::class, 'Login']);
        Route::post('/',[LoginController::class, 'PostLogin']);
    });
    Route::group(['prefix'=>'register'],function (){
        Route::get('/',[RegisterController::class, 'Register']);
        Route::post('/',[RegisterController::class, 'PostRegister']);
    });
    Route::get('/home', [FrontendController::class, 'Home']);
    Route::get('/logout', [FrontendController::class, 'Logout']);
    Route::get('/home/about', [FrontendController::class, 'About']);
    Route::group(['prefix'=>'product'],function (){
        Route::get('/new', [ProductController::class, 'GetNewProduct']);
        Route::get('/sale', [ProductController::class, 'GetSaleProduct']);
        Route::get('/{pro_id}', [FrontendController::class, 'ProfileProduct']);
        Route::post('/{pro_id}', [FrontendController::class, 'PostComment'])->middleware(CheckLoginFrontend::class);
    });
    Route::group(['prefix'=>'profile','middleware'=>'CheckLoginProfile'],function (){
        Route::get('/', [UserController::class, 'Profile']);
        Route::post('/', [RegisterController::class, 'PostProfile']);
    });
    Route::group(['prefix'=>'cart'],function (){
        Route::get('/add/{id}', [FrontendController::class, 'AddCart']);
        Route::get('/delete/{id}', [FrontendController::class, 'DeleteCart']);
        Route::get('/', [FrontendController::class, 'ListCart']);
        Route::post('/', [FrontendController::class, 'UpdateCart']);
    })->middleware(CheckLoginFrontend::class);
    Route::get('/error', [FrontendController::class, 'Error']);
    
    
});
Route::group(['namespace'=>'Admin'],function (){
    Route::group(['prefix'=>'login'],function (){
        Route::get('/', [AdminLoginController::class, 'GetLogin']);
        Route::post('/', [AdminLoginController::class, 'PostLogin']);
    })->middleware(CheckLogin::class);
    Route::group(['prefix'=>'admin'],function (){
        Route::get('/profile', [AdminHomeController::class, 'GetProfile']);
        Route::post('/profile', [AdminHomeController::class, 'UpdateProfile']);
        Route::get('/addBlog', [AdminBlogController::class, 'getInsertBlog']);
        Route::post('/addBlog', [AdminBlogController::class, 'postInsertBlog']);
        Route::get('/blog', [AdminBlogController::class, 'getBlog']);
        Route::get('/home', [AdminHomeController::class, 'Index']);
        Route::get('/logout', [AdminHomeController::class, 'Logout'])->name('logout');
        Route::group(['prefix'=>'product'],function(){
            Route::get('/', [AdminProductController::class, 'GetProduct']);
            Route::get('/add', [AdminProductController::class, 'AddProduct']);
            Route::post('/add', [AdminProductController::class, 'PostAddProduct']);
            Route::get('/edit/{id}', [AdminProductController::class, 'EditProduct']);
            Route::post('/edit/{id}', [AdminProductController::class, 'PostEditProduct']);
            Route::delete('/delete/{pro_id}', [AdminProductController::class, 'DeleteProduct']);

        });
        Route::group(['prefix'=>'cate'],function(){
            Route::get('/', [AdminCategoryController::class, 'GetCategory']);
            Route::get('/add', [AdminCategoryController::class, 'AddCategory']);
            Route::post('/add', [AdminCategoryController::class, 'PostAddCategory']);
            Route::get('/edit/{category_id}', [AdminCategoryController::class, 'EditCategory']);
            Route::post('/edit/{category_id}', [AdminCategoryController::class, 'PostEditCategory']);
            Route::delete('/delete/{category_id}', [AdminCategoryController::class, 'DeleteCategory']);

        });
    })->middleware(CheckLogout::class);
    Route::group(['prefix'=>'register'],function (){
        Route::get('/', [AdminRegisterController::class, 'GetRegister']);
        Route::post('/', [AdminRegisterController::class, 'PostRegister']);
    });


});

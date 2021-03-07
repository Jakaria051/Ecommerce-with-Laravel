<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Front\IndexController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Category;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('/admin')->namespace('Admin')->group(function () {

    //we will defined all the admin routes like /admin/dashboad  ..controller Admin.AdminComtroller
    Route::match(['get', 'post'],'/','AdminController@login');

    Route::group(['middleware' => ['admin']], function () {

        Route::get('dashboard','AdminController@dashboard');
        Route::get('settings','AdminController@settings');
        Route::get('logout','AdminController@logout');
        //ajax
        Route::post('check-current-pwd','AdminController@chkCurrentPassword');
        Route::post('update-current-pwd','AdminController@updateCurrentPassword');
        //
        Route::match(['get', 'post'], 'update-admin-details','AdminController@updateAdminDetails');

        //Sections
        Route::get('sections','SectionController@sections');
        Route::post('update-section-status','SectionController@updateSectionsStatus');

        //Brands
        Route::get('brands','BrandController@brands');
        Route::post('update-brand-status','BrandController@updateBrandsStatus');
        Route::match(['get','post'],'add-edit-brand/{id?}','BrandController@addEditBrand'); //2 things in one blade
        Route::get('delete-brand/{id}','BrandController@deleteBrand');


        //Categories
        Route::get('categories','CategoryController@categories');
        Route::post('update-category-status','CategoryController@updateCategoryStatus');
        Route::match(['get','post'],'add-edit-category/{id?}','CategoryController@addEditCategory'); //2 things in one blade
        Route::post('append-categories-level','CategoryController@appendCategoryLevel');
        Route::get('delete-category-image/{id}','CategoryController@deleteCategoryImage');
        Route::get('delete-category/{id}','CategoryController@deleteCategory');

        ///Products
        Route::get('products','ProductsController@products');
        Route::post('update-product-status','ProductsController@updateProductStatus');
        Route::get('delete-product/{id}','ProductsController@deleteProduct');
        Route::match(['get','post'],'add-edit-product/{id?}','ProductsController@addEditProduct');
        Route::get('delete-product-image/{id}','ProductsController@deleteProductImage');
        Route::get('delete-product-video/{id}','ProductsController@deleteProductVideo');

        //Attributes
        Route::match(['get','post'],'add-attributes/{id}','ProductsController@addAttributes');
        Route::post('edit-attributes/{id}','ProductsController@editAttributes');
        Route::post('update-attribute-status','ProductsController@updateAttributeStatus');
        Route::get('delete-attribute/{id}','ProductsController@deleteAttribute');


        //product Images
        Route::match(['get','post'],'add-images/{id}','ProductsController@addImages');
        Route::post('update-image-status','ProductsController@updateImageStatus');
        Route::get('delete-image/{id}','ProductsController@deleteImage');

        //Bannners
        Route::get('banners','BannersController@banners');
        Route::match(['get','post'],'add-edit-banner/{id?}','BannersController@addEditBanner'); //2 things in one blade
        Route::post('update-banner-status','BannersController@updateBannerStatus');
        Route::get('delete-banner/{id}','BannersController@deleteBanner');

    });
});

//Front
    Route::namespace('Front')->group(function(){
        Route::get('/','IndexController@index'); //home page route
       //listing
        $catUrls = Category::select('url')->where('status',1)->get()->pluck('url')->toArray();
        foreach($catUrls as $url)
        {
            Route::get('/'.$url,'ProductsController@listing'); //listing/Categoty route
        }
        //details
        Route::get('/product/{id}','ProductsController@detail');
        //Get Product Attribute Price
        Route::post('/get-product-price','ProductsController@getProductPrice'); //ajax
        //add to cart
        Route::post('/add-to-cart','ProductsController@addToCart');
        Route::get('/cart','ProductsController@cart');
        //update cart item quantity
        Route::post('/update-cart-item-qty','ProductsController@updateCartItemQty');
        //delete cart item
        Route::post('/delete-cart-item','ProductsController@deleteCartItem');

        //Login/Register
        Route::get('/login-register','UsersController@loginRegister');
        Route::post('/login','UsersController@loginUser')->name('login.user');
        Route::post('/register','UsersController@registerUser');
        Route::get('/logout','UsersController@logout');
        //validate email
        Route::match(['get','post'],'/check-email','UsersController@checkEmail');
        //confirm Account
        Route::match(['get','post'],'/confirm/{code}','UsersController@confirmAccount');


    });

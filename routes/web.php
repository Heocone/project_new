<?php

use App\Http\Livewire\CartComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VnpayController;
use App\Http\Livewire\AboutUsComponent;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminCategoriesComponent;
use App\Http\Livewire\Admin\AdminContactComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\Attribute\AdminAddAttributesComponent;
use App\Http\Livewire\Admin\Attribute\AdminAttributesComponent;
use App\Http\Livewire\Admin\Attribute\AdminEditAttributesComponent;
use App\Http\Livewire\Admin\Coupon\AdminAddCouponComponent;
use App\Http\Livewire\Admin\Coupon\AdminCouponsComponent;
use App\Http\Livewire\Admin\Coupon\AdminEditCouponComponent;
use App\Http\Livewire\Admin\Product\AdminAddProductComponent;
use App\Http\Livewire\Admin\Product\AdminEditProductComponent;
use App\Http\Livewire\Admin\Product\AdminProductComponent;
use App\Http\Livewire\Admin\Slider\AdminAddSliderComponent;
use App\Http\Livewire\Admin\Slider\AdminEditSliderComponent;
use App\Http\Livewire\Admin\Slider\AdminHomeSliderComponent;
use App\Http\Livewire\BlogComponent;
use App\Http\Livewire\BlogDetailComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\ThankyouComponent;
use App\Http\Livewire\User\Order\UserOrdersComponent;
use App\Http\Livewire\User\Order\UserOrdersDetailsComponent;
use App\Http\Livewire\User\UserEditProfileComponent;
use App\Http\Livewire\User\UserProfileComponent;
use App\Http\Livewire\VnpayComponent;

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

Route::get('/', HomeComponent::class)->name('home.index');

Route::get('/shop', ShopComponent::class)->name('shop.index');

Route::get('/product/{slug}',DetailsComponent::class)->name('product.details');

Route::get('/cart', CartComponent::class)->name('cart.index');

Route::get('/checkout', CheckoutComponent::class)->name('checkout.index');

Route::get('/product-category/{slug}/{scategory_slug?}', CategoryComponent::class)->name('product.category');

Route::get('/search', SearchComponent::class)->name('product.search');

Route::get('/wishlist', WishlistComponent::class)->name('shop.wishlist');

Route::get('/thank-you',ThankyouComponent::class)->name('thankiu');

Route::get('/contact-us',ContactComponent::class)->name('contactus');

Route::get('/Blog-us',BlogComponent::class)->name('Blog');

Route::get('/Blog-detail',BlogDetailComponent::class)->name('BlogDetail');

Route::get('About-us',AboutUsComponent::class)->name('AboutUs');

Route::get('/product-quick-view/{id}',[VnpayController::class,'Quickview'])->name('quickview');
Route::get('/quick-view',[VnpayController::class,'Quickview1'])->name('quickview1');


Route::middleware(['auth'])->group(function(){
    Route::get('/Vnpay',VnpayComponent::class)->name('Vnpay');

    Route::get('/VnpayC',[VnpayController::class,'index'])->name('VnpayC');

    Route::get('/gohome',[VnpayController::class,'gohome'])->name('gohome');

    Route::post('/vnpay_create_payment',[VnpayController::class, 'vnpay_create_payment']);

    Route::get('/return',[VnpayController::class, 'return']);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function(){
    Route::prefix('user')->group(function () {
        Route::get('/dashboard', UserDashboardComponent::class)->name('user.dashboard');
        Route::prefix('order')->group(function () {
            Route::get('/',UserOrdersComponent::class)->name('user.orders');
            Route::get('/{order_id}',UserOrdersDetailsComponent::class)->name('user.orderdetail');
        });
        Route::get('/profile',UserProfileComponent::class)->name('user.profile');
        Route::get('/profile/edit',UserEditProfileComponent::class)->name('user.editprofile');
    });
});

Route::middleware(['auth','authadmin'])->group(function(){
    Route::get('admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('admin/categories',AdminCategoriesComponent::class)->name('admin.categories');
    Route::get('admin/category/addd',AdminAddCategoryComponent::class)->name('admin.category.addd');
    Route::get('/admin/category/edit/{category_id}/{scategory_slug?}',AdminEditCategoryComponent::class)->name('admin.category.edit');

    Route::prefix('admin')->group(function () {
        //product
        Route::prefix('products')->group(function () {
            Route::get('/',AdminProductComponent::class)->name('admin.products');
            Route::get('/add',AdminAddProductComponent::class)->name('admin.products.add');
            Route::get('/edit/{product_id}',AdminEditProductComponent::class)->name('admin.products.edit');
        });
        //slider
        Route::prefix('sliders')->group(function () {
            Route::get('/',AdminHomeSliderComponent::class)->name('admin.sliders');
            Route::get('/add',AdminAddSliderComponent::class)->name('admin.sliders.add');
            Route::get('/edit/{slide_id}',AdminEditSliderComponent::class)->name('admin.sliders.edit');
        });
        //coupon
        Route::prefix('coupons')->group(function () {
            Route::get('/',AdminCouponsComponent::class)->name('admin.coupons');
            Route::get('/add',AdminAddCouponComponent::class)->name('admin.coupons.add');
            Route::get('/edit/{coupon_id}',AdminEditCouponComponent::class)->name('admin.coupons.edit');
        });
        //Attributes
        Route::prefix('attributes')->group(function () {
            Route::get('/',AdminAttributesComponent::class)->name('admin.attributes');
            Route::get('/add',AdminAddAttributesComponent::class)->name('admin.attribute.add');
            Route::get('/edit/{attribute_id}',AdminEditAttributesComponent::class)->name('admin.attribute.edit');
        });
        //Order
        Route::prefix('order')->group(function () {
            Route::get('/',AdminOrderComponent::class)->name('admin.orders');
            Route::get('/{order_id}',AdminOrderDetailsComponent::class)->name('admin.orderdetail');
        });
        //contact
        Route::prefix('contact')->group(function () {
            Route::get('/',AdminContactComponent::class)->name('admin.contact');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

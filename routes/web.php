<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Support;

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

Route::get('/soon', [Controller::class, 'soonView'])->name('soon');

Route::get('/', [Controller::class, 'view'])->name('home')->middleware(['auth', 'if-account-deleted']);
Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => '/profile', 'as' => 'profile.'], function () {
        Route::get('/account', \App\Http\Livewire\Profile\Account::class)->name('account');
        Route::post('/account/update/post', [ProfileController::class, 'accountUpdatePost'])->name('account.update.post');

        Route::get('/security', [ProfileController::class, 'securityView'])->name('security');
        Route::post('/security/update-password/post', [ProfileController::class, 'securityUpdatePasswordPost'])->name('security.update-password.post');

        Route::get('/bills-and-payments', \App\Http\Livewire\Profile\BillingAndPayments::class)->name('bills-and-payments');

//        Route::get('/billing', [ProfileController::class, 'billingView'])->name('billing');
//        Route::get('/connections', [ProfileController::class, 'connectionsView'])->name('connections');
    });

    Route::middleware(['surname.middleware'])->group(function () {
        Route::get('/documents', \App\Http\Livewire\Documents::class)->name('documents');

        Route::group(['prefix' => '/address', 'as' => 'address.'], function () {
            Route::get('/create', [AddressController::class, 'create'])->name('create');
            Route::post('/create/post', [AddressController::class, 'createPost'])->name('create.post');
            Route::get('/all', [AddressController::class, 'all'])->name('all');
            Route::get('/{id}/edit', [AddressController::class, 'edit'])->name('edit');
            Route::post('/{id}/edit/post', [AddressController::class, 'editPost'])->name('edit.post');
            Route::get('/{id}/delete', [AddressController::class, 'delete'])->name('delete');
        });

        Route::group(['as' => 'order.', 'prefix' => '/orders'], function () {
            Route::get('/', \App\Http\Livewire\Order\Table::class)->name('table');
            Route::get('/create', \App\Http\Livewire\Order\Create::class)->name('create')->middleware('if-ones-order-is-empty');
            Route::get('/{order_id}', \App\Http\Livewire\Order\View::class)->name('view');
            Route::get('/{order_id}/edit', \App\Http\Livewire\Order\Edit::class)->name('edit');

            Route::group(['as' => 'product.'], function () {
                Route::get('/{order_id}/add-product', \App\Http\Livewire\Order\Products\AddProducts::class)->name('add-product');
                Route::get('/{order_id}/product/{product_id}', \App\Http\Livewire\Order\Products\View::class)->name('view');
                Route::get('/{order_id}/product/{product_id}/edit', \App\Http\Livewire\Order\Products\Edit::class)->name('edit');
            });
        });

        Route::group(['prefix' => '/package', 'as' => 'package.'], function () {
            Route::get('/all', [PackageController::class, 'allPackages'])->name('all');
            Route::get('/create', [PackageController::class, 'createPackageView'])->name('create');
            Route::post('/create/post', [PackageController::class, 'createPackagePost'])->name('create.post');
            Route::get('/{id}', \App\Http\Livewire\Packages\Index::class)->name('view');
            Route::post('/{id}/add-order', [PackageController::class, 'addOrder'])->name('add-order');
            Route::get('/{id}/delete', [PackageController::class, 'deletePackage'])->name('delete');
        });

        Route::group(['prefix' => '/support', 'as' => 'support.'], function () {
            Route::get('/', Support\Table::class)->name('table');
            Route::get('/create', Support\Create::class)->name('create')->middleware('limit.ticket.creation');
            Route::get('/{id}/edit', Support\Edit::class)->name('edit');
            Route::get('/{id}/view', Support\View::class)->name('view');
        });
    });
});

Route::get('/check_country', [Controller::class, 'checkCountry'])->name('check-country');

Route::get('optimize', function () {
   echo 'asd';
    try {
        \Illuminate\Support\Facades\Artisan::call('optimize');
    } catch (Exception $exception) {
        echo 'asdsad';
    }
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

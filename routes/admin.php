<?php

use App\Http\Controllers\Admin;
use App\Http\Livewire;
use App\Http\Livewire\Admin\Support;
use Illuminate\Support\Facades\Route;

/////// ADMIN ////////
Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin|owner']], function () {
    Route::get('/', [Admin\AdminController::class, 'MainView'])->name('dashboard');

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', Livewire\Admin\User\Table::class)->name('table');
        Route::get('/create', Livewire\Admin\User\Create::class)->name('create');
        Route::get('/{user_id}/edit', Livewire\Admin\User\Edit::class)->name('edit');

        Route::group(['prefix' => 'address', 'as' => 'address.'], function () {
            Route::get('/{user_id}/create', Livewire\Admin\User\Address\Create::class)->name('create');
            Route::get('/{user_id}/edit/{address_id}', Livewire\Admin\User\Address\Edit::class)->name('edit');
        });
    });

    Route::group(['prefix' => 'orders', 'as' => 'order.'], function () {
        Route::get('/', Livewire\Admin\Orders\Table::class)->name('table');
        Route::get('/{order_id}/edit', Livewire\Admin\Orders\Edit::class)->name('edit');
        Route::get('/create', Livewire\Admin\Orders\Create::class)->name('create');

        Route::group(['prefix' => '{order_id}/product', 'as' => 'product.'], function () {
            Route::get('/{product_id}/edit', Livewire\Admin\Orders\Products\Edit::class)->name('edit');
            Route::get('/create', Livewire\Admin\Orders\Products\Create::class)->name('create');
        });
    });
    Route::group(['prefix' => 'package', 'as' => 'package.'], function () {
        Route::get('/', \App\Http\Livewire\Admin\Package\Table::class)->name('table');
        Route::get('/create', \App\Http\Livewire\Admin\Package\Create::class)->name('create');
        Route::get('/{id}/edit', \App\Http\Livewire\Admin\Package\Edit::class)->name('edit');
    });

    // TODO: rewrite to livewire
    Route::group(['prefix' => '/shop', 'as' => 'shop.'], function () {
        Route::get('/all', [Admin\Order\Product\ShopController::class, 'viewAll'])->name('all');
        Route::get('/add', [Admin\Order\Product\ShopController::class, 'addShop'])->name('add');
        Route::post('/add/post', [Admin\Order\Product\ShopController::class, 'addShopPost'])->name('add.post');
        Route::get('/{id}/edit', [Admin\Order\Product\ShopController::class, 'editShop'])->name('edit');
        Route::post('/{id}/edit/post', [Admin\Order\Product\ShopController::class, 'editShopPost'])->name('edit.post');
        Route::get('/{id}/delete', [Admin\Order\Product\ShopController::class, 'deleteShop'])->name('delete');

        Route::post('/updateOrder', [Admin\Order\Product\ShopController::class, 'updateOrder'])->name('updateOrder');
    });

    Route::group(['prefix' => '/documents', 'as' => 'documents.'], function () {
        // new
        Route::group(['prefix' => '/form', 'as' => 'form.'], function () {
            Route::get('/', Livewire\Admin\Document\Form\Table::class)->name('table');
            Route::get('/create', Livewire\Admin\Document\Form\Create::class)->name('create');
            Route::get('/{document_id}/edit', Livewire\Admin\Document\Form\Edit::class)->name('edit');
        });

        Route::group(['prefix' => '/user', 'as' => 'user.'], function () {
            Route::get('/', Livewire\Admin\Document\User\Table::class)->name('table');
            Route::get('/create', Livewire\Admin\Document\User\Create::class)->name('create');
            Route::get('/{user_id}/edit/{document_id}', Livewire\Admin\Document\User\Edit::class)->name('edit');
        });

        Route::post('/updateOrder', [Admin\DocumentController::class, 'updateOrder'])->name('updateOrder');
    });

    Route::group(['prefix' => '/support', 'as' => 'support.'], function () {
        Route::get('/', Support\Table::class)->name('table');
        Route::get('/create', Support\Create::class)->name('create');
        Route::get('/{ticket_id}/edit', Support\Edit::class)->name('edit');
    });

    Route::group(['prefix' => '/invoice', 'as' => 'invoice.'], function () {
        Route::get('/', Livewire\Admin\Invoice\Table::class)->name('table');
        Route::get('/create/order', Livewire\Admin\Invoice\Order\Create::class)->name('create.order');
        Route::get('/edit/{invoice_id}/order/{order_id}', Livewire\Admin\Invoice\Order\Edit::class)->name('edit.order');

        Route::get('/create/package', Livewire\Admin\Invoice\Package\Create::class)->name('create.package');
    });
});

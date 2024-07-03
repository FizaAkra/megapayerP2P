<?php

use App\Http\Controllers\Admin\AdminController as AdminAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
// routes/web.php










Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});
Route::get('/admin/upload', function () {
    return view('upload');
})->name('admin.upload.form');

Route::post('/admin/upload', [AdminAdminController::class, 'uploadFile'])->name('admin.upload');



//Crons
Route::get('cron', 'CronController@cron')->name('cron');

// Coin Payments
Route::controller('Gateway\PaymentController')->prefix('ipn')->name('ipn.')->group(function () {
    Route::post('crypto', 'cryptoIpn')->name('crypto');
});

// User Support Ticket
Route::controller('TicketController')->prefix('ticket')->name('ticket.')->group(function () {
    Route::get('/', 'supportTicket')->name('index');
    Route::get('new', 'openSupportTicket')->name('open');
    Route::post('create', 'storeSupportTicket')->name('store');
    Route::get('view/{ticket}', 'viewTicket')->name('view');
    Route::post('reply/{ticket}', 'replyTicket')->name('reply');
    Route::post('close/{ticket}', 'closeTicket')->name('close');
    Route::get('download/{ticket}', 'ticketDownload')->name('download');
  
});

Route::get('app/deposit/confirm/{hash}', 'Gateway\PaymentController@appDepositConfirm')->name('deposit.app.confirm');


Route::controller('AdvertisementController')->name('advertisement.')->prefix('ads')->group(function () {
    Route::get('{type}/{crypto}/{country?}/{gateway?}/{currency?}/{amount?}', 'allAds')->name('all');
});

Route::controller('SiteController')->group(function () {
    Route::post('/subscribe', 'subscribe')->name('subscribe');
    Route::get('/profile/{username}', 'publicProfile')->name('public.profile');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'contactSubmit');
    Route::get('/change/{lang?}', 'changeLanguage')->name('lang');
    Route::get('cookie-policy', 'cookiePolicy')->name('cookie.policy');
    Route::get('cookie/accept', 'cookieAccept')->name('cookie.accept');
    Route::get('blog/{slug}/{id}', 'blogDetails')->name('blog.details');
    Route::get('policy/{slug}', 'policyPages')->name('policy.pages');
    Route::get('placeholder-image/{size}', 'placeholderImage')->name('placeholder.image');
    Route::get('/{slug}', 'pages')->name('pages');
    Route::get('/', 'index')->name('home');
});

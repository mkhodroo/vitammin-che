<?php

use App\Events\SendSms;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SmsController;
use App\Jobs\CreatePDFJob;
use App\Models\Product;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/blog', function(){
    return header("Location: https://ngvkala.ir/blog");
})->name('blog');
Route::get('/contact-us', [HomeController::class, 'contact_us'])->name('contact-us');

Route::get('/test', function(){
    $s = new SmsController();
    $ar = [
        '09376922176',
        '09224261029'
    ];
    foreach($ar as $to){
        // $s->send_wellcome_sms($to, 'مرکز خدمات');
        sleep(5);
    }
    // return $s->send_wellcome_sms();
});

Route::get('event', function(){
    event(new SendSms("09376922176", "salam"));
});

Route::get('build-app', function () {
    Artisan::call('cache:clear');
    Artisan::call('migrate');
    return 'done';
});

Route::get('queue-start', function () {
    Artisan::call('queue:work');
    return 'queue started.';
});

Route::get('queue-stop', function () {
    Artisan::call('queue:restart');
    return 'queue stoped.';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::any('/get-newest-products', [ProductController::class, 'newest_products'])->name('get-newest_products');

Route::get('create-pdf', function(){
    CreatePDFJob::dispatch();
    return "asd";
});

Route::prefix('/admin')->middleware(['access'])->group(function(){
    require __DIR__.'/admin-products.php';
    require __DIR__.'/admin-producer-prices.php';
    require __DIR__.'/admin-producer-features.php';
    require __DIR__.'/inventory.php';
    require __DIR__.'/store.php';
    require __DIR__.'/orders.php';
    require __DIR__.'/methods.php';
    require __DIR__.'/product-catagories.php';
    require __DIR__.'/roles.php';
    require __DIR__.'/articles.php';
});

require __DIR__.'/carts.php';
require __DIR__.'/checkout.php';
require __DIR__.'/myorders.php';
require __DIR__.'/products.php';
require __DIR__.'/catagories.php';
require __DIR__.'/address.php';
require __DIR__.'/search.php';
require __DIR__.'/menu.php';
require __DIR__.'/requests.php';



require __DIR__.'/auth.php';

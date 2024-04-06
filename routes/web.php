<?php

use App\Http\Controllers\MenuController;
use App\Http\Livewire\Menu\CMS\Sands\Menu as SandsMenu;
use App\Http\Livewire\Menu\CMS\Kunyit\Menu as KunyitMenu;
use App\Http\Livewire\Menu\CMS\Beverage\Beverage as BeverageMenu;
use App\Http\Livewire\Menu\Promotion;
use App\Http\Livewire\Menu\Sands\Menu;
use App\Http\Livewire\Menu\Tags;
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

Route::get('/sands', [MenuController::class, 'SandsMenu'])->name('sands.frontend');
Route::get('/kunyit', [MenuController::class, 'KunyitMenu'])->name('kunyit.frontend');
Route::get('/beverages', [MenuController::class, 'Beverage'])->name('beverage.frontend');



Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified' ])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::get('tags', Tags::class)->name('tags');
    Route::get('promotions', Promotion::class)->name('promotions');
    Route::prefix('backend')->group(function () {
        Route::get('/sands', SandsMenu::class)->name('sands.backend');
        Route::get('/kunyit', KunyitMenu::class)->name('kunyit.backend');
        Route::get('/beverage', BeverageMenu::class)->name('beverage.backend');
    });
});

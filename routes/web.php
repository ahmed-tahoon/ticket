<?php

use App\Http\Livewire\Pages\ArticleDetails;
use App\Http\Livewire\Pages\CollectionDetails;
use App\Http\Livewire\Pages\CollectionList;
use App\Http\Livewire\Pages\Welcome;
use App\Http\Livewire\Setup\Setup;
use App\Http\Middleware\RedirectIfNotSetup;
use App\Http\Middleware\RedirectIfSetupFinished;
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

Route::middleware(RedirectIfNotSetup::class)->group(function () {
    Route::get('/', Welcome::class)->name('guest.welcome');
    Route::get('collections', CollectionList::class)->name('guest.collection-list');
    Route::get('collections/{collection:slug}', CollectionDetails::class)->name('guest.collection-details');
    Route::get('articles/{article:slug}', ArticleDetails::class)->name('guest.article-details');
});

Route::get('setup', Setup::class)->name('setup')->middleware(RedirectIfSetupFinished::class);

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/agent.php';
require __DIR__ . '/utilities.php';

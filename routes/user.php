<?php

use App\Http\Controllers\Auth\OTPController;
use App\Http\Livewire\User\ProfileManager;
use App\Http\Livewire\User\Ticket\TicketCreator;
use App\Http\Livewire\User\Ticket\TicketDetails;
use App\Http\Livewire\User\Ticket\TicketList;
use App\Http\Middleware\RedirectIfNotSetup;
use Illuminate\Support\Facades\Route;


Route::get('otp', [OTPController::class, 'create'])
    ->name('otp')->middleware('auth');

Route::post('otp', [OTPController::class, 'store'])->middleware('auth');

Route::group([
    'middleware' => [
        RedirectIfNotSetup::class,
        'auth', 'prevent-banned-user',
        'check-otp'
    ],
    'prefix' => 'user',
    'as' => 'user.',
], function () {
    Route::get('profile', ProfileManager::class)->name('profile');
    Route::get('tickets', TicketList::class)->name('tickets.list');
    Route::get('tickets/create', TicketCreator::class)->name('tickets.create');
    Route::get('tickets/{ticket}', TicketDetails::class)->name('tickets.details');
});

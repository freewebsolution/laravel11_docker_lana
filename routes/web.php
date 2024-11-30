<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Rotte per ticket
    Route::get('/tickets/create', [TicketsController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketsController::class, 'store'])->name('tickets.store');
    Route::get('/tickets', [TicketsController::class, 'index'])->name('tickets.index');
    
    // Rotta per visualizzare un singolo ticket
    Route::get('/tickets/{ticket}', [TicketsController::class, 'show'])->name('tickets.show');
    
    // Rotta per modificare un ticket
    Route::get('/tickets/{ticket}/edit', [TicketsController::class, 'edit'])->name('tickets.edit');
    Route::patch('/tickets/{ticket}', [TicketsController::class, 'update'])->name('tickets.update');

    
    // Rotta per eliminare un ticket
    Route::delete('/tickets/{ticket}', [TicketsController::class, 'destroy'])->name('tickets.destroy');
    
});

require __DIR__.'/auth.php';

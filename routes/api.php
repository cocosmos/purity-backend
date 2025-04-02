<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameSessionController;
use App\Http\Controllers\PlayerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/players', [PlayerController::class, 'store'])->name('players.store');

Route::get('/games', [GameController::class, 'index'])->name('games.index');
Route::post('/game-sessions/start', [GameSessionController::class, 'start'])->name('game-sessions.start');
Route::post('/game-sessions/{gameSession}/answer', [AnswerController::class, 'respond'])->name('game-sessions.answer');
Route::get('/game-sessions/{gameSession}/result', [GameSessionController::class, 'result'])->name('game-sessions.result');

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return [
        'name' => 'Laravel',
        'framework' => 'Inertia',
        'version' => Application::VERSION,
        'php' => PHP_VERSION,
    ];
});

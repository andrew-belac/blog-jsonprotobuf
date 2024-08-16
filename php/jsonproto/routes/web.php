<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/create/{size}", [\App\Http\Controllers\BenchmarkController::class, 'create']);

Route::get("/json/unshaped/{size}/{iters}", [\App\Http\Controllers\BenchmarkController::class, 'unshaped']);

Route::get("/json/shaped/{size}/{iters}",  [\App\Http\Controllers\BenchmarkController::class, 'shaped']);

Route::get("/json/carbon/{size}/{iters}",  [\App\Http\Controllers\BenchmarkController::class, 'shapedCarbon']);

Route::get("/proto/{size}/{iters}", [\App\Http\Controllers\BenchmarkController::class, 'proto']);

Route::get("/protojson/{size}/{iters}", [\App\Http\Controllers\BenchmarkController::class, 'protoJson']);

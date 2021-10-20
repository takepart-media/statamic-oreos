<?php

use Illuminate\Support\Facades\Route;
use Takepart\Oreos\Controllers\OreosController;

Route::post('save', [OreosController::class, 'save'])->name('statamic.oreos.save');
Route::post('save-all', [OreosController::class, 'saveAll'])->name('statamic.oreos.saveall');

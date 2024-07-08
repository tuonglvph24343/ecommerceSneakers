<?php
/**admin router */

use App\Http\Controllers\Backend\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard',[AdminController::class,'dashboard' ])->name('dashboard'); 
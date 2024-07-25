<?php

use App\Http\Controllers\ContactController;
use Illuminate\support\Api\routes;

Route::apiResource('contacts', ContactController::class);

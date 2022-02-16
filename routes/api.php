<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware(['ApiKey'])->group(function () {
    Route::get('/', function() {
        return response()->json([
            'status' => 'success',
            'version' => 'v1',
            'baseUrl'  => 'http://locahost:9001/api/v1'
        ], 200);
    });
});

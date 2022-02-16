<?php

use App\Http\Controllers\Api\v1\GitHubController;
use App\Http\Controllers\Api\v1\RepositoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware(['ApiKey'])->group(function () {
    Route::get('/', function() {
        return response()->json([
            'status' => 'success',
            'version' => 'v1',
            'baseUrl'  => 'http://locahost:9001/api/v1'
        ], 200);
    });

    Route::resource('repositories', RepositoryController::class);
    Route::get('github', [GitHubController::class, 'index']);
    Route::post('github/get-repository-by-name', [GitHubController::class, 'getRepositoryByName']);
});

<?php

use App\Http\Controllers\Api\V1\RootController;
use App\Http\Controllers\Api\V1\SurahController;
use App\Http\Controllers\Api\V1\VerseController;
use App\Http\Controllers\Api\V1\WordController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->namespace('App\Http\Controllers\Api\V1')->group(function () {
    Route::prefix('/surah')->group(function () {
        Route::get('/', [SurahController::class, 'getAll']);
        Route::post('/find/title', [SurahController::class, 'findWithTitle']);
        Route::post('/edit/title', [SurahController::class, 'editTitle']);
    });

    Route::prefix('/verse')->group(function () {
        Route::get('/', [VerseController::class, 'getAll']);
        Route::get('/{id}', [VerseController::class, 'getOneDetails']);
        Route::prefix('/find')->group(function () {
            Route::post('/title', [VerseController::class, 'findWithTitle']);
            Route::post('/translate', [VerseController::class, 'findWithTranslate']);
            Route::prefix('/root')->group(function () {
                Route::post('/id', [VerseController::class, 'findWithRootID']);
                Route::post('/title', [VerseController::class, 'findWithRootTitle']);
            });
            Route::prefix('/word')->group(function () {
                Route::post('/id', [VerseController::class, 'findWithWordID']);
                Route::post('/title', [VerseController::class, 'findWithWordTitle']);
            });
            Route::prefix('/surah')->group(function () {
                Route::post('/id', [VerseController::class, 'findWithSurahID']);
                Route::post('/title', [VerseController::class, 'findWithSurahTitle']);
                Route::get('/{surah_number}/{verse_number}', [VerseController::class, 'findWithSurahAndVerse']);
            });
            Route::get('/juz/{juz_number}', [VerseController::class, 'findWithJuzNumber']);
            Route::prefix('/hizb')->group(function () {
                Route::post('/id', [VerseController::class, 'findWithHizbID']);
                Route::post('/number', [VerseController::class, 'findWithHizbNumber']);
            });
            Route::get('/page/{page_number}', [VerseController::class, 'findWithPageNumber']);
            Route::get('/{verse_number}', [VerseController::class, 'findWithVerseNumber']);
        });
        Route::prefix('/edit')->group(function () {
            /* Route::post('/content', [VerseController::class, 'editContent']); */
            Route::post('/translate', [VerseController::class, 'editTranslate']);
        });
    });

    Route::prefix('/root')->group(function () {
        Route::get('/', [RootController::class, 'getAll']);
        Route::get('/{id}', [RootController::class, 'getWithID']);
        Route::prefix('/find')->group(function () {
            Route::prefix('/word')->group(function () {
                Route::post('/id', [RootController::class, 'findWithWordID']);
            });
            Route::prefix('/verse')->group(function () {
                Route::post('/id', [RootController::class, 'getWithVerseID']);
            });
            Route::post('/title', [RootController::class, 'findWithRootTitle']);
        });
        Route::prefix('/edit')->group(function () {
            Route::post('/title', [RootController::class, 'editTitle']);
        });
        Route::post('/delete', [RootController::class, 'deleteOne']);
    });

    Route::prefix('/word')->group(function () {
        Route::get('/', [WordController::class, 'getAll']);
        Route::get('/{id}', [WordController::class, 'getWithID']);
        Route::get('/{id}/similars', [WordController::class, 'getOneSimilars']);
        Route::prefix('/find')->group(function () {
            Route::post('/verse/id', [WordController::class, 'getWordsOfVerse']);
            Route::prefix('/root')->group(function () {
                Route::post('/id', [WordController::class, 'findWithRootID']);
                Route::post('/title', [WordController::class, 'findWithRootTitle']);
            });
            Route::post('/title', [WordController::class, 'findWithTitle']);
            Route::post('/translate', [WordController::class, 'findWithTranslate']);
        });
        Route::prefix('/edit')->group(function () {
            Route::post('/title', [WordController::class, 'editTitle']);
            Route::post('/translate', [WordController::class, 'editTranslate']);
            Route::post('/root', [WordController::class, 'editRoot']);
        });
        Route::post('/delete', [WordController::class, 'delete']);
    });
});

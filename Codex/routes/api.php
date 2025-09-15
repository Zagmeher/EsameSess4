<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UtentiController;
use App\Http\Controllers\ContattiController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\IndirizziController;
use App\Http\Controllers\RecapitiController;
use App\Http\Controllers\SerietvController;
use App\Http\Controllers\EpisodiController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\NazioniController;
use App\Http\Controllers\ComuniItalianiController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\DebugController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rotte per l'autenticazione (pubbliche)
Route::group(['prefix' => 'auth'], function () { // Rimosso il middleware temporaneamente
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

// Rotte per l'autenticazione admin (pubbliche)
Route::group(['prefix' => 'admin'], function () {
    Route::post('login', [AuthAdminController::class, 'login']);
});

// Rotte protette che richiedono autenticazione
Route::group(['middleware' => ['auth:api']], function () {
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
        Route::post('change-password', [AuthController::class, 'changePassword']);
    });
    
    // Rotte per utenti normali e amministratori
    Route::group(['middleware' => ['user']], function () {
        // Film - accesso in sola lettura per utenti
        Route::get('film', [FilmController::class, 'index']);
        Route::get('film/{id}', [FilmController::class, 'show']);
        Route::get('film/categoria/{idCategoria}', [FilmController::class, 'getFilmByCategoria']);
        Route::get('film/anno/{anno}', [FilmController::class, 'getFilmByAnno']);
        Route::get('film/search', [FilmController::class, 'searchFilm']);
        
        // Serie TV - accesso in sola lettura per utenti
        Route::get('serietv', [SerietvController::class, 'index']);
        Route::get('serietv/{id}', [SerietvController::class, 'show']);
        
        // Episodi - accesso in sola lettura per utenti
        Route::get('episodi', [EpisodiController::class, 'index']);
        Route::get('episodi/{id}', [EpisodiController::class, 'show']);
        Route::get('serietv/{serieId}/episodi', [EpisodiController::class, 'getEpisodiBySerieId']);
        Route::get('serietv/{serieId}/stagione/{stagione}', [EpisodiController::class, 'getEpisodiBySeasonNumber']);
        
        // Categorie - accesso in sola lettura per utenti
        Route::get('categorie', [CategorieController::class, 'index']);
        Route::get('categorie/{id}', [CategorieController::class, 'show']);
        
        // Dati utente - modifica solo dei propri dati
        Route::get('utenti/{id}', [UtentiController::class, 'show'])->where('id', '[0-9]+');
        Route::put('utenti/{id}', [UtentiController::class, 'update'])->where('id', '[0-9]+');
        
        // Rotte risorse comuni - accesso in sola lettura
        Route::get('nazioni', [NazioniController::class, 'index']);
        Route::get('nazioni/{id}', [NazioniController::class, 'show']);
        Route::get('comuni-italiani', [ComuniItalianiController::class, 'index']);
        Route::get('comuni-italiani/{id}', [ComuniItalianiController::class, 'show']);
    });
    
    // Rotte solo per amministratori
    Route::group(['middleware' => 'admin'], function () {
        // Rotte admin auth protette
        Route::prefix('admin')->group(function () {
            Route::post('logout', [AuthAdminController::class, 'logout']);
            Route::post('refresh', [AuthAdminController::class, 'refresh']);
            Route::get('me', [AuthAdminController::class, 'me']);
        });
        
        // Gestione completa utenti
        Route::get('utenti', [UtentiController::class, 'index']);
        Route::post('utenti', [UtentiController::class, 'store']);
        Route::put('utenti/{id}', [UtentiController::class, 'update']);
        Route::delete('utenti/{id}', [UtentiController::class, 'destroy']);
        
        // Gestione completa contatti
        Route::apiResource('contatti', ContattiController::class);
        
        // Gestione completa password
        Route::apiResource('passwords', PasswordController::class);
        
        // Gestione completa indirizzi
        Route::apiResource('indirizzi', IndirizziController::class);
        Route::get('contatti/{idContatto}/indirizzi', [IndirizziController::class, 'getIndirizziByContatto']);
        
        // Gestione completa recapiti
        Route::apiResource('recapiti', RecapitiController::class);
        Route::get('contatti/{idContatto}/recapiti', [RecapitiController::class, 'getRecapitiByContatto']);
        Route::get('recapiti/tipo/{idTipoRecapito}', [RecapitiController::class, 'getRecapitiByTipo']);
        
        // Gestione completa serie TV
        Route::post('serietv', [SerietvController::class, 'store']);
        Route::put('serietv/{id}', [SerietvController::class, 'update']);
        Route::delete('serietv/{id}', [SerietvController::class, 'destroy']);
        
        // Gestione completa episodi
        Route::post('episodi', [EpisodiController::class, 'store']);
        Route::put('episodi/{id}', [EpisodiController::class, 'update']);
        Route::delete('episodi/{id}', [EpisodiController::class, 'destroy']);
        
        // Gestione completa categorie
        Route::post('categorie', [CategorieController::class, 'store']);
        Route::put('categorie/{id}', [CategorieController::class, 'update']);
        Route::delete('categorie/{id}', [CategorieController::class, 'destroy']);
        
        // Gestione completa film
        Route::post('film', [FilmController::class, 'store']);
        Route::put('film/{id}', [FilmController::class, 'update']);
        Route::delete('film/{id}', [FilmController::class, 'destroy']);
        
        // Gestione completa file
        Route::apiResource('file', FileController::class);
        
        // Gestione completa delle risorse comuni
        Route::post('nazioni', [NazioniController::class, 'store']);
        Route::put('nazioni/{id}', [NazioniController::class, 'update']);
        Route::delete('nazioni/{id}', [NazioniController::class, 'destroy']);
        
        Route::post('comuni-italiani', [ComuniItalianiController::class, 'store']);
        Route::put('comuni-italiani/{id}', [ComuniItalianiController::class, 'update']);
        Route::delete('comuni-italiani/{id}', [ComuniItalianiController::class, 'destroy']);
    });
});

// Rotte pubbliche accessibili senza autenticazione
Route::group(['middleware' => 'public'], function () {
    // Informazioni di base sui film (accesso pubblico limitato)
    Route::get('public/film', [FilmController::class, 'publicIndex']);
    Route::get('public/film/{id}', [FilmController::class, 'publicShow']);
    
    // Informazioni di base sulle serie TV (accesso pubblico limitato)
    Route::get('public/serietv', [SerietvController::class, 'publicIndex']);
    Route::get('public/serietv/{id}', [SerietvController::class, 'publicShow']);
    
    // Categorie pubbliche
    Route::get('public/categorie', [CategorieController::class, 'publicIndex']);
});

// Fallback route per rotte non definite
Route::fallback(function(){
    return response()->json([
        'success' => false,
        'message' => 'Risorsa non trovata.'
    ], 404);
});

// Rotta di test
Route::get('/test', function() {
    return response()->json(['message' => 'API funzionante!']);
});

// Rotte debug (RIMUOVERE IN PRODUZIONE!)
Route::get('/debug/contatti', [DebugController::class, 'showContatti']);
Route::get('/debug/admin', [DebugController::class, 'showAdmin']);

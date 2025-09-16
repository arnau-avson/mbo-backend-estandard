<?php
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ChatController;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\NotificacionesController;

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/verify-pin', [AuthController::class, 'verifyPin']);
        Route::post('/request-change-password', [AuthController::class, 'requestChangePassword']);
        Route::post('/confirm-change-password', [AuthController::class, 'confirmChangePassword']);
        Route::post('/request-change-email-password', [AuthController::class, 'requestChangeEmailAndPassword']);
    });

    Route::prefix('chat')->group(function () {
        Route::post('/crear', [ChatController::class, 'crearChat']);
        Route::post('/responder', [ChatController::class, 'responderChat']);
        Route::post('/marcar-leido', [ChatController::class, 'marcarMensajeLeido']);
    });

    use App\Http\Controllers\CvController;
    Route::prefix('cv')->group(function () {
        Route::post('/experiencia', [CvController::class, 'addExperiencia']);
        Route::put('/experiencia/{id}', [CvController::class, 'updateExperiencia']);
        Route::delete('/experiencia/{id}', [CvController::class, 'deleteExperiencia']);

        Route::post('/formacion', [CvController::class, 'addFormacion']);
        Route::put('/formacion/{id}', [CvController::class, 'updateFormacion']);
        Route::delete('/formacion/{id}', [CvController::class, 'deleteFormacion']);

        Route::post('/idioma', [CvController::class, 'addIdioma']);
        Route::put('/idioma/{id}', [CvController::class, 'updateIdioma']);
        Route::delete('/idioma/{id}', [CvController::class, 'deleteIdioma']);

        Route::post('/dato-extra', [CvController::class, 'addDatoExtra']);
        Route::put('/dato-extra/{id}', [CvController::class, 'updateDatoExtra']);
        Route::delete('/dato-extra/{id}', [CvController::class, 'deleteDatoExtra']);
    });

    Route::prefix('notificaciones')->middleware('auth:sanctum')->group(function () {
        Route::post('/crear', [NotificacionesController::class, 'crear']);
        Route::patch('/{id}/marcar-leida', [NotificacionesController::class, 'marcarLeida']);
    });
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/todoist', function (Request $request) {
     // Recuperar todo el contenido del request (datos, encabezados, etc.)
     $requestData = print_r($request->all(), true); // Obtener los datos en formato legible
     $requestHeaders = print_r($request->headers->all(), true); // Obtener los encabezados

     // Puedes agregar más información como los métodos y la URL del request
     $additionalInfo = "Method: " . $request->method() . "\n";
     $additionalInfo .= "URL: " . $request->fullUrl() . "\n";

     // Combinar la información en un string
     $content = $additionalInfo . "\nHeaders:\n" . $requestHeaders . "\nData:\n" . $requestData;

     // Escribir en un archivo .txt en el storage de Laravel (storage/app/requests.txt)
     Storage::put('requests.txt', $content);
});

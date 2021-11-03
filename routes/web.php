<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/', function() {
    $q = request('q');

    $client = new GuzzleHttp\Client();

    $response = $client
        ->get("https://api-adresse.data.gouv.fr/search/?q=".http_build_query(compact('q')))
        ->getBody()
        ->getContents();

    $data = json_decode($response, true);



    return view('welcome', [
        'data' => $data
    ]);
});

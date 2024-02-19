<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/clientes.php';

Route::get('/{vue_capture?}', function () {
    return view('home');
})->where('vue_capture', '[\/\w\.-]*');




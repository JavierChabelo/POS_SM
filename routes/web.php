<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\CompraController;
//use App\Http\Controllers\ProductosController;
//use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController; // Añadir los controladores que necesites

Route::get('/', function () {
    return redirect()->route("home");
});

Route::get("/acerca-de", function () {
    return view("misc.acerca_de");
})->name("acerca_de.index");

Route::get("/soporte", function () {
    return redirect("https://www.facebook.com/javierchabelo.aguirremarquez/");
})->name("soporte.index");

Auth::routes([
    "reset" => false,
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get("/logout", function () {
    Auth::logout();
    return redirect()->route("home");
})->name("logout");

Route::middleware("auth")->group(function () {
    Route::resource("productos", "ProductosController");
    Route::resource('proveedores', 'ProveedorController')->parameters(['proveedores' => 'proveedor' ]);
    Route::resource('compras', 'CompraController');
    Route::resource("categorias", "CategoriaController");
    Route::resource("subcategorias", "SubcategoriaController");
    Route::get('compras/{compra}/detalles', 'CompraController@detalles')->name('compras.detalles');
    Route::resource('detalle_compra', 'DetalleCompraController')->except(['index', 'create', 'store']);
    //Route::get('compras/{compra}/detalles', 'DetalleCompraController@index')->name('detalle_compra.index');
    //Route::get('compras/{compra}/detalles/create', 'DetalleCompraController@create')->name('detalle_compra.create');
    //Route::post('compras/{compra}/detalles', 'DetalleCompraController@store')->name('detalle_compra.store');
    Route::resource("usuarios", "UserController")->parameters(["usuarios" => "user"]);
    //Route::resource("usuarios", UserController::class)->parameters(["usuarios" => "user"]);
    //Route::resource("productos", ProductosController::class);
    //Route::resource("proveedores", ProveedorController::class);
    //Route::resource("compras", CompraController::class);
    
});

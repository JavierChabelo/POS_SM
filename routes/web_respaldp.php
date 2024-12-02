<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return redirect()->route("home");
});
Route::get("/acerca-de", function () {
    return view("misc.acerca_de");
})->name("acerca_de.index");
Route::get("/soporte", function(){
    return redirect("https://www.facebook.com/javierchabelo.aguirremarquez/");
})->name("soporte.index");

Auth::routes([
    "reset" => false,// no pueden olvidar contraseña
]);

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Permitir logout con petición get
//Route::get("/logout", function () {
    //Auth::logout();
    //return redirect()->route("home");
//})->name("logout");
Route::get("/logout", function () {
    Auth::logout();
    return redirect()->route("home");
})->name("logout");


Route::middleware("auth")
    ->group(function () {
        Route::resource("compras", CompraController::class);
        //Route::resource("clientes", "ClientesController");

        Route::resource("usuarios", "UserController")->parameters(["usuarios" => "user"]);

        //Route::resource("productos", "ProductosController");
        Route::resource("productos", ProductosController::class);

        //Route::resource('proveedores', "ProveedorController");
        Route::resource('proveedores', ProveedorController::class);



        //Route::get("/ventas/ticket", "VentasController@ticket")->name("ventas.ticket");
        //Route::resource("ventas", "VentasController");
        //Route::get("/vender", "VenderController@index")->name("vender.index");
        //Route::post("/productoDeVenta", "VenderController@agregarProductoVenta")->name("agregarProductoVenta");
        //Route::delete("/productoDeVenta", "VenderController@quitarProductoDeVenta")->name("quitarProductoDeVenta");
        //Route::post("/terminarOCancelarVenta", "VenderController@terminarOCancelarVenta")->name("terminarOCancelarVenta");
    });

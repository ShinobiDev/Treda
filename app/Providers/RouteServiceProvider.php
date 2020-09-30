<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => ['api', 'cors'],
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
             //Add you routes here, for example:
            Route::post('crearTienda', 'TiendaController@crearTienda');
            Route::put('actualizarTienda', 'TiendaController@actualizarTienda');
            Route::post('showTienda', 'TiendaController@showTienda');
            Route::get('getTiendas', 'TiendaController@getTiendas');
            Route::delete('eliminarTienda', 'TiendaController@eliminarTienda');
            
            Route::post('crearProducto', 'ProductoController@crearProducto');
            Route::put('actualizarProducto', 'ProductoController@actualizarProducto');
            Route::post('mostrarProducto', 'ProductoController@mostrarProducto');
            Route::post('listaProductoTienda', 'ProductoController@listaProductoTienda');
            Route::get('getProductos', 'ProductoController@getProductos');
            Route::delete('eliminarProducto', 'ProductoController@eliminarProducto');
            
            Route::post('multiplos', 'FuncionesController@multiplos');
            Route::post('remplazar', 'FuncionesController@remplazar');
            Route::post('invertirPalabras', 'FuncionesController@invertirPalabras');
        });
    }
}

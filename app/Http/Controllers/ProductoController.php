<?php

namespace App\Http\Controllers;
use App\Producto;
use App\Tienda;
use App\Utilities;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Exception;

class ProductoController extends Controller
{
    public function crearProducto(Request $request)
    {
        try {
            Log::info('Ingreso al metodo crearProducto');
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|unique:productos,nombre',
                'sku' => 'required|string|unique:productos,sku',
                'descripcion' => 'required|string',
                'valor' => 'required|numeric',
                'tiendaId' => 'required|numeric|exists:tiendas,id'
            ]);
            if ($validator->fails()) {
                Log::error('Los datos ingresados son inválidos: ' . $validator->errors());
                return Utilities::sendMessage(
                    Utilities::COD_RESPONSE_ERROR_CREATE,
                    'Los datos enviados son inválidos',
                    true,
                    Utilities::COD_RESPONSE_HTTP_BAD_REQUEST,
                    $validator->errors()
                );
            }
            Log::info('Se validan los datos con exito'. $request);
            $producto = new Producto;
            $producto->nombre = $request->nombre;
            $producto->sku = $request->sku;
            $producto->descripcion = $request->descripcion;
            $producto->valor = $request->valor;
            $producto->imagen = $request->imagen;
            $producto->tienda_id = $request->tiendaId;
            $producto->save();
            
            if($producto->id == null) {
                Log::error('Error al guardar los datos en la BD');
                return "Error al guardar los datos";
            }
            Log::notice('Se almacenaron los datos con exito');
            return Utilities::sendMessage(
                Utilities::COD_RESPONSE_SUCCESS_CREATE,
                'Se han almacenado los datos del producto correctamente',
                false,
                Utilities::COD_RESPONSE_HTTP_OK,
                $producto
            );
        } catch (\Throwable $e) {
            Log::error('Error en el metodo '.$e->getMessage());
            return $datos_return = [
                'ResponseCode' => Utilities::COD_RESPONSE_ERROR_CREATE,
                'ResponseMessage' => $e->getMessage()
            ];
        }
    }

    public function actualizarProducto(Request $request) 
    {
        try {
            Log::info('Ingreso al metodo editarProducto');
            $validator = Validator::make($request->all(), [
                'productoId' => 'required|numeric|exists:productos,id',
                'nombre' => 'required|string|unique:productos,nombre',
                'sku' => 'required|string|unique:productos,sku',
                'descripcion' => 'required|string',
                'valor' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                Log::error('Los datos ingresados son inválidos: ' . $validator->errors());
                return Utilities::sendMessage(
                    Utilities::COD_RESPONSE_ERROR_CREATE,
                    'Los datos enviados son inválidos',
                    true,
                    Utilities::COD_RESPONSE_HTTP_BAD_REQUEST,
                    $validator->errors()
                );
            }
            Log::info('Se validan los datos con exito'. $request);
            return $request;
        } catch (\Throwable $e) {
            Log::error('Error en el metodo '.$e->getMessage());
            return $datos_return = [
                'ResponseCode' => Utilities::COD_RESPONSE_ERROR_SHOW,
                'ResponseMessage' => $e->getMessage()
            ];
        }
    }

    public function mostrarProducto(Request $request)
    {
        try {
            Log::info('Ingreso al metodo mostrarProdcuto');
            $validator = Validator::make($request->all(), [
                'productoId' => 'required|numeric|exists:productos,id'
            ]);
            if ($validator->fails()) {
                Log::error('Los datos ingresados son inválidos: ' . $validator->errors());
                return Utilities::sendMessage(
                    Utilities::COD_RESPONSE_ERROR_CREATE,
                    'Los datos enviados son inválidos',
                    true,
                    Utilities::COD_RESPONSE_HTTP_BAD_REQUEST,
                    $validator->errors()
                );
            }
            Log::info('Se validaron los datos con exito');
            $producto = Producto::with('tienda:id,nombre')->where('id', $request->productoId)->first();
            Log::info('Se halla el producto con el id '.$request->productoId);
            return Utilities::sendMessage(
                Utilities::COD_RESPONSE_SUCCESS,
                'Se obtienen los datos del producto correctamente',
                false,
                Utilities::COD_RESPONSE_HTTP_OK,
                $producto
            );
        } catch (\Throwable $e) {
            Log::error('Error en el metodo '.$e->getMessage());
            return $datos_return = [
                'ResponseCode' => Utilities::COD_RESPONSE_ERROR_SHOW,
                'ResponseMessage' => $e->getMessage()
            ];
        }
    }

    public function listaProductoTienda(Request $request)
    {
        try {
            Log::info('Ingreso al metodo listaProductoTienda');
            $validator = Validator::make($request->all(), [
                'tiendaId' => 'required|numeric|exists:tiendas,id'
            ]);
            if ($validator->fails()) {
                Log::error('Los datos ingresados son inválidos: ' . $validator->errors());
                return Utilities::sendMessage(
                    Utilities::COD_RESPONSE_ERROR_CREATE,
                    'Los datos enviados son inválidos',
                    true,
                    Utilities::COD_RESPONSE_HTTP_BAD_REQUEST,
                    $validator->errors()
                );
            }
            Log::info('Se validaron los datos con exito');
            $productos = Tienda::with('productos')->where('id', $request->tiendaId)->first();
            return $productos;
        } catch (\Throwable $e) {
            Log::error('Error en el metodo '.$e->getMessage());
            return $datos_return = [
                'ResponseCode' => Utilities::COD_RESPONSE_ERROR_SHOW,
                'ResponseMessage' => $e->getMessage()
            ];
        }
    }

    public function eliminarProducto(Request $request)
    {
        try {
            Log::info('Ingreso al metodo eliminarProducto');
            $validator = Validator::make($request->all(), [
                'productoId' => 'required|numeric|exists:productos,id'
            ]);
            if ($validator->fails()) {
                Log::error('Los datos ingresados son inválidos: ' . $validator->errors());
                return Utilities::sendMessage(
                    Utilities::COD_RESPONSE_ERROR_CREATE,
                    'Los datos enviados son inválidos',
                    true,
                    Utilities::COD_RESPONSE_HTTP_BAD_REQUEST,
                    $validator->errors()
                );
            }
            Log::info('Se validaron los datos con exito');
            $producto = Producto::with('tienda:id,nombre')->where('id', $request->productoId)->first();
            $producto->delete();
            Log::notice('Se eliminan los datos del producto de la BD');
            return Utilities::sendMessage(
                Utilities::COD_RESPONSE_SUCCESS,
                'Se eliminan los datos del producto correctamente',
                false,
                Utilities::COD_RESPONSE_HTTP_OK,
                null
            );
        } catch (\Throwable $e) {
            Log::error('Error en el metodo '.$e->getMessage());
            return $datos_return = [
                'ResponseCode' => Utilities::COD_RESPONSE_ERROR_SHOW,
                'ResponseMessage' => $e->getMessage()
            ];
        }
    }
}

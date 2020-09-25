<?php

namespace App\Http\Controllers;
use App\Tienda;
use App\Utilities;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;
use Exception;

class TiendaController extends Controller
{
    /**
     * Creación de tienda
     * Stalin Chacón
     * Metodo para crear las tiendas
     */
    public function crearTienda(Request $request)
    {
        try {
            Log::info('Ingreso al metodo crearTienda');
            
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|unique:tiendas,nombre',
                'fechaApertura' => 'required|date|date_format:d-m-Y'
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

            $fechaApertura   = strtotime($request->fechaApertura);
            $date = date("d-m-Y H:i:s",$fechaApertura);
            
            Log::info('Se le da formato a la fecha '.$date);
            $tienda = new Tienda;
            $tienda->nombre = $request->nombre;
            $tienda->fecha_apertura = $date;
            $tienda->save();
            if($tienda->id == null) {
                Log::info('Error al ingresar los datos en la BD');
                return "Error al ingresar los datos en la BD";
            }
            Log::notice('Los datos se almacenaron con exito'.$tienda);
            return Utilities::sendMessage(
                Utilities::COD_RESPONSE_SUCCESS,
                'Se ha creado la tienda correctamente',
                false,
                Utilities::COD_RESPONSE_HTTP_OK,
                $tienda
            );
        } catch (\Throwable $e) {
            Log::error('Error en el metodo '.$e->getMessage());
            return $datos_return = [
                'ResponseCode' => Utilities::COD_RESPONSE_ERROR_CREATE,
                'ResponseMessage' => $e->getMessage()
            ];
        }
    }
    public function actualizarTienda(Request $request)
    {
        try {
            Log::info('Ingreso al metodo Actualizar Tienda');
            $validator = Validator::make($request->all(), [
                'tiendaId' => 'required|numeric|exists:tiendas,id',
                'nombre' => 'required|string',
                'fechaApertura' => 'required|date|date_format:d-m-Y'
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
            $tienda = Tienda::where('id', $request->tiendaId)->first();
            Log::info('Se halla la tienda con el id '.$request->tiendaId);
            
            Log::info('Se da formato a la fecha');
            $fechaApertura   = strtotime($request->fechaApertura);
            $date = date("d-m-Y H:i:s",$fechaApertura);

            $tienda->nombre = $request->nombre;
            $tienda->fecha_apertura = $date;
            $tienda->update();
            Log::notice('Se actualizaron los datos con exito');
            
            return Utilities::sendMessage(
                Utilities::COD_RESPONSE_SUCCESS,
                'Se han actualizado los datos de la tienda correctamente',
                false,
                Utilities::COD_RESPONSE_HTTP_OK,
                $tienda
            );
        } catch (\Throwable $e) {
            Log::error('Error en el metodo '.$e->getMessage());
            return $datos_return = [
                'ResponseCode' => Utilities::COD_RESPONSE_ERROR_UPDATE,
                'ResponseMessage' => $e->getMessage()
            ];
        }
    }

    public function showTienda(Request $request) 
    {
        try {
            Log::info('Ingreso al metodo showTienda');
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
            $tienda = Tienda::where('id', $request->tiendaId)->first();
            Log::info('Se halla la tienda con el id '.$request->tiendaId);
            return Utilities::sendMessage(
                Utilities::COD_RESPONSE_SUCCESS,
                'Se obtienen los datos de la tienda correctamente',
                false,
                Utilities::COD_RESPONSE_HTTP_OK,
                $tienda
            );
        } catch (\Throwable $e) {
            Log::error('Error en el metodo '.$e->getMessage());
            return $datos_return = [
                'ResponseCode' => Utilities::COD_RESPONSE_ERROR_SHOW,
                'ResponseMessage' => $e->getMessage()
            ];
        }
    }

    public function getTiendas()
    {
        try {
            Log::info('Ingreso al metodo getTiendas');
            $tiendas = Tienda::all();
            return Utilities::sendMessage(
                Utilities::COD_RESPONSE_SUCCESS,
                'Se obtienen los datos de las tiendas correctamente',
                false,
                Utilities::COD_RESPONSE_HTTP_OK,
                $tiendas
            );
        } catch (\Throwable $th) {
            Log::error('Error en el metodo '.$e->getMessage());
            return $datos_return = [
                'ResponseCode' => Utilities::COD_RESPONSE_ERROR_SHOW,
                'ResponseMessage' => $e->getMessage()
            ];
        }
    }

    public function eliminarTienda(Request $request)
    {
        try {
            Log::info('Ingreso al metodo eliminarTienda');
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
            $tienda = Tienda::where('id', $request->tiendaId)->first();
            Log::info('Se halla la tienda con el id '.$request->tiendaId);
            $tienda->delete();
            Log::notice('Se eliminaron los datos con exito');
            return Utilities::sendMessage(
                Utilities::COD_RESPONSE_SUCCESS,
                'Se eliminaron los datos de la tienda correctamente',
                false,
                Utilities::COD_RESPONSE_HTTP_OK,
                null
            );

        } catch (\Throwable $e) {
            return $datos_return = [
                'ResponseCode' => Utilities::COD_RESPONSE_ERROR_SHOW,
                'ResponseMessage' => $e->getMessage()
            ];
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Utilities;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Exception;

class FuncionesController extends Controller
{
    public function multiplos(Request $request)
    {
        try {
            Log::info('Ingerso al metodo multiplos');
            $validator = Validator::make($request->all(), [
                'numero' => 'required|numeric'
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
            Log::info('Se validaron los datos con exito el numero ingresado es '.$request->numero);
            $total = 0;
            for ($i=0; $i < $request->numero; $i++) { 
                Log::info('Numero '.$i);
                if(($i % 3) == 0) {
                    Log::info($i.' es multiplo de 3');
                    $total = $total + $i;
                }
                if(($i % 5) == 0) {
                    Log::info($i.' es multiplo de 5');
                    $total = $total + $i;
                }
            }
            Log::info('La suma de los multiplos es '.$total);
            return Utilities::sendMessage(
                Utilities::COD_RESPONSE_SUCCESS,
                'La suma de los multiplos es ',
                false,
                Utilities::COD_RESPONSE_HTTP_OK,
                $total
            );
            return $total;
        } catch (\Throwable $e) {
            Log::error('Error en el metodo '.$e->getMessage());
            return $datos_return = [
                'ResponseCode' => Utilities::COD_RESPONSE_ERROR_SHOW,
                'ResponseMessage' => $e->getMessage()
            ];
        }
    }

    public function remplazar(Request $request)
    {
        try {
            Log::info('Ingreso a la funcion para remplazar caracteres de un string');
            $validator = Validator::make($request->all(), [
                'frase' => 'required|string'
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
            Log::info('Se validaron los datos con exito '.$request->frase);
            $camel = Str::camel($request->frase);
            Log::info('Se convierte el string a convecion Camel Case');
            Log::info($camel);
            return Utilities::sendMessage(
                Utilities::COD_RESPONSE_SUCCESS,
                'La frase con formato Camel Case ',
                false,
                Utilities::COD_RESPONSE_HTTP_OK,
                $camel
            );
        } catch (\Throwable $e) {
            Log::error('Error en el metodo '.$e->getMessage());
            return $datos_return = [
                'ResponseCode' => Utilities::COD_RESPONSE_ERROR_SHOW,
                'ResponseMessage' => $e->getMessage()
            ];
        }
    }

    public function invertirPalabras(Request $request)
    {
        try {
            Log::info('Ingreso al metodo invertirPalabras');
            $validator = Validator::make($request->all(), [
                'frase' => 'required|string'
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
            Log::info('Se validaron los datos con exito ');
            Log::info('Frase: '.$request->frase);
            Log::info('Se explota el string en palabras y se recorren');
            $nuevaFrase = '';
            foreach (explode(' ',$request->frase) as $key ) {
                Log::info('Palabra: '.$key);
                $size = strlen($key);
                if($size > 5) {
                    $reves = strrev($key);
                    $nuevaFrase = Str::finish($nuevaFrase, $reves.' ');
                }else {
                    $nuevaFrase = Str::finish($nuevaFrase, $key.' ');
                }
            }
            return Utilities::sendMessage(
                Utilities::COD_RESPONSE_SUCCESS,
                'Se invirtieron las palabras con mas de 5 letras ',
                false,
                Utilities::COD_RESPONSE_HTTP_OK,
                $nuevaFrase
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

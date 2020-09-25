<?php

namespace App;

use Exception;
use Illuminate\Support\Facades\Log;

class Utilities
{
    /**
     * ----------------------------------------
     * Códigos de respuesta
     * ----------------------------------------
     */

    //  Códigos de respuesta exitosa
    const COD_RESPONSE_SUCCESS = 0;
    const COD_RESPONSE_SUCCESS_CREATE = 1;

    //Códigos de respuesta errada
    const COD_RESPONSE_ERROR_CREATE = 1001;
    const COD_RESPONSE_ERROR_UPDATE = 1002;
    const COD_RESPONSE_ERROR_DELETE = 1003;
    const COD_RESPONSE_ERROR_LIST = 1004;
    const COD_RESPONSE_ERROR_LOGIN = 1005;
    const COD_RESPONSE_ERROR_UNAUTHORIZED = 1006;
    const COD_RESPONSE_ERROR_UPLOAD = 1007;
    const COD_RESPONSE_ERROR_FLOORS_DATA = 1008;
    const COD_RESPONSE_ERROR_SEND_MAIL = 1009;
    const COD_RESPONSE_ERROR_SHOW = 1010;
    const COD_RESPONSE_ERROR_SEND_PERFORMANCE = 1011;
    const COD_RESPONSE_ERROR_VALIDATE_NAME_COLUMN = 1012;

    //Códigos de respuesta errada SQL
    const COD_RESPONSE_ERROR_CREATE_SQL = 2001;
    const COD_RESPONSE_ERROR_UPDATE_SQL = 2002;
    const COD_RESPONSE_ERROR_DELETE_SQL = 2003;
    const COD_RESPONSE_ERROR_LIST_SQL = 2004;

    //Códigos de respuesta HTTP
    const COD_RESPONSE_HTTP_OK = 200;
    const COD_RESPONSE_HTTP_CREATED = 201;
    const COD_RESPONSE_HTTP_BAD_REQUEST = 400;
    const COD_RESPONSE_HTTP_UNAUTHORIZED = 401;
    const COD_RESPONSE_HTTP_FORBIDDEN = 403;
    const COD_RESPONSE_HTTP_NOT_FOUND = 404;
    const COD_RESPONSE_HTTP_ERROR = 500;

    //Estados del sistema
    const COD_STATUS_ACTIVE = 1;
    const COD_STATUS_INACTIVE = 2;
    const COD_STATUS_DETELE = 3;
    const COD_STATUS_CREATED = 4;
    const COD_STATUS_PENDING_CUSTOM = 5;
    const COD_STATUS_COMPLETED = 6;
    
    /**
     * Función para armar el mensaje a devolver
     */
    public static function sendMessage($cod, $message, $error, $codHttp, $data)
    {
        Log::info('Armando mensaje de envío');
        try {
            if (isset($cod) && isset($message) && isset($error) && isset($codHttp)) {
                Log::info('Llegaron todos los datos');
                $response = [
                    'cod' => $cod,
                    'error' => $error,
                    'message' => $message,
                    'data' => $data
                ];
                return response()->json($response, $codHttp);
            } else {
                Log::warning('No llegaron los datos necesarios para armar el mensaje');
                return response()->json([], 500);
            }
        } catch (Exception $e) {
            Log::warning('Ocurrión un error inesperado armando el mensaje');
            return response()->json([], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use App\Utilities;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try {
            Log::info('********************* A LOGIN *********************');
            $validator = Validator::make($request->all(), [
                'document_number' => 'required|string',
                'password' => 'required|string',
                'rememberMe' => 'boolean',
            ]);
            if ($validator->fails()) {
                Log::info('********************* B LOGIN *********************');
                Log::error('Los datos ingresados son inválidos: ' . $validator->errors());
                return Utilities::sendMessage(
                    Utilities::COD_RESPONSE_ERROR_LOGIN,
                    'Los datos enviados son inválidos',
                    true,
                    Utilities::COD_RESPONSE_HTTP_BAD_REQUEST,
                    $validator->errors()
                );
            }
            Log::info('Pasó la validación de datos');
            $credentials = request(['document_number', 'password']);
            if (!Auth::attempt($credentials)) {
                Log::info('********************* C LOGIN *********************');
                Log::error('El usuario o la contraseña es inválida');
                return Utilities::sendMessage(
                    Utilities::COD_RESPONSE_ERROR_UNAUTHORIZED,
                    'El usuario o la contraseña son inválidos',
                    true,
                    Utilities::COD_RESPONSE_HTTP_UNAUTHORIZED,
                    null
                );
            }
            $user = $request->user();
            //dd($user);
            Log::info('Devolviendo token de inicio de sesión');
            //$tokenResult = $user->createToken('My Token', ['place-orders'])->accessToken;
            $tokenResult = $user->createToken('Personal Access Token');
            return $tokenResult;
            $token = $tokenResult->token;
            if ($request->remember_me) {
                $token->expires_at = Carbon::now()->addWeeks(1);
            }
            $token->save();
            Log::info('Inicio de sesión exitoso');
            $response = [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
                'user' => $user
            ];
            Log::info('Objeto de respuesta creado');
            Log::info('********************* D LOGIN *********************');
            return Utilities::sendMessage(
                Utilities::COD_RESPONSE_SUCCESS,
                'Inicio de sesión exitoso',
                false,
                Utilities::COD_RESPONSE_HTTP_OK,
                $response
            );
        } catch (Exception $e) {
            Log::info('********************* E LOGIN *********************');
            Log::error('Ocurrió un error inesperado haciendo el inicio de sesión: ' . $e->getMessage());
            return Utilities::sendMessage(
                Utilities::COD_RESPONSE_ERROR_LOGIN,
                'Ocurrió un error inesperado haciendo el inicio de sesión',
                true,
                Utilities::COD_RESPONSE_HTTP_ERROR,
                null
            );
        }
    }
}

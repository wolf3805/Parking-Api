<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   /**
     * Handle the incoming request.
     *
     * @param  LoginRequest  $request
     * @return JsonResponse
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        try {
            if (!Auth::attempt($request->validated())) {
                return response()->json([
                    'status' => 'fail',
                    'code'   => 401,
                    'data'   => [
                        'errors' => [
                            'email' => ['Usuario o contraseña incorrectos.'],
                        ],
                    ],
                ], 401);
            }
            
            $user  = $request->user();
            $token = $user->createToken('authERP');
            $data  = [
                'access_token' => $token->plainTextToken,
                'token_type'   => 'Bearer',
                'user'         => new UserResource($user),
            ];
    
            return response()->json([
                'status'  => ResponseStatusEnum::SUCCESS,
                'data'    => $data,
                'code'    => Response::HTTP_OK,
            ], Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'status'  => ResponseStatusEnum::ERROR,
                'code'    => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Ocurrio un error al tratar de iniciar sesión.',
                'data'    => [
                    'error' => $exception->getMessage(),
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        if($checkToken){
            return $next($request);
        }else{
            $data = array(
                'code' => 400,
                'status' => 'error',
                'msg' => 'Error de Autenticación [Middleware]'
            );

            return response()->json($data, $data['code']);
        }
    }
}

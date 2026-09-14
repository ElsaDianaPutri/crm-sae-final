<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class MokaApiKeyMiddleware
{


    public function handle(
        Request $request,
        Closure $next
    )
    {


        $apiKey = $request->header(
            'X-MOKA-KEY'
        );


        if(
            !$apiKey ||
            $apiKey !== env('MOKA_API_KEY')
        )
        {

            return response()->json([

                'message'=>'Unauthorized Moka API'

            ],401);

        }



        return $next($request);

    }


}
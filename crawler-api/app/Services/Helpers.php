<?php

namespace App\Services;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;

class Helpers {

        function Response200($data = null, $message = 'OK') {
            $response = [
                'status' => true,
                'message' => $message,
            ];
    
            if ($data !== null) {
                $response['data'] = $data;
            }
    
            return response()->json($response, 200);
        }

        public static function Response400($exception = null)
        {
            if ($exception) {
                return self::Response($exception, 400);
            }
            return self::Response(['message' => 'bad request'], 400);
        }


        public static function Response($content = '', int $status = 200, array $headers = [])
        {
            $factory = app(ResponseFactory::class);
    
            if (func_num_args() === 0) {
                return $factory;
            }
    
            return $factory->make($content, $status, $headers);
        }
    
    
}
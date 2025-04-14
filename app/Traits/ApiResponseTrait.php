<?php

namespace App\Traits;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Log;
trait ApiResponseTrait {

    public $message = [];
    public function apiResponse($status_code, $key, $value, $meta = '', $message = '')
    {

        $response = [];
        $response['status_code'] = $status_code;
        if (!empty($message)) {
            $response['message'] = $message;
        }
        if ($status_code == 422 && gettype($value) == 'object' && get_class($value) == 'Illuminate\Support\MessageBag') {
            $errors = [];
            foreach ($value->toArray() as $attr => $value_errors) {
                $errors[$attr] = $value_errors[0];
            }
            $response['errors'] = $errors;
            Log::error('--------------------------------------Errors------------------------------------');
            Log::error($errors);
        } else {

            $response[$key] = $value;
        }
        if (!empty($meta)) {
            $response = array_merge($response, $meta);
        }

        return response()->json($response)->setStatusCode($status_code);
    }
    public function sendResponse($result, $message, $statusCode=200)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
            'status'=> $statusCode
        ];


        return response()->json($response, 200);
    }

    public function errorResponse($message,  $statusCode=422, $data=[], $sucess=FALSE)
    {

        $response= [
            'message' => $message,
            'data'    => $data,
            'success' => $sucess,
            'status'=> $statusCode
        ];
        return response()->json($response, 422);

    }
    public function forbiddenResponse($message,  $statusCode=403, $data=[], $sucess=FALSE)
    {

        return [
            'message' => $message,
            'success' => $sucess,
            'status'=> $statusCode
        ];

    }
    public function sendSuccess($message)
    {

        return response()->json([
            'success' => true,
            'message' => $message,
            'status' => 200,
        ], 200);
    }
}

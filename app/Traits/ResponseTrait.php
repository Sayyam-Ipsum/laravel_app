<?php

namespace App\Traits;

trait ResponseTrait
{
    public function formModal($title, $view, array $data = [])
    {
        $result["title"] = $title;
        $result["html"] = view($view, $data)->render();

        return response()->json($result);
    }

    public function jsonResponse(string $type, $message, $data = [], $url='', $code = 200)
    {
        return response()->json([
            'type' => $type,
            'message' => $message,
            'data' => $data,
            'url' => $url
        ], $code);
    }

    public function success($message, $data = [], $code = 200): JsonResponse
    {
        return $this->response(true, $message, $data, $code);
    }

    public function error($message, $data = [], $code = 200): JsonResponse
    {
        return $this->response(false, $message, $data, $code);
    }

    public function response($status, $message, $data, $code): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}

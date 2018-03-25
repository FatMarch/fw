<?php
namespace App\Libs;

class Http
{
    public static function json(int $code, string $msg, array $data = [])
    {
        $result = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        ];

        return response()->json($result);
    }
}
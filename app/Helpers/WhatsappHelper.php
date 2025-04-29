<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class WhatsappHelper
{
    public static function kirimPesan($nomorTujuan, $pesan)
    {
        $instanceId = 'instance116042';
        $token = '8i94t0aah5q3yy3d';
        $url = "https://api.ultramsg.com/$instanceId/messages/chat";

        $response = Http::post($url, [
            'token' => $token,
            'to' => $nomorTujuan,
            'body' => $pesan,
        ]);

        return $response->json();
    }
}
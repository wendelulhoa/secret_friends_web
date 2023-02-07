<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PushNotificationController extends Controller
{   
    private const APP_ID = 'd5246ff5-fe8b-4fa5-ab49-f7e3bb647a0f';
    private const TOKEN  = 'NDYyMTJiMjktYTk5YS00YmNmLTlhZjAtYzJlN2NkZGYxNjEy';

    /**
     * Cria uma nova notificação.
     *
     * @return void
     */ 
    public function createNotification($message, $title, $shopId = null) 
    {
        $content = array(
            "en" => 'Teste enviado',
        );
        
        $fields = array(
            'app_id' => self::APP_ID,
            'include_player_ids' => array("2969d98b-1aee-477a-af8c-bd7e11bdc73a"),
            'channel_for_external_user_ids' => 'push',
            'data' => array("foo" => "bar"),
            'contents' => $content,
            'headings' => ['en' => 'Wendel ulhoa']
        );
        
        $fields = json_encode($fields);
        
        $ch = curl_init();

        /* Envia uma requisição para enviar uma push notification. */ 
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic ' . self::TOKEN));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        curl_close($ch);
    }
}

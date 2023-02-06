<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PushNotificationController extends Controller
{   
    private const APP_ID = 'd5246ff5-fe8b-4fa5-ab49-f7e3bb647a0f';
    private const TOKEN  = 'NDYyMTJiMjktYTk5YS00YmNmLTlhZjAtYzJlN2NkZGYxNjEy';

    // Your code here!
    protected static function sendMessage()
    {
        $content = array(
            "en" => 'English Message',
            "pt-BR" => 'Aqui'
            );
        
        $fields = array(
            'app_id' => self::APP_ID,
            'include_player_ids' => array("640503c0-b001-4c0b-9dd0-2207b96c9464"),
            'channel_for_external_user_ids' => 'push',
            'data' => array("foo" => "bar"),
            'contents' => $content
        );
        
        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic ' . self::TOKEN));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }

    public function createNotification() 
    {
        return self::sendMessage();
    }
}

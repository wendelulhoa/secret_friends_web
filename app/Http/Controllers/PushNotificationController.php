<?php

namespace App\Http\Controllers;

use App\Models\UsersNotification;
use Exception;
use Illuminate\Http\JsonResponse;
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
    public static function createNotification($title, $message, $shopId = null) 
    {
        $fields = array(
            'app_id' => self::APP_ID,
            'include_external_user_ids' => array("2969d98b-1aee-477a-af8c-bd7e11bdc73a"),
            'channel_for_external_user_ids' => 'push',
            'data' => array("foo" => "bar"),
            'contents' => ["en" => $title ],
            'headings' => ['en' => $message]
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

    /**
     * Undocumented function
     *
     * @param Request $request
     * 
     * @return JsonResponse
     */
    public function createUser(Request $request): JsonResponse
    {
        try {
            $data = $request->all();

            if(!UsersNotification::where(['user_token' => $data['userToken']])->exists()) {
                UsersNotification::create([
                    'company_id'        => $data['companyId'],
                    'user_token'        => $data['userToken'],
                    'authorized_stores' => json_encode([])
                ]);
            }

            self::createNotification('Nova oferta', 'Oferta 10/02', $shopId = null);

            return response()->json(['sucess' => true], 200);
        } catch (Exception $e){
            return response()->json(['error' => true], 500);
        }
    }
}

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
    public static function createNotification($title, $message, $companyId = null, $shopId = null) 
    {
        /* Notifica somente os users vinculados a essa empresa. */ 
        if(!is_null($companyId)) {
            $usersNotification = UsersNotification::getUsersPerCompany($companyId, $shopId);

            self::sendNotificationPerUser($title, $message, $usersNotification);
        }
        /* Caso não tenha loja irá para todos os users. */  
        else {
            self::sendNotificationAllUsers($title, $message);
        }
    }

    /**
     * Envia notificação para todos os usuários.
     *
     * @param string      $title
     * @param string      $message
     * @param string|null $companyId
     * 
     * @return void
     */
    protected static function sendNotificationAllUsers($title, $message): void
    {
        $fields = array(
            'app_id' => self::APP_ID,
            'included_segments' => ['Subscribed Users'],
            'data'        => ["foo" => "bar"],
            'contents'    => ["en" => $message],
            'headings'    => ['en' => $title]
        );
        
        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . self::TOKEN
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $response = curl_exec($ch);
        curl_close($ch);
    }

    /**
     * Notifica somente os usuários específicos.
     *
     * @param string      $title
     * @param string      $message
     * @param string|null $companyId
     * 
     * @return void
     */
    protected static function sendNotificationPerUser(string $title, string $message, array $dataUsers): void
    {
        $fields = array(
            'app_id'                        => self::APP_ID,
            'channel_for_external_user_ids' => 'push',
            'include_player_ids'            => $dataUsers,
            'data'                          => array("foo" => "bar"),
            'contents'                      => ["en" => $message],
            'headings'                      => ['en' => $title]
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
        $response = curl_exec($ch);
        curl_close($ch);
    }

    /**
     * Cria um novo usuário para notificações.
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

            self::createNotification('Nova oferta', 'Ofertas imperdíveis wendel ulhoa');

            return response()->json(['sucess' => true], 200);
        } catch (Exception $e){
            return response()->json(['error' => true], 500);
        }
    }
}

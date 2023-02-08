<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersNotification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'user_token',
        'authorized_stores'
    ];

    /* Tabela. */ 
    public $table = "usersnotification";

    /**
     * Busca os usuários por empresa para que possa notificar.
     *
     * @param integer $companyId
     * @param integer|null $shopId
     * 
     * @return array
     */ 
    public static function getUsersPerCompany(int $companyId, int $shopId = null): array
    {   
        /* Busca os usuários por essa empresa. */ 
        $users       = self::where(['company_id' => $companyId])->get();
        $usersTokens = [];

        /* Pega os tokens, dos usuários. */ 
        foreach($users as $user) {
            $usersTokens[] = $user->user_token;
        }

        return $usersTokens;
    }
}

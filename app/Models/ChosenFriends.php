<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ChosenFriends extends Model
{
    use HasFactory;
    public $table = "chosenfriends";
    protected $fillable = [
        'user_id_selected',
        'user_id',
        'group_id'
    ];

    /**
     * Pega todos os user selecionados
     *
     * @return array | null
     */
    public static function getAllChosenFriends(int $userId = 0): array | null
    {
        $chosenFriends = self::where('user_id', '!=', $userId)->get();

        $auxFriends = [];

        foreach ($chosenFriends as $friend) {
            $auxFriends[$friend->user_id_selected] = $friend;
        }

        return $auxFriends;
    }

    public static function getChosenFriend($userId)
    {
        $chosenFriend = self::where(['chosenfriends.user_id' => $userId])
            ->join('users', 'users.id', '=', 'chosenfriends.user_id_selected')
            ->join('suggestions', 'suggestions.user_id', '=', 'users.id')
            ->select('users.name', 'suggestions.*')
            ->first();

        $categories         = Categories::all();
        $categoriesSelected = json_decode($chosenFriend['categories'] ?? '[]');
        $auxCount = 0;

        if(!empty($chosenFriend['categories']))$chosenFriend['categories'] = "";

        foreach($categories as $category) {
            if(in_array($category['id'], $categoriesSelected)) {
                $auxCount++;
                $nameShop = $category->name ?? '';
                $separate = $auxCount != count($categoriesSelected) && count($categoriesSelected) > 1 ? ', ' : '';
    
                /* Adiciona as lojas vinculadas. */
                $chosenFriend['categories'] .= $nameShop . $separate;
            }
        }

        return $chosenFriend;
    }
}

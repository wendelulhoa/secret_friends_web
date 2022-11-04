<?php

namespace App\Http\Controllers;

use App\Models\ChosenFriends;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;

class SecretFriendController extends Controller
{
    public function index()
    {
        /* Busca os amigos selecionados. */
        $chosenFriend = ChosenFriends::getChosenFriend(Auth::user()->id);

        $type = 'Amigo secreto';

        return view('secret-friends.index', ['chosenFriend' => $chosenFriend, 'type' => $type]);
    }

    public function viewSortFriends()
    {
        $type = 'Sorteio';

        return view('secret-friends.sort-friends', ['type' => $type]);
    }

    public function sortAllFriends()
    {
        $users = User::get()->toArray();
        $ids   = [];

        /* Pega os ids. */
        foreach ($users as $user) {
            $ids[] = $user['id'];
        }

        /* Deleta todos os amigos já escolhidos ao refazer o sorteio. */
        ChosenFriends::where('id', '!=', '0')->delete();

        /* Faz o sorteio de todos os participantes. */
        self::sortFriends($ids);
        self::sendEmail($users);

        return redirect(route('secretfriend-index'));
    }

    private static function sortFriends($a)
    {
        $b = $a;
        $c = array();
        $i = 0;

        shuffle($a);

        while ($i < count($a)) {
            if ($a[$i] == $b[$i]) {
                $i = 0;
                shuffle($a);
            } else
                $i++;
        }

        foreach ($b as $k => $v) {
            $c[] = array($v, $a[$k]);

            /* Salva os amigos escolhidos. */
            ChosenFriends::create([
                'user_id_selected' => $a[$k],
                'user_id'          => $v,
                'group_id'         => 1
            ]);
        }

        /* Mensagem de sucesso. */
        session()->flash('successMsg', 'Gerado com sucesso.');

        return $c;
    }

    public static function sendEmail($users)
    {
        foreach($users as $user) {
            /* Busca os amigos selecionados. */
            $chosenFriend = ChosenFriends::getChosenFriend($user['id']);
            
            // Dorme por 10 segundos
            sleep(2);

            /* Envia */ 
            Mail::send('secret-friends.email', ['chosenFriend' => $chosenFriend, 'user' => $user], function($mail) use($user) {
                $mail->subject('Sorteio amigo secreto');
                $mail->from('sorteio@familiabuscape.ml', 'Amigo secreto');
                $mail->to($user['email']);
            });

            // Dorme por 10 segundos
            sleep(2);
        }
    }

    public function exportPdf()
    {
        /* Busca os amigos selecionados. */
        $chosenFriend = ChosenFriends::getChosenFriend(Auth::user()->id);

        $pdf = PDF::loadView('user.pdf', ['chosenFriend' => $chosenFriend])->setPaper('a4', 'retrait');
        return $pdf->download('sort_friend.pdf');
    }
}

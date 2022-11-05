<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\ChosenFriends;
use App\Models\Suggestions;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users         = User::all();
        $chosenFriends = ChosenFriends::getAllChosenFriends();
        $type = 'Participantes';

        return view('home.index', ['users' => $users, 'chosenFriends' => $chosenFriends, 'type' => $type]);
    }

    public function register()
    {
        $categories = Categories::all();

        return view('user.register', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            DB::beginTransaction();

            /* Cria o novo user. */
            $userId = User::create([
                'name' => $data['name'],
                'email' => $data['username'],
                'password' => Hash::make($data['password']),
            ])->id;

            Suggestions::create([
                'user_id'     => $userId,
                'categories'  => json_encode($data['categories'] ?? []),
                'links'       => json_encode($data['links'] ?? []),
                'observation' => $data['observation'] ?? '',
                'group_id'    => 1
            ]);

            DB::commit();

            /* Mensagem de sucesso. */
            session()->flash('successMsg', 'Salvo com sucesso.');

            return redirect(route('home'));
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            /* Mensagem de sucesso. */
            session()->flash('warningMsg', 'Ops! esse usuário já existe.');
            
            return redirect(route('register'));
        }
    }
}

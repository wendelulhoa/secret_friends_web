<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\ChosenFriends;
use App\Models\Suggestions;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('home.index', ['users' => []]);
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
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'sendemail' => $data['sendemail'] == 'Y' ? true : false
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

    public function edit()
    {
        $user = Auth::user();
        $suggestions = Suggestions::where(['user_id' => $user->id, 'group_id' => 1])->first();
        $categories = Categories::all();
        $categoriesSelected = json_decode($suggestions['categories'] ?? '[]');

        return view('user.edit', ['user' => $user, 'suggestions' => $suggestions, 'categories' => $categories, 'categoriesSelected' => $categoriesSelected]);
    }

    public function update(Request $request)
    {
        try {
            $data = $request->all();
            DB::beginTransaction();

            $user = User::find(Auth::user()->id);

            if(!empty($user)) {
                /* Atualiza o user. */
                $user->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'sendemail' => $data['sendemail'] == 'Y' ? true : false
                ]);

                /* Atualiza a senha. */ 
                if(isset($data['password'])) {
                    $user->update([
                        'password' => Hash::make($data['password']),
                    ]);
                }

                Suggestions::where(['user_id' => $user->id])->update([
                    'categories'  => json_encode($data['categories'] ?? []),
                    'links'       => json_encode($data['links'] ?? []),
                    'observation' => $data['observation'] ?? '',
                    'group_id'    => 1
                ]);
    
                DB::commit();
    
                /* Mensagem de sucesso. */
                session()->flash('successMsg', 'Salvo com sucesso.');
    
                return redirect(route('user-edit'));
            } else {
                /* Mensagem de sucesso. */
                session()->flash('warningMsg', 'Ops! ocorreu um erro.');

                return redirect(route('home'));
            }
        } catch (Exception $e) {
            DB::rollBack();

            /* Mensagem de sucesso. */
            session()->flash('warningMsg', 'Ops! ocorreu um erro.');

            return redirect(route('register'));
        }
    }
}

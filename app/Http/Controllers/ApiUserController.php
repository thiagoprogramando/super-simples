<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiUserController extends Controller
{
    public function listUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function addUsers(Request $request)
    {
        $user = new User;
        $user->name = $request->input('nome');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->cnpj = $request->input('cnpj');
        $user->tipo = $request->input('tipo');
        $user->id_token = $request->input('id_token');
        $user->save();
        return response()->json($user);
    }

    public function upUsers(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('nome');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->cnpj = $request->input('cnpj');
        $user->tipo = $request->input('tipo');
        $user->id_token = $request->input('id_token');
        $user->save();
        return response()->json($user);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json('Usuário deletado com sucesso');
    }
}

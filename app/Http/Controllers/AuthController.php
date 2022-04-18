<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credenciais = $request->all(['email', 'password']);
        //Autenticação (email e senha)
        $token = auth('api')->attempt($credenciais);

        if ($token) { //usuário autenticado com sucesso
            return response()->json(['token' => $token]);
        } else { //erro de usuário ou senha
            return response(['erro' => 'Usuário ou senha inválido!'], 403);

            //401 = Unauthorizad -> não autorizado
            //403 = forbidden -> proibido (login inválido)
        }

        //retornar um Jason Web Token (JWT)
        return 'login';
    }

    public function logout() {
        auth('api')->logout();

        return response()->json(['msg' => 'O logout foi realizado com sucesso']);
    }

    public function refresh() {
        $token = auth('api')->refresh(); //client encaminhe um jwt válido
        return response()->json(['token' => $token]);
    }

    public function me() {
        return response()->json(auth()->user());
    }
}

<?php

namespace App\Http\Controllers;

use App\Actas;
use App\Clientes;
use App\Empresas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $user = User::findOrfail(Auth::user()->id);

        $existsEmpresa = Auth::user()->empresaExist(Auth::user()->id);

        if (!$existsEmpresa) {
            return view('dashboard', ['actas' => [], 'clientes' => [], 'users' => [], 'empresaExist' => false]);
        } else {
            if ($user->rol == 3) {
                $actas    = Actas::where('id_user', $user->id)->get();
                $clientes = Clientes::where('id_user', $user->id)->get();
                $users    = [];
            } else {
                $empresasE = Auth::user()->empresaExist(Auth::user()->id);

                if (!$empresasE) {
                    $empresa = Empresas::where('id_user', Auth::user()->id)->first();
                } else {
                    $empresa = Empresas::where('id', $empresasE->id)->first();
                }

                $actas = Actas::where('id_empresa', $empresa->id)->get();

                $clientes = Clientes::where('id_empresa', $empresa->id)->get();

                if (!$user->id_user_sucursal && !$user->id_user) {
                    $users = User::where('id_user_admin', $user->id)->get();
                } else {
                    $users = User::where('id_user_admin', $user->id_user_admin)->get();
                }

            }
        }

        return view('dashboard', ['actas' => $actas, 'clientes' => $clientes, 'users' => $users, 'empresaExist' => true]);
    }

    public function login(Request $request)
    {
        /*----------- LOGIN MANUAL , MODIFICABLE ----------*/
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->intended('dashboard');
        } else {
            return redirect()->route('login')->withErrors('¡Error! , Revise sus credenciales');
        }
    }

    public function logout()
    {
        /*---- funcion de salir/logout/cerrar sesion --*/
        Auth::logout();
        return view('login');
    }

}

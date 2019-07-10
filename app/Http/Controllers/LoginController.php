<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Actas;
use App\Empresas;
use App\Clientes;

class LoginController extends Controller
{
    public function index()
    {
         $user = User::findOrfail(Auth::user()->id);
         
        if ($user->rol == 3) {
          $actas = Actas::where('id_user', $user->id)->get();
          $clientes = [];
          $users = [];
        }else{ 
            $empresa  = Auth::user()->empresaExist(Auth::user()->id);
        
            if (!$empresa) {
                $empresa = Empresas::where('id_user',Auth::user()->id)->first();
            }

            $actas = Actas::where('id_empresa',$empresa->id)->get();

            $clientes = Clientes::where('id_empresa',$empresa->id)->get();

             if (!$user->id_user_sucursal && !$user->id_user) {
                 $users = User::where('id_user_admin', $user->id)->get();
              }else{
                 $users = User::where('id_user_admin', $user->id_user_admin)->get();
              }

              //dd($users);
        }
         

 			return view('dashboard',['actas' => $actas,'clientes' => $clientes,'users' => $users]);
	}

	 public function login(Request $request)
	 {
	 		/*----------- LOGIN MANUAL , MODIFICABLE ----------*/
    	$this->validate($request, [
    		'email' =>'required|email',
    		'password' => 'required',
    	]);

      if (Auth::attempt($request->only(['email','password']))){
      	return redirect()->intended('dashboard');
      }else{
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

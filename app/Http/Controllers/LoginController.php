<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Actas;

class LoginController extends Controller
{
    public function index()
    {

    	 $actas = Actas::where('id_user',Auth::user()->id)->get();

       $user = User::findOrfail(Auth::user()->id);

       //dd($user->users_belong->empresa); // empresa de un usuario registrado por el admind e la empresa 2do nivel

       //dd($user->belong_sucursal->users_belong->empresa); // empresa de una sucursal, el que registra el usuario que registro el admin, el tercer nivel



 			return view('dashboard',['actas' => $actas]);
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

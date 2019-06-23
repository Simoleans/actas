<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Actas;

class LoginController extends Controller
{
    public function index()
    {

    	 $actas = Actas::where('id_user',Auth::user()->id)->get();

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

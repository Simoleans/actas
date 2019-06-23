<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ResetPassword;
use App\User;
use App\Reset;

class ResetController extends Controller
{
    public function index()
    {
    	return view('reset.email');
    }

    public function reset(Request $request)
    {

        $user = User::where('email',$request->email)->exists();
        if (!$user) {
            return view('reset.email')->withErrors('Este correo no existe');
        }

        $user_save = new Reset;
        $user_save->fill($request->all());

        if ($user_save->save()) {
            
                 \Mail::to($request->email)
                   ->send(new ResetPassword($request->token));
           
                 return redirect("/")->withErrors('Revise su correo '.$request->email);
        }
    }

    public function change($token)
    {
        $tokenExist = Reset::where('token',$token)->where('status',1)->exists();
        if ($tokenExist) {
            return view('reset.newpassword',['token' => $token,'status'=>false]);
        }else{
            return view('reset.newpassword',['token' => $token,'status'=>true]);
        }
        
    }

    public function reset_password(Request $request)
    {
        

         $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $query = Reset::where('email',$request->email)->where('token',$request->token)->where('status',0)->first();

        if ($query) {
            $user = User::where('email',$request->email)->first();
            $user->password = bcrypt($request->password);

            if ($user->save()) {
                 $reset = Reset::where('email',$request->email)->where('token',$request->token)->first();
                 $reset->status = 1;

                 if ($reset->save()) {
                    \Auth::login($user);
                     return redirect("dashboard")->with([
                      'flash_message' => 'Se ha modificado su contraseña',
                      'flash_class' => 'alert-success',
                       'flash_important' => true
                      ]);
                 }
            }  
        }else{
            return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => 'Este no es tu correo electronico']);
        }

        //->withInput($request->only('email'))
                    //->withErrors(['email' => trans($response)]);
    }
}

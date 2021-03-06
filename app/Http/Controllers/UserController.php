<?php

namespace App\Http\Controllers;

use App\Empresas;
use App\Http\Controllers\Controller;
use App\Mail\Users;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $online = User::findOrfail(Auth::user()->id);

        //dd($online->id_user_admin);

        //$users = User::where('id_user', $online->user_id)->where('id_user_admin','!=' , $online->id_user_admin)->orWhere('id_user_sucursal', $online->id_user_sucursal)->get();

        if (!$online->id_user_sucursal && !$online->id_user) {
           $users = User::where('id_user_admin', $online->id)->get();
        }else{
           $users = User::where('id_user_admin', $online->id_user_admin)->get();
        }

       

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'rut_user' => 'required|unique:users',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);


         $user = new User;
        $user->fill($request->all());
        $user->password = bcrypt($request->input('password'));

        if ($request->rol == 3) {
            $user->id_user_sucursal = Auth::user()->id;
        }else{
            $user->id_user = Auth::user()->id;
        }


        if ($user->save()) {
            return redirect("users")->with([
                'flash_message' => 'Usuario agregado correctamente.',
                'flash_class'   => 'alert-success',
            ]);
        } else {
            return redirect("users")->with([
                'flash_message'   => 'Ha ocurrido un error.',
                'flash_class'     => 'alert-danger',
                'flash_important' => true,
            ]);
        }
    }

    public function register(Request $request)
    {
        {
            $this->validate($request, [
                'rut_user' => 'required|unique:users',
                'email'    => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
            ]);

            $user = new User;
            $user->fill($request->all());
            $user->password = bcrypt($request->input('password'));

            if ($user->save()) {
                return redirect("/")->with([
                    'flash_message' => 'Usuario agregado correctamente.',
                    'flash_class'   => 'alert-success',
                ]);
            } else {
                return redirect("/")->with([
                    'flash_message'   => 'Ha ocurrido un error.',
                    'flash_class'     => 'alert-danger',
                    'flash_important' => true,
                ]);
            }
        }
    }

    public function invitar($token, $id)
    {
        //dd($id);
        return view('empresas.invitacion', ['id' => $id]);
    }

    public function store_invitacion(Request $request)
    {
        $this->validate($request, [
            'rut_user' => 'required|unique:users',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = new User;
        $user->fill($request->all());
        $user->password = bcrypt($request->input('password'));

        if ($user->save()) {
            $user    = User::orderBy('created_at', 'desc')->first();
            $empresa = Empresas::findOrfail($request->id_empresa);
            //dd($empresa->toArray());
            $empresa_save = new Empresas;
            $empresa_save->fill($empresa->toArray());
            $empresa_save->logo    = $empresa->logo;
            $empresa_save->id_user = $user->id;

            if ($empresa_save->save()) {
                return redirect("/")->with([
                    'flash_message' => 'Usuario agregado correctamente.',
                    'flash_class'   => 'alert-success',
                ]);
            } else {
                return redirect("/")->with([
                    'flash_message'   => 'Ha ocurrido un error.',
                    'flash_class'     => 'alert-danger',
                    'flash_important' => true,
                ]);
            }
        }
    }

    public function sendEmail(Request $request)
    {
        $url = route('users.invitar', ['id' => $request->id, 'token' => str_random(60)]);

        $empresa = Empresas::findOrfail($request->id);
        \Mail::to($request->email)
            ->send(new Users($url, $empresa));

        return redirect("empresas")->with([
            'flash_message' => 'Correo enviado correctamente.',
            'flash_class'   => 'alert-success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = user::findOrFail($id);
        return view("users.view", ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = user::findOrFail($id);
        return view("users.edit", ["user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
        ]);

        $user->fill($request->all());

        if ($user->save()) {
            return redirect("users")->with([
                'flash_message' => 'Usuario agregado correctamente.',
                'flash_class'   => 'alert-success',
            ]);
        } else {
            return redirect("users")->with([
                'flash_message'   => 'Ha ocurrido un error.',
                'flash_class'     => 'alert-danger',
                'flash_important' => true,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            return redirect('users')->with([
                'flash_class'   => 'alert-success',
                'flash_message' => 'Usuario eliminado con exito.',
            ]);
        } else {
            return redirect('users')->with([
                'flash_class'     => 'alert-danger',
                'flash_message'   => 'Ha ocurrido un error.',
                'flash_important' => true,
            ]);
        }
    }

    public function perfil()
    {
        $user = Auth::user();
        return view('users.perfil', ['perfil' => $user]);
    }

    public function update_perfil(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
        ]);

        $user->fill($request->all());

        if ($request->input('checkbox') === "Yes") {
            $this->validate($request, [
                'password' => 'required|min:6|confirmed',
            ]);
            $user->password = bcrypt($request->input('password'));
        }

        if ($user->save()) {
            return redirect('perfil')->with([
                'flash_message' => 'Cambios guardados correctamente.',
                'flash_class'   => 'alert-success',
            ]);
        } else {
            return redirect('perfil')->with([
                'flash_message'   => 'Ha ocurrido un error.',
                'flash_class'     => 'alert-danger',
                'flash_important' => true,
            ]);
        }
    }
}

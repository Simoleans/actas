<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\ClientesEmpresas;
use App\Empresas;
use App\Clientes;

class ClientesEmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa  = Auth::user()->empresaExist(Auth::user()->id);
        
        if (!$empresa) {
            $empresa = Empresas::where('id_user',Auth::user()->id)->first();
        }


        $empresa = ClientesEmpresas::where('id_empresa', $empresa->id)->get();

        //dd($empresa);

        return view('clientes_empresas.index',['empresas' => $empresa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa  = Auth::user()->empresaExist(Auth::user()->id);
        
        if (!$empresa) {
            $empresa = Empresas::where('id_user',Auth::user()->id)->first();
        }

        $clientes = Clientes::where('id_empresa',$empresa->id)->get();

        //$planes = Planes::where('id_empresa', $empresa->id)->get();



        return view('clientes_empresas.create',['clientes' => $clientes]);
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
             'rut' => 'required|unique:clientes_empresa',
             'logo' => 'image|mimes:jpeg,png,jpg,svg|max:12048',
        ]);

        $empresa  = Auth::user()->empresaExist(Auth::user()->id);
        
        if (!$empresa) {
            $empresa = Empresas::where('id_user',Auth::user()->id)->first();
        }
        
            if(input::hasFile('logo')){
            $file = Input::file('logo');
            $file->move(public_path().'/img/empresas/', 'Cli'.date("YmdHi").$file->getClientOriginalName());
            $nombre = 'Cli'.date("YmdHi").$file->getClientOriginalName();
              }else{
                $nombre = 'no-foto.jpg';
              }

            $empresaCliente = new ClientesEmpresas;
            $empresaCliente->fill($request->all());
            $empresaCliente->logo = $nombre;
            $empresaCliente->id_empresa = $empresa->id;

            if($empresaCliente->save()){
                return redirect("clientese")->with([
                  'flash_message' => 'Empresa agregada correctamente.',
                  'flash_class' => 'alert-success'
                  ]);
              }else{
                return redirect("clientese")->with([
                  'flash_message' => 'Ha ocurrido un error.',
                  'flash_class' => 'alert-danger',
                  'flash_important' => true
                  ]);
              }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresaExists  = Auth::user()->empresaExist(Auth::user()->id);
        $empresa = ClientesEmpresas::findOrfail($id);
        
        if (!$empresaExists) {
            $empresaExists = Empresas::where('id_user',Auth::user()->id)->first();
        }

        $clientes = Clientes::where('id_empresa',$empresaExists->id)->get();



        //$planes = Planes::where('id_empresa', $empresaExists->id)->get();



        return view('clientes_empresas.edit',['clientes' => $clientes,'empresa' => $empresa]);
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
        $this->validate($request, [
            'logo' => 'image|mimes:jpeg,png,jpg,svg|max:12048',
        ]);

        $empresa = ClientesEmpresas::findOrfail($id);

        //dd(Input::hasFile('logo'));
        if (Input::hasFile('logo')) {

           $file = Input::file('logo');
           $file->move(public_path().'/img/empresas/','Cli'.date("YmdHi").$file->getClientOriginalName());
           $nombre = 'Cli'.date("YmdHi").$file->getClientOriginalName();
           $empresa->fill($request->all());
           $empresa->logo = $nombre;
             if($empresa->save()){
                return redirect("clientese")->with([
                  'flash_message' => 'Empresa modificada correctamente.',
                  'flash_class' => 'alert-success'
                  ]);
              }else{
                return redirect("clientese")->with([
                  'flash_message' => 'Ha ocurrido un error.',
                  'flash_class' => 'alert-danger',
                  'flash_important' => true
                  ]);
              }
         }else{
            $empresa->fill($request->all());
             if($empresa->save()){
                return redirect("clientese")->with([
                  'flash_message' => 'Empresa modificada correctamente.',
                  'flash_class' => 'alert-success'
                  ]);
              }else{
                return redirect("clientese")->with([
                  'flash_message' => 'Ha ocurrido un error.',
                  'flash_class' => 'alert-danger',
                  'flash_important' => true
                  ]);
              }
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
        //
    }
}

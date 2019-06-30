<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Clientes;
use App\Planes;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $clientes= Auth::user()->empresa->clientes;
      //dd($clientes);
        return view('clientes.index',['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $empresa_id = Auth::user()->empresa->id;

        $planes = Planes::where('id_empresa',$empresa_id)->get();
         return view('clientes.create',['planes' => $planes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
          $rut = Clientes::where('rut',$request->rut)->exists();

          if ($rut) {
              return response()->json(['msg' => 'Ya existe esta persona','status' => false]);
          }

          $clientes = new Clientes;
          $clientes->fill($request->all());

              if($clientes->save()){
                return response()->json(['msg' => '¡Registrado Correctamente!','status' => true,'id' => $clientes->id]);
              }else{
               return response()->json(['msg' => '¡Error!','status' => false]);
              }

      }
        $this->validate($request, [
            'rut' => 'required|unique:clientes',
          ]);

      $clientes = new Clientes;
      $clientes->fill($request->all());

      


      if($clientes->save()){
        return redirect("clientes")->with([
          'flash_message' => 'Proveedor agregado correctamente.',
          'flash_class' => 'alert-success'
          ]);
      }else{
        return redirect("clientes")->with([
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
        $cliente = Clientes::findOrfail($id);

        $empresa_id = Auth::user()->empresa->id;

        $planes = Planes::where('id_empresa',$empresa_id)->get();

        return view('clientes.edit',['planes' => $planes,'cliente' => $cliente]);
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
        $cliente = Clientes::findOrFail($id);

        $cliente->fill($request->all());

        if($cliente->save()){
          return redirect("clientes")->with([
            'flash_message' => 'Cliente agregado correctamente.',
            'flash_class' => 'alert-success'
            ]);
        }else{
          return redirect("clientes")->with([
            'flash_message' => 'Ha ocurrido un error.',
            'flash_class' => 'alert-danger',
            'flash_important' => true
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
        //
    }

    public function update_status(Request $request)
    {
        $cliente = Clientes::where('rut',$request->rut)->first();

        $cliente->status = 1;

        if ($cliente->save()) {

            return response()->json(['status' => true]);
        }else{
            return response()->json(['status' => true]);
        }
    }
}

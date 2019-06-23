<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Empresas;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Empresas::where('id_user', Auth::user()->id)->get();

        return view('empresas.index',['empresas' => $empresa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

         $this->validate($request, [
             'rut' => 'required|unique:empresas',
             'logo' => 'image|mimes:jpeg,png,jpg,svg|max:12048',
        ]);

        

            if(input::hasFile('logo')){
            $file = Input::file('logo');
            $file->move(public_path().'/img/empresas/', date("YmdHi").$file->getClientOriginalName());
            $nombre = date("YmdHi").$file->getClientOriginalName();
              }else{
                $nombre = 'no-foto.jpg';
              }

            $empresa = new Empresas;
            $empresa->fill($request->all());
            $empresa->logo = $nombre;
            $empresa->id_user = Auth::user()->id;

            if($empresa->save()){
                return redirect("empresas")->with([
                  'flash_message' => 'Empresa agregada correctamente.',
                  'flash_class' => 'alert-success'
                  ]);
              }else{
                return redirect("empresas")->with([
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
        $empresa = Empresas::findOrfail($id);

        return view('empresas.view',['empresa' => $empresa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = Empresas::findOrfail($id);

        return view('empresas.edit',['empresa' => $empresa]);
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
            'logo' => 'image|mimes:jpeg,png,jpg,svg|max:8048',
        ]);

        $empresa = Empresas::findOrfail($id);



        if (Input::hasFile('logo')) {

           $file = Input::file('logo');
           $file->move(public_path().'/img/empresas/',date("YmdHi").$file->getClientOriginalName());
           $nombre = date("YmdHi").$file->getClientOriginalName();
           $empresa->fill($request->all());
           $empresa->logo = $nombre;
             if($empresa->save()){
                return redirect("empresas")->with([
                  'flash_message' => 'Empresa modificada correctamente.',
                  'flash_class' => 'alert-success'
                  ]);
              }else{
                return redirect("empresas")->with([
                  'flash_message' => 'Ha ocurrido un error.',
                  'flash_class' => 'alert-danger',
                  'flash_important' => true
                  ]);
              }
         }else{
            $empresa->fill($request->all());
             if($empresa->save()){
                return redirect("empresas")->with([
                  'flash_message' => 'Empresa modificada correctamente.',
                  'flash_class' => 'alert-success'
                  ]);
              }else{
                return redirect("empresas")->with([
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

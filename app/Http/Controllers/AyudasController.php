<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ayudas;

class AyudasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ayudas = Ayudas::all();

        return view('ayudas.index',['ayudas' => $ayudas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ayudas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ayuda = new Ayudas;
        $ayuda->fill($request->all());

        if($ayuda->save()){
            return redirect("ayudas")->with([
              'flash_message' => 'Ayuda agregada correctamente.',
              'flash_class' => 'alert-success'
              ]);
          }else{
            return redirect("ayudas")->with([
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
        $ayuda = Ayudas::findOrfail($id);

        return view('ayudas.show',['ayuda' => $ayuda]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ayuda = Ayudas::findOrfail($id);

        return view('ayudas.edit',['ayuda' => $ayuda]);
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
        $ayuda = Ayudas::findOrfail($id);

        $ayuda->fill($request->all());

        if($ayuda->save()){
            return redirect("ayudas")->with([
              'flash_message' => 'Ayuda modificada correctamente.',
              'flash_class' => 'alert-success'
              ]);
          }else{
            return redirect("ayudas")->with([
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
       $ayuda = Ayudas::findOrFail($id);

        if($ayuda->delete()){
            return redirect('ayudas')->with([
                'flash_class'   => 'alert-success',
                'flash_message' => 'Ayuda eliminada con exito.'
            ]);
        }else{
            return redirect('ayudas')->with([
                'flash_class'     => 'alert-danger',
                'flash_message'   => 'Ha ocurrido un error.',
                'flash_important' => true
            ]);
        }
    }

    public function viwers()
    {

        $ayudas = Ayudas::all();

        return view('ayudas.viwers',['faq' => $ayudas]);
    }
}

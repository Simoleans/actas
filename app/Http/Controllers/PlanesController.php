<?php

namespace App\Http\Controllers;

use App\Empresas;
use App\Planes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Auth::user()->empresaExist(Auth::user()->id);

        if (!$empresa) {
            $empresa = Empresas::where('id_user', Auth::user()->id)->first();
        }

        $planes = Planes::where('id_empresa', $empresa->id)->get();

        return view('planes.index', ['planes' => $planes]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresaExists = Auth::user()->exitsEmp(Auth::user()->id);

        //dd($empresaExists);

        if ($empresaExists) {
            $empresa = Empresas::where('id_user', Auth::user()->id)->first();
            //$actas = Actas::where('id_empresa', $empresa->id)->get();
        } else {
            $empresa = Auth::user()->empresaExist(Auth::user()->id);
        }

        //dd($empresa);
        return view('planes.create', ['empresa' => $empresa]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $plan = new Planes;
        $plan->fill($request->all());

        if ($plan->save()) {
            return redirect("planes")->with([
                'flash_message' => 'Plan agregado correctamente.',
                'flash_class'   => 'alert-success',
            ]);
        } else {
            return redirect("planes")->with([
                'flash_message'   => 'Ha ocurrido un error.',
                'flash_class'     => 'alert-danger',
                'flash_important' => true,
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
        $plan = Planes::findOrfail($id);

        $empresa = Auth::user()->empresaExist(Auth::user()->id);

        if (!$empresa) {
            $empresa = Empresas::where('id_user', Auth::user()->id)->first();
        }

        return view('planes.edit', ['plan' => $plan, 'empresa' => $empresa]);

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
        $plan->fill($request->all());

        if ($empresa->save()) {
            return redirect("planes")->with([
                'flash_message' => 'Plan modificado correctamente.',
                'flash_class'   => 'alert-success',
            ]);
        } else {
            return redirect("planes")->with([
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
        //
    }
}

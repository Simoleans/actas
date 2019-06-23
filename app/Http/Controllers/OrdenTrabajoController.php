<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Proveedor;
use App\Empresas;
use App\OrdenTrabajo;
use App\Participantes;
use App\DetalleOTrabajo;
use App\Mail\OrdenT;
use PDF;

class OrdenTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenes = OrdenTrabajo::where('id_user',Auth::user()->id)->get();

        //dd($ordenes);
        return view('ordenT.index',['ordenest'=>$ordenes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa = Auth::user()->empresa;

        return view('ordenT.create',['empresa' => $empresa]);
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

         

            $lastId = OrdenTrabajo::latest()->first();

                //dd($lastId);

                if (!$lastId) {
                    $codigo = (str_pad((int)1, 4, '0', STR_PAD_LEFT));
                }else{
                    $codigo = (str_pad((int)$lastId->id + 1, 4, '0', STR_PAD_LEFT));
                }

            $name = 'ot'.md5(date("dmYhisA")).'.png';
            $nombre = public_path().'/img/firmas/ordent/'.$name;
 

            $ordenT = new OrdenTrabajo;
            $ordenT->cod_seguimiento = 'OT'.$codigo;
            $ordenT->id_user = $request->id_user;
            $ordenT->id_empresa = $request->id_empresa;
            $ordenT->fecha_inicio = $request->fecha_inicio;
            $ordenT->fecha_fin = $request->fecha_fin;
            $ordenT->firma = $name;

            if ($ordenT->save()) {

                file_put_contents($nombre,base64_decode($request->firma));

                //for participantes
            for ($i=0; $i < count($request->nombre_part); $i++)
             { 
           
                $participante = new Participantes;
                $participante->codigo_acta = 'OT'.$codigo;
                $participante->nombre = $request->nombre_part[$i];
                $participante->apellido = $request->apellido[$i];
                $participante->cargo = $request->cargo[$i];
                $participante->email = $request->email[$i];
                $participante->save();
             }//fin for

                 for ($i=0; $i < count($request->nombre); $i++) { 
           
                    $DetalleOTrabajo = new DetalleOTrabajo;
                    $DetalleOTrabajo->cod_seguimiento = 'OT'.$codigo;
                    $DetalleOTrabajo->nombre = $request->nombre[$i];
                    $DetalleOTrabajo->cantidad = $request->cantidad[$i];
                    $DetalleOTrabajo->save();

                 }//fin for
                  return response()->json(['msg'=>'Se registro correctamente']);
            }//fin if de orden save

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $orden = OrdenTrabajo::findOrfail($id);

        $detalles = DetalleOTrabajo::where('cod_seguimiento',$orden->cod_seguimiento)->get();

        $participantes = Participantes::where('codigo_acta',$orden->cod_seguimiento)->whereNotNull('firma')->get();

      // dd($participantes);

        return view('ordenT.view',['orden' => $orden,'detalles' => $detalles,'participantes' => $participantes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function pdf($id)
    {
        $orden = OrdenTrabajo::findOrfail($id);

        $detalles = DetalleOTrabajo::where('cod_seguimiento',$orden->cod_seguimiento)->get();

        $participantes = Participantes::where('codigo_acta',$orden->cod_seguimiento)->get();

        //dd($participantes);

        $pdf = PDF::loadView('ordenT.pdf',['orden'=>$orden,'detalles'=>$detalles,'participantes' => $participantes]);
            
            return $pdf->download($orden->cod_seguimiento.'.pdf');
    }

    public function sendEmail($id_orden,$id)
    {
        $url = route('ordentrabajo.firma',[$id]);

        $email = Participantes::findOrfail($id);

        $orden = OrdenTrabajo::findOrfail($id_orden);
         \Mail::to($email->email)
                 ->send(new OrdenT($url,$orden));

         return back()->with([
          'flash_message' => 'Invitacion enviada correctamente.',
          'flash_class' => 'alert-success'
          ]);
    }

    public function firma($id)
    {
        //$acta = Actas::findOrfail($id);

        $participante = Participantes::findOrfail($id);

        $orden = OrdenTrabajo::where('cod_seguimiento',$participante->codigo_acta)->first();

        $detalles = DetalleOTrabajo::where('cod_seguimiento',$participante->codigo_acta)->get();

        return view('ordenT.firma',['orden' => $orden,'participante' => $participante,'detalles' => $detalles,'id' => $id]);
    }

     public function firmaSend(Request $request)
    {

         $name = 'ot'.md5(date("dmYhisA")).'.png';
         $nombre = public_path().'/img/firmas/ordent/'.$name;

         $orden = Participantes::findOrfail($request->id_orden);

         $orden->firma = $name;

        if ($orden->save()) {
             file_put_contents($nombre,base64_decode($request->firma));

             return response()->json(['msg' => 'Se ha registrado correctamente']);
        }
    }


}

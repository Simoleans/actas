<?php

namespace App\Http\Controllers;

use App\Acciones;
use App\Actas;
use App\Clientes;
use App\Fotos;
use App\Mail\ActasMail;
use App\Observacion;
use App\Participantes;
use App\Planes;
use App\Empresas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use PDF;

class ActasController extends Controller
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
        
         $actas = Actas::where('id_empresa', $empresa->id)->get();

        return view('actas.index', ['actas' => $actas]);
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

        $planes = Planes::where('id_empresa', $empresa->id)->get();
        

        return view('actas.create2', ['empresa' => $empresa, 'clientes' => $clientes, 'planes' => $planes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $lastId = Actas::latest()->first();

        //dd($lastId);

        if (!$lastId) {
            $codigo = (str_pad((int) 1, 4, '0', STR_PAD_LEFT));
        } else {
            $codigo = (str_pad((int) $lastId->id + 1, 4, '0', STR_PAD_LEFT));
        }

        //dd($codigo);

        $acta             = new Actas;
        $acta->codigo     = 'AC' . $codigo;
        $acta->id_user    = Auth::user()->id;
        $acta->id_empresa = $request->id_empresa;
        //$acta->observaciones = $request->observaciones;
        $acta->status = 1;

        if ($acta->save()) {
            if (input::hasFile('foto')) {
                $file = Input::file('foto');

                foreach ($file as $gImg) {
                    $filename = date("YmdHi") . $gImg->getClientOriginalName();
                    $patch    = public_path() . "/img/actas/fotos/";
                    $gImg->move($patch, $filename);
                    $name[] = $filename;
                }
 

                for ($i = 0; $i < count($name); $i++) {
                    // for para guardar todas las fotos
                    //echo $name[$i];
                    $foto              = new Fotos;
                    $foto->codigo_acta = 'AC' . $codigo;
                    $foto->foto        = $name[$i];
                    $foto->save();
                    //return response()->json(['status' => true , 'msg'=>'Se ha registrado esta scort con exito']);

                }
            }

            for ($i = 0; $i < count($request->nombre); $i++) {

                $cliente = new Participantes;
                //$cliente->codigo_acta = 'AC'.$codigo;
                $cliente->id_acta    = $acta->id;
                $cliente->id_cliente = $request->id[$i];
                $cliente->save();

            } //fin for

            for ($i = 0; $i < count($request->observaciones); $i++) {

                $observaciones              = new Observacion;
                $observaciones->codigo_acta = 'AC' . $codigo;
                $observaciones->observacion = $request->observaciones[$i];
                $observaciones->save();
            } //fin for

            //for acciones
            for ($i = 0; $i < count($request->accion); $i++) {

                $acciones              = new Acciones;
                $acciones->codigo_acta = 'AC' . $codigo;
                $acciones->accion      = $request->accion[$i];
                $acciones->save();
            } //fin for

            return response()->json(['msg' => 'Se registro correctamente','type' => 'success', 'url' => route('actas.show', ['acta' => $acta->id])]);
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
        $acta = Actas::findOrfail($id);

        //dd($acta->participantes);
        return view('actas.view', ['acta' => $acta]);
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
        $acta = Actas::findOrfail($id);

        $detalles = Acciones::where('codigo_acta', $acta->codigo)->get();

        $participantes = Participantes::where('id_acta', $acta->id)->get();

        //dd($participantes);

        $pdf = PDF::loadView('pdf.pdfActa', ['orden' => $acta, 'detalles' => $detalles, 'participantes' => $participantes]);

        return $pdf->stream($acta->codigo . '.pdf');
    }

    public function firma($id, $acta_id)
    {
        //$acta = Actas::findOrfail($id);

        $participante = Participantes::findOrfail($id);

        $acta = Actas::where('id', $acta_id)->first();

        $acta_firma = Participantes::where('id', $id)->where('id_acta', $acta->id)->whereNull('firma')->exists();

        //dd($acta_firma);

        return view('actas.firma', ['acta' => $acta, 'participante' => $participante, 'firma' => $acta_firma]);
    }

    public function signature($id, $acta_id)
    {
        $participante = Participantes::findOrfail($id);

        $acta = Actas::where('id', $acta_id)->first();

        $acta_firma = Participantes::where('id_cliente', $id)->where('id_acta',$acta_id)->whereNull('firma')->exists();

        //dd($acta_firma);

        return view('actas.signature', ['acta' => $acta, 'participante' => $participante, 'firma' => $acta_firma]);
    }

    public function firmaSend(Request $request)
    {

        $name   = 'ac' . md5(date("dmYhisA")) . '.png';
        $nombre = public_path() . '/img/actas/' . $name;
        //dd($request->all());

        $participante = Participantes::where('id', $request->id_participante)->where('id_acta', $request->id_acta)->first();
       // dd($participante);
        $participante->firma = $name;

        if ($participante->save()) {
            file_put_contents($nombre, base64_decode($request->firma));

            return response()->json(['msg' => 'Se ha registrado correctamente', 'url' => route('actas.firma', ['id' => $participante->id_acta, 'acta_id' => $participante->id_acta])]);
        }
    }

    public function invitacion(Request $request)
    {
        //dd($request->all());

        $cliente = Clientes::findOrfail($request->id);
        //dd($cliente->email);

        \Mail::to($cliente->email)
            ->send(new ActasMail($request->id, $request->acta,$request->id_acta));

        if (\Mail::failures()) {
            return response()->json(['msg' => 'No se ha enviado el correo :(', 'status' => false], 422);
        }

        return response()->json(['msg' => 'Se envio el correo correctamente', 'status' => true], 200);
    }
}

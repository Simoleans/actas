<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Proveedor;
use App\Empresas;
use App\Participantes;
use App\Acciones;
use App\Mail\ActasMail;
use App\Actas;
use App\Fotos;
use App\Observacion;
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
        $actas = Actas::where('id_user',Auth::user()->id)->get();
        //dd($actas);

        return view('actas.index',['actas' => $actas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa = Auth::user()->empresa;
        $clientes = $empresa->clientes;
        return view('actas.create2',['empresa' => $empresa,'clientes' => $clientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //dd(Input::file('foto'));

        //$codigo=rand(11111, 99999);

        $lastId = Actas::latest()->first();

        //dd($lastId);

        if (!$lastId) {
            $codigo = (str_pad((int)1, 4, '0', STR_PAD_LEFT));
        }else{
            $codigo = (str_pad((int)$lastId->id + 1, 4, '0', STR_PAD_LEFT));
        }

        //dd($codigo);

       

        

        $acta = new Actas;
        $acta->codigo = 'AC'.$codigo;
        $acta->id_user = Auth::user()->id;
        $acta->id_empresa = $request->id_empresa;
        //$acta->observaciones = $request->observaciones;
        $acta->status = 1;
        
        
        if ($acta->save()) {
        if(input::hasFile('foto'))
        {
             $file = Input::file('foto');

                 foreach ( $file as $gImg ) {
                        $filename = $gImg->getClientOriginalName();
                        $patch = public_path()."/img/actas/fotos/";
                        $gImg->move($patch,date("YmdHi").$filename);
                        // \Image::make($gImg)->save($patch. $filename );
                        // \Image::make($gImg)->resize(300, null, function ($constraint) {
                        //                     $constraint->aspectRatio();
                        //                 })->save($patch.'thumb_'.$filename );
                        $name[] = $filename;   
                    }
                   // return response()->json($name);
                    //$ultimo_id = Scort::orderBy('id', 'DESC')->first();//agarra el ultimo id
                   // return response()->json($ultimo_id->id);
                 //$scort->fotos = implode(',', $name);

                    for ($i=0; $i < count($name) ; $i++) { // for para guardar todas las fotos
                        //echo $name[$i];
                        $foto = new Fotos;
                        $foto->codigo_acta = 'AC'.$codigo;
                        $foto->foto = $name[$i];
                        $foto->save();
                            //return response()->json(['status' => true , 'msg'=>'Se ha registrado esta scort con exito']);
                        
                    }
        }

            
            for ($i=0; $i < count($request->nombre); $i++)
             { 
           
                $participante = new Participantes;
                $participante->codigo_acta = 'AC'.$codigo;
                $participante->nombre = $request->nombre[$i];
                $participante->apellido = $request->apellido[$i];
                $participante->cargo = $request->cargo[$i];
                $participante->email = $request->email[$i];
                $participante->save();
             }//fin for

             for ($i=0; $i < count($request->observaciones); $i++)
             { 
           
                $observaciones = new Observacion;
                $observaciones->codigo_acta = 'AC'.$codigo;
                $observaciones->observacion = $request->observaciones[$i];
                $observaciones->save();
             }//fin for

             //for acciones
             for ($i=0; $i < count($request->accion); $i++)
             { 
           
                $acciones = new Acciones;
                $acciones->codigo_acta = 'AC'.$codigo;
                $acciones->accion = $request->accion[$i];
                $acciones->save();
             }//fin for


             return response()->json(['msg'=>'Se registro correctamente','url' => route('actas.show',['acta' => $acta->id])]);
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

        return view('actas.view',['acta' => $acta]);
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
        $orden = Actas::findOrfail($id);

        $detalles = Acciones::where('codigo_acta',$orden->codigo)->get();

        $participantes = Participantes::where('codigo_acta',$orden->codigo)->get();

        //dd($participantes);

        $pdf = PDF::loadView('pdf.pdfActa',['orden'=>$orden,'detalles'=>$detalles,'participantes' => $participantes]);
            
            return $pdf->stream($orden->codigo.'.pdf');
    }

    public function firma($id)
    {
        //$acta = Actas::findOrfail($id);

        $participante = Participantes::findOrfail($id);

        $acta = Actas::where('codigo',$participante->codigo_acta)->first();

        return view('actas.firma',['acta' => $acta,'participante' => $participante]);
    }

    public function firmaSend(Request $request)
    {

         $name = 'ac'.md5(date("dmYhisA")).'.png';
         $nombre = public_path().'/img/actas/'.$name;

         $participante = Participantes::findOrfail($request->id_participante);

         $participante->firma = $name;

        if ($participante->save()) {
             file_put_contents($nombre,base64_decode($request->firma));

             return response()->json(['msg' => 'Se ha registrado correctamente']);
        }
    }

    public function invitacion(Request $request)
    {
        //dd($request->all());

        $participantes = Participantes::findOrfail($request->id);

       \Mail::to($participantes->email)
                 ->send(new ActasMail($request->id,$request->acta));

                

        if (\Mail::failures()) {
             return response()->json(['msg' => 'No se ha enviado el correo :(', 'status' => false], 422);
        }

          return response()->json(['msg' => 'Se envio el correo correctamente', 'status' => true], 200);
    }
}

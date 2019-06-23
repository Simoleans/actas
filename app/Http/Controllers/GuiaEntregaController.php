<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\ProductosCompras;
use App\GuiaEntrega;
use App\Mail\GuiaE;
use App\Empresas;
use PDF;

class GuiaEntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guia = GuiaEntrega::where('id_user',Auth::user()->id)->get();
        //dd($actas);

        return view('guiaE.index',['guia' => $guia]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $empresa = Empresas::where('id_user',Auth::user()->id)->first();

         //$empresa_despachos = EmpresaDespacho::all();

        return view('guiaE.create',['empresa' => $empresa]);
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

            $codigo=rand(11111, 99999);
            // $file = Input::file('logo');
            // $file->move(public_path().'/img/empresas/', date("YmdHi").$file->getClientOriginalName());
            $name = 'ge'.md5(date("dmYhisA")).'.png';
            $nombre = public_path().'/img/firmas/guiae/'.$name;

            $guia = new GuiaEntrega;
            $guia->cod_seguimiento = 'GE'.$codigo;
            $guia->id_user = Auth::user()->id;
            $guia->id_empresa = $request->id_empresa;
            $guia->recibe = strtoupper($request->recibe);
            $guia->observaciones = $request->observaciones;
            $guia->firma = $name;

            if ($guia->save()) {

                file_put_contents($nombre,base64_decode($request->firma));

                 for ($i=0; $i < count($request->producto); $i++) { 
           
                    $productos = new ProductosCompras;;
                    $productos->cod_seguimiento = 'GE'.$codigo;
                    $productos->tipo_modelo = $request->tipo_modelo[$i];
                    $productos->producto = $request->producto[$i];
                    $productos->precio_unt = $request->precio_unt[$i];
                    $productos->cantidad = $request->cantidad[$i];
                    $productos->precio_total  = $request->cantidad[$i] * $request->precio_unt[$i];
                    $productos->save();

                 }//fin for
                  return response()->json(['msg'=>'Se registro correctamente']);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GuiaEntrega  $guiaEntrega
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $guia = GuiaEntrega::findOrfail($id);

         $productos = ProductosCompras::where('cod_seguimiento',$guia->cod_seguimiento)->get();

         return view('guiaE.view',['guia' => $guia,'productos' => $productos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GuiaEntrega  $guiaEntrega
     * @return \Illuminate\Http\Response
     */
    public function edit(GuiaEntrega $guiaEntrega)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GuiaEntrega  $guiaEntrega
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GuiaEntrega $guiaEntrega)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GuiaEntrega  $guiaEntrega
     * @return \Illuminate\Http\Response
     */
    public function destroy(GuiaEntrega $guiaEntrega)
    {
        //
    }

    public function pdf($id)
    {
         $guia = GuiaEntrega::findOrfail($id);

         $productos = ProductosCompras::where('cod_seguimiento',$guia->cod_seguimiento)->get();

        //dd($productos);

          $pdf = PDF::loadView('guiaE.pdf',['guia'=>$guia,'productos'=>$productos]);
            
            return $pdf->download($guia->cod_seguimiento.'.pdf');
    }

    public function sendEmail(Request $request)
    {
        $url = route('guiaentrega.firma',[$request->id]);

        $guia = GuiaEntrega::findOrfail($request->id);
         \Mail::to($request->email)
                 ->send(new GuiaE($url,$guia));

         return redirect("guiaentrega")->with([
          'flash_message' => 'Correo enviado correctamente.',
          'flash_class' => 'alert-success'
          ]);
    }
    public function firma($id)
    {
        $guia = GuiaEntrega::findOrfail($id);

        $productos = ProductosCompras::where('cod_seguimiento',$guia->cod_seguimiento)->get();

        //dd($productos);

        return view('guiaE.firma',['guia' => $guia,'productos' => $productos]);
    }

     public function firmaSend(Request $request)
    {

         $name = 'gd'.md5(date("dmYhisA")).'.png';
         $nombre = public_path().'/img/firmas/guiae/'.$name;

         $guia = GuiaEntrega::findOrfail($request->id_guia);

         $guia->firma_receptor = $name;
         $guia->status = 1;

        if ($guia->save()) {
             file_put_contents($nombre,base64_decode($request->firma));

             return response()->json(['msg' => 'Se ha registrado correctamente']);
        }
    }
}

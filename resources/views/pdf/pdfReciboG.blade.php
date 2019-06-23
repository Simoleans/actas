@extends('layouts.appPdf')

@section('content')

  <div class="row">
      <div class="col-md-6">
        <img class="" src="{{asset('img/empresas'.'/'.$recibo->empresa->logo)}}" height="170" width="190">
      </div>
    </div>

      <h4 class="text-center">Recibo De Gasto <strong>{{$recibo->cod_seguimiento}}</strong></h4>

      <div class="row">
        <div class="col-md-12">
          <h4 class="text-left">Datos de  la Empresa</h4>
          <table class="table table-bordered table-condensed">
            <tr>
              <td class="text-center" height="4" style="background-color: #A4A4A4; color:#000000">Razón Social</td>
              <td class="text-center" height="4">{{strtoupper($recibo->empresa->r_social)}}</td>
              <td class="text-center" height="4" style="background-color: #A4A4A4; color:#000000">Ciudad</td>
              <td class="text-center" height="4">{{strtoupper($recibo->empresa->ciudad)}}</td>
            </tr>
             <tr>
              <td class="text-center" height="4" style="background-color: #A4A4A4; color:#000000">Contacto</td>
              <td class="text-center" height="4">{{strtoupper($recibo->empresa->contacto)}}</td>
              <td class="text-center" height="4" style="background-color: #A4A4A4; color:#000000">RUT</td>
              <td class="text-center" height="4">{{strtoupper($recibo->empresa->rut)}}</td>
            </tr>
             <tr>
              <td class="text-center" height="4" style="background-color: #A4A4A4; color:#000000">Dirección</td>
              <td class="text-center" height="4">{{strtoupper($recibo->empresa->direccion)}}</td>
              <td class="text-center" height="4" style="background-color: #A4A4A4; color:#000000">Teléfono</td>
              <td class="text-center" height="4">{{strtoupper($recibo->empresa->telefono)}}</td>
            </tr>
          </table>
        </div>
      <br>
        <div class="col-md-12">
          <h4 class="text-left">Detalles del recibo</h4>
          <p><b>Concepto: </b>{{strtoupper($detalle->concepto)}}</p>
          <p><b>Cantidad:</b> {{number_format($detalle->cantidad)}}</p>
          <p><b>Cuenta:</b> {{$detalle->cuenta}}</p>
          <p><b>Tipo De Pago:</b> {{strtoupper($detalle->transferencia_efectivo)}}</p>
          <p><b>Adicional:</b> {{strtoupper($detalle->adicional?$detalle->adicional:'N/T')}}</p>
          <p><b>Observaciones:</b> {{strtoupper($detalle->observaciones?$detalle->observaciones:'N/T')}}</p>
        </div>
      </div> {{-- fin row --}}
      <br>
      <br>
      <br>
      <div class="row">
          <div class="col-xs-6">
            <div align="center">
              <img src="{{asset('img/firmas/recibog'.'/'.$recibo->firma)}}"><br>
              <small>Responsable: {{strtoupper(Auth::user()->nombre)}}</small>
            </div>
          </div>
           <div class="col-xs-6">
            <div align="center">
               @if(!$recibo->status)
                  <h3>Sin Confirmar</h3>
                  <small>{{strtoupper($recibo->recibe)}}</small>
               @else
                  <img src="{{asset('img/firmas/recibog'.'/'.$recibo->firma_receptor)}}"><br>
                  <small>Confirmacion De {{strtoupper($recibo->recibe)}}</small>
               @endif
            </div>
          </div>
        </div>
  
@endsection

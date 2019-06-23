@extends('layouts.appPdf')

@section('content')

   <div class="row">
      <div class="col-md-6">
        <img class="" src="{{asset('img/empresas'.'/'.$orden->empresa->logo)}}" height="170" width="190">
      </div>
    </div>

      <h4 class="text-center">Acta De Asistencia <strong>{{$orden->codigo}}</strong></h4>

      <div class="row">
        <div class="col-md-12">
          <h4 class="text-left">Datos de  la Empresa</h4>
          <table class="table table-bordered table-condensed">
            <tr>
              <td class="text-center" height="4" style="background-color: #A4A4A4; color:#000000">Razón Social</td>
              <td class="text-center" height="4">{{strtoupper($orden->empresa->r_social)}}</td>
              <td class="text-center" height="4" style="background-color: #A4A4A4; color:#000000">Ciudad</td>
              <td class="text-center" height="4">{{strtoupper($orden->empresa->ciudad)}}</td>
            </tr>
             <tr>
              <td class="text-center" height="4" style="background-color: #A4A4A4; color:#000000">Contacto</td>
              <td class="text-center" height="4">{{strtoupper($orden->empresa->contacto)}}</td>
              <td class="text-center" height="4" style="background-color: #A4A4A4; color:#000000">RUT</td>
              <td class="text-center" height="4">{{strtoupper($orden->empresa->rut)}}</td>
            </tr>
             <tr>
              <td class="text-center" height="4" style="background-color: #A4A4A4; color:#000000">Dirección</td>
              <td class="text-center" height="4">{{strtoupper($orden->empresa->direccion)}}</td>
              <td class="text-center" height="4" style="background-color: #A4A4A4; color:#000000">Teléfono</td>
              <td class="text-center" height="4">{{strtoupper($orden->empresa->telefono)}}</td>
            </tr>
          </table>
        </div>

        <div class="col-md-12">
          <p><b>Responsable:</b> {{$orden->user->nombre}}</p>
          <p><b>Fecha:</b> {{$orden->created_at->format('Y-m-d')}}</p>
          <p><b>Observciones: </b>{{$orden->observaciones}}</p>
        </div>
        <div class="col-md-12">
          <h4 class="text-left">Acciones</h4>
          <table class="table table-bordered table-condensed" border="1">
            <tr>
              <td class="text-center" height="2" width="100" style="background-color: #A4A4A4; color:#000000">#</td>
              <td class="text-center" height="2" width="100"  style="background-color: #A4A4A4; color:#000000">Nombre</td>
            </tr>
            @foreach($detalles as $p)
               <tr>
                <td class="text-center" height="2" width="100">{{$loop->index+1}}</td>
                <td class="text-center" height="2" width="100" >{{strtoupper($p->accion)}}</td>
              </tr>
            @endforeach
            
          </table>
        </div>
         <div class="col-md-10">
          <h4 class="text-left">Participantes</h4>
          <table class="table table-bordered table-condensed" border="1">
            <tr>
              <td class="text-center" height="2" width="100" style="background-color: #A4A4A4; color:#000000">#</td>
              <td class="text-center" height="2" width="100"  style="background-color: #A4A4A4; color:#000000">Nombre</td>
              <td class="text-center" height="2" width="100"  style="background-color: #A4A4A4; color:#000000">Apellido</td>
              <td class="text-center" height="2" width="100"  style="background-color: #A4A4A4; color:#000000">Cargo</td>
              <td class="text-center" height="2" width="100"  style="background-color: #A4A4A4; color:#000000">Firma</td>

            </tr>
            @foreach($participantes as $p)
               <tr>
                <td class="text-center" height="2" width="100">{{$loop->index+1}}</td>
                <td class="text-center" height="2" width="100" >{{strtoupper($p->nombre)}}</td>
                <td class="text-center" height="2" width="100" >{{strtoupper($p->apellido)}}</td>
                <td class="text-center" height="2" width="100" >{{strtoupper($p->cargo)}}</td>
                <td class="text-center" height="60" width="100" >
                  @if(!$p->firma)
                    <h4>Sin Autorización</h4>
                  @else
                    <img src="{{asset('img/actas'.'/'.$p->firma)}}" height="60" width="90">
                  @endif
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div> {{-- fin row --}}

@endsection

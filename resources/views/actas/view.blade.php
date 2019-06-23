@extends('layouts.app')
@section('title','Acta - '.config('app.name'))
@section('header','Acta')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> Acta {{$acta->codigo}} </li>
	  <li class="active">Ver </li>
	</ol>
@endsection
@section('content')
	<section>
    <a class="btn btn-flat btn-default" href="{{ route('actas.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
    <a class="btn btn-danger btn-flat" href="{{ route('actas.pdf',[$acta->id])}}"><i class="fa fa-print"></i></a>
    {{-- <a class="btn btn-flat btn-success" href="{{ route('actas.edit',[$acta->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a> --}}
    <!-- <button class="btn btn-flat btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button> -->
	</section>

	<section class="perfil">
		<div class="row">
    	<div class="col-md-12">
    		<h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-user" aria-hidden="true"></i>
          {{ 'Acta '.$acta->codigo }}
          <small class="pull-right">Registrado: {{ $acta->created_at }}</small>
          <span class="clearfix"></span>
        </h2>
    	</div>
			<div class="col-md-5">
				<h4>Detalles de la empresa</h4>
				<p><b>Usuario: </b> {{$acta->user->nombre}} </p>
        <p><b>Empresa: </b> {{strtoupper($acta->empresa->r_social)}}</p>
        <p><b>Ciudad: </b> {{strtoupper($acta->empresa->ciudad)}}</p>
        <p><b>RUT: </b> {{strtoupper($acta->empresa->rut)}}</p>
        <p><b>Contacto: </b> {{strtoupper($acta->empresa->contacto)}}</p>
        <p><b>Telefono: </b> {{strtoupper($acta->empresa->telefono)}}</p>
        <p><b>Direccion: </b> {{strtoupper($acta->empresa->direccion)}}</p>
        
			</div>

      <div class="col-md-4"> 
        <p>&nbsp;</p>
        <p><b>Observaciones: </b> {{$acta->observaciones?$acta->observaciones:'N/T'}} </p>
      </div>

      <div class="col-md-2"> 
        <p>&nbsp;</p>
        <p><b>Logo</b></p>
        <img src="{{asset('img/empresas/'.$acta->empresa->logo)}}" class="img-responsive">
      </div>
		</div>

    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-users" aria-hidden="true"></i>
          Participantes
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-12">
       <table class="table data-table table-condensed table-hover table-bordered nowrap" style="width:100%">
         <thead>
           <tr>
            <th class="text-center">Nombre</th>
            <th class="text-center">Apellido</th>
            <th class="text-center">Cargo</th>
            <th class="text-center">Invitar</th>
            <th class="text-center">URL</th>
            <th class="text-center hidden-lg">Compartir</th>
          </tr>
         </thead>
         <tbody>
          @foreach($acta->participantes($acta->codigo) as $p)
           <tr>
             <td class="text-center">{{$p->nombre}}</td>
             <td class="text-center">{{$p->apellido}}</td>
             <td class="text-center">{{$p->cargo}}</td>
             <td class="text-center">
                @if($p->firma == NULL)
                 <a  data-id="{{$p->id}}" class="btn btn-flat btn-success btn_invitar">Invitar</a>
                @else
                 <h3 class="text-center">Autorizado</h3>
                @endif
             </td>
             <td>
               @if($p->firma == NULL)
                 <center><a  href="{{route('actas.firma',['id' => $p->id])}}" class="btn btn-flat btn-success btn-sm">Firmar</a></center>
                @else
                 <h3 class="text-center">¡Ya Firmo!</h3>
                @endif
               
             </td>
             <td class="hidden-lg">
               <button type="button"  class="btn btn-sm btn-warning shareButton"><i class="fa fa-share-alt-square" aria-hidden="true"></i></button>
             </td>
           </tr>
          @endforeach
         </tbody>
       </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-list" aria-hidden="true"></i>
          Acciones
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-12">
       <table class="table table-condensed table-hover table-bordered">
         <thead>
           <tr>
            <th class="text-center">#</th>
            <th class="text-center">Accion</th>
          </tr>
         </thead>
         <tbody>
          @foreach($acta->acciones($acta->codigo) as $a)
           <tr>
             <td>{{$loop->index+1}}</td>
             <td class="text-center">{{$a->accion}}</td>
           </tr>
          @endforeach
         </tbody>
       </table>
      </div>
    </div>
	</section>

	<div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="delModalLabel">Eliminar Acta</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <form class="col-md-8 col-md-offset-2" action="{{ route('actas.destroy',[$acta->id])}}" method="POST">
              {{ method_field( 'DELETE' ) }}
              {{ csrf_field() }}
              <h4 class="text-center">¿Esta seguro de eliminar esta acta?</h4><br>

              <center>
                <button class="btn btn-flat btn-danger" type="submit">Eliminar</button>
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cerrar</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')

<script type="text/javascript">
  $(document).ready(function() {
    
    $(".data-table").on('click','.shareButton', function () { 

      /* Mostramos la opcion nativa de compartir si se navega desde Android */
      if (navigator.userAgent.match(/Android/i)) {
        /* Use the Web Share API from Chrome 61+ */
        navigator.share({title: 'Example Page', url: 'https://viktormorales.com'}).then(console.log('Share successful'));
      }
      /* Caso contrario mostramos mensaje de alerta */
      else { alert('Para activar la opcion nativa de compartir debes utilizar Chrome en Android') }
    });// fin click deshabilitar
     /* Recuperamos el boton */
    shareButton = document.getElementById("shareButton");
    /* Capturamos el evento CLICK */
    
    $(".btn_invitar").click(function(event) {
      event.preventDefault();

      var id = $(this).data('id');

      var acta ='{{$acta->codigo}}';

      $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
             },
        url: '{{route('actas.invitacion')}}',
        type: 'POST',
        dataType: 'JSON',
        data: {id: id,acta: acta},
      })
      .done(function(data) {
        alert(data.msg)
        console.log("success");
      })
      .fail(function(error) {
        alert(error.responseJSON.msg)
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
      
    });

   


  });


</script>

@endsection
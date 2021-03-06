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
    <a href="#" data-id="{{$acta->id}}" data-acta="{{$acta->codigo}}" title="Enviar Acta" class="btn btn-flat btn-success btn_sendPDF" title="Editar"><i class="fa fa-envelope"></i> Enviar Acta</a>
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


      <div class="col-md-4 col-md-offset-3">
        <p>&nbsp;</p>
        <p><b>Logo De la empresa</b></p>
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
            <th class="text-center">RUT</th>
            <th class="text-center">Email</th>
            <th class="text-center">Invitar</th>
            <th class="text-center">URL</th>
            <th class="text-center hidden-lg">Compartir</th>
          </tr>
         </thead>
         <tbody>
          @foreach($acta->participantes($acta->id) as $p)
           <tr>
             <td class="text-center">{{$p->clientes->nombre}}</td>
             <td class="text-center">{{$p->clientes->apellido}}</td>
             <td class="text-center">{{$p->clientes->rut}}</td>
             <td class="text-center">{{$p->clientes->email}}</td>
             <td class="text-center">
                @if($p->firma == NULL)
                 <a  data-id="{{$p->id}}" class="btn btn-flat btn-success btn_invitar">Invitar</a>
                @else
                 <h3 class="text-center">Autorizado</h3>
                @endif
             </td>
             <td>
               @if($p->firma == NULL)
                 <center><a  href="{{route('actas.firma',['id' => $p->id,'acta_id'=>$acta->id])}}" class="btn btn-flat btn-success btn-sm">Firmar</a></center>
                @else
                 <h3 class="text-center">¡Ya Firmo!</h3>
                @endif

             </td>
             <td class="hidden-lg">
               <button type="button"  class="btn btn-sm btn-warning shareButton" data-url="{{route('actas.firma',['id' => $p->id,'acta_id'=>$acta->id])}}"><i class="fa fa-share-alt-square" aria-hidden="true"></i></button>
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

    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-eye" aria-hidden="true"></i>
          Observaciones
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
          @foreach($acta->observaciones($acta->codigo) as $a)
           <tr>
             <td>{{$loop->index+1}}</td>
             <td class="text-center">{{$a->observacion}}</td>
           </tr>
          @endforeach
         </tbody>
       </table>
      </div>
    </div>

     <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-eye" aria-hidden="true"></i>
          Fotos
          <span class="clearfix"></span>
        </h2>
      </div>
       @forelse($acta->fotos($acta->codigo) as $f)
          <div class="col-md-4"><img src="{{asset('img/actas/fotos/'.$f->foto)}}" class="img-responsive"></div>
       @empty
          <h3>Sin foto</h3>
       @endforelse
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


  <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h3 id="text_response" class="text-center"></h3>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')

<script type="text/javascript">
  $(document).ready(function() {

      $(".btn_sendPDF").click(function(event) {
        event.preventDefault();
        $('#exampleModal').modal('toggle');
        $("#text_response").text("Enviando...");
        let acta = $(this).data('acta');
          id =  $(this).data('id'); //id del acta
        $.ajax({
          headers: {
                  'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
          url: '{{route('acta.sendMail')}}',
          type: 'POST',
          dataType: 'JSON',
          data: {id: id,acta: acta},
        })
        .done(function(data) {
          $('#exampleModal').modal('hide');
          Swal.fire({
                  title: data.msg,
                })
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
        
      });

    $(".data-table").on('click','.shareButton', function () {

      var DataUrl = $(this).data('url');

      /* Mostramos la opcion nativa de compartir si se navega desde Android */
      if (navigator.userAgent.match(/Android/i)) {
        /* Use the Web Share API from Chrome 61+ */
        navigator.share({title: 'Acta', url: DataUrl}).then(console.log('Share successful'));
      }
      /* Caso contrario mostramos mensaje de alerta */
      else { alert('Para activar la opcion nativa de compartir debes utilizar Chrome en Android') }
    });// fin click deshabilitar

    $(".data-table").on('click','.btn_invitar', function () {

      var id = $(this).data('id');

      var acta ='{{$acta->codigo}}';

      var id_acta = '{{$acta->id}}'

      $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
             },
        url: '{{route('actas.invitacion')}}',
        type: 'POST',
        dataType: 'JSON',
        data: {id: id,acta: acta,id_acta: id_acta},
      })
      .done(function(data) {
        Swal.fire({
            title: data.msg,
          })
      })
      .fail(function(error) {
        //alert(error.responseJSON.msg)
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
    });// fin click invitar

     /* Recuperamos el boton */
    shareButton = document.getElementById("shareButton");
    /* Capturamos el evento CLICK */

    // $(".btn_invitar").click(function(event) {
    //   event.preventDefault();

    //   var id = $(this).data('id');

    //   var acta ='{{$acta->codigo}}';

    //   var id_acta = '{{$acta->id}}'

    //   $.ajax({
    //     headers: {
    //             'X-CSRF-TOKEN': $('input[name="_token"]').val()
    //          },
    //     url: '{{route('actas.invitacion')}}',
    //     type: 'POST',
    //     dataType: 'JSON',
    //     data: {id: id,acta: acta,id_acta: id_acta},
    //   })
    //   .done(function(data) {
    //     alert(data.msg)
    //     console.log("success");
    //   })
    //   .fail(function(error) {
    //     alert(error.responseJSON.msg)
    //     console.log("error");
    //   })
    //   .always(function() {
    //     console.log("complete");
    //   });

    // });




  });


</script>

@endsection

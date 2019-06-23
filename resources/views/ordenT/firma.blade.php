@extends('layouts.app')
@section('title','Orden De Trabajo - '.config('app.name'))
@section('header','Orden De Trabajo')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> Orden De Trabajo {{$orden->cod_seguimiento}} </li>
	  <li class="active">Ver </li>
	</ol>
@endsection
@section('content')

	<section class="perfil">
		<div class="row">
    	<div class="col-md-12">
    		<h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-user" aria-hidden="true"></i>
          {{ 'Orden De Trabajo '.$orden->cod_seguimiento }}
          <small class="pull-right">Registrado: {{ $orden->created_at }}</small>
          <span class="clearfix"></span>
        </h2>
    	</div>
			<div class="col-md-5">
				<h4>Detalles de la empresa</h4>
				<p><b>Usuario: </b> {{$orden->user->nombre}} </p>
        <p><b>Empresa: </b> {{strtoupper($orden->empresa->r_social)}}</p>
        <p><b>Ciudad: </b> {{strtoupper($orden->empresa->ciudad)}}</p>
        <p><b>RUT: </b> {{strtoupper($orden->empresa->rut)}}</p>
        <p><b>Contacto: </b> {{strtoupper($orden->empresa->contacto)}}</p>
        <p><b>Telefono: </b> {{strtoupper($orden->empresa->telefono)}}</p>
        <p><b>Direccion: </b> {{strtoupper($orden->empresa->direccion)}}</p>
        
			</div>

      <div class="col-md-2"> 
        <p>&nbsp;</p>
        <p><b>Logo</b></p>
        <img src="{{asset('img/empresas/'.$orden->empresa->logo)}}" class="img-responsive">
      </div>
		</div>

    <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-users" aria-hidden="true"></i>
          Firma Aquí
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-12">
     
         <form method="POST" enctype="multipart/form-data" id="form_pad">
         <meta name="csrf-token" content="{{ csrf_token() }}" />
          <input type="hidden" name="id_orden" value="{{$id}}">
          <input type="hidden" name="firma" id="firma" required>
          <div class="row">
            @if(!$participante->firma)
             <div class="col-md-6 col-md-offset-3">
                {{-- <label class="control-label" for="Firma">Firma: *</label> --}}
              <div id="signArea" >
                <div class="sig sigWrapper" style="height:auto;">
                  <div class="typed"></div>
                  <canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
                </div>
                <h3 class="tag-ingo text-center">{{$participante->nombre.' '.$participante->apellido}}</h3>
              </div>
            </div>
           @else
            <div class="col-md-6 col-md-offset-3">
              <img src="{{asset('img/firmas/ordent').'/'.$participante->firma}}">
              <h3 class="tag-ingo text-center">{{$participante->nombre.' '.$participante->apellido}} Confirmado</h3>
            </div>
           @endif
          </div>
        @if(!$participante->firma)
          <div class="row">
            <div class="form-group text-center">
              <button type="button" id="clear" class="btn btn-warning" align="center">Limpiar firma</button>
              <button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
            </div>
          </div>
        @endif
         </form>
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
            <th class="text-center">Nombre</th>
            <th class="text-center">Cantidad</th>
          </tr>
         </thead>
         <tbody>
          @foreach($detalles as $a)
           <tr>
             <td>{{$loop->index+1}}</td>
             <td class="text-center">{{$a->nombre}}</td>
             <td class="text-center">{{$a->cantidad}}</td>
           </tr>
          @endforeach
         </tbody>
       </table>
      </div>
    </div>
	</section>

@endsection

@section('script')

<script type="text/javascript">
 
  $(document).ready(function(){

    $("#clear").click(function(e){
       $('#signArea').signaturePad().clearCanvas();
    });

      //firma
      $('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
      
      $("#form_pad").submit(function(e){
        e.preventDefault();
        html2canvas([document.getElementById('sign-pad')], {
          onrendered: function (canvas) {
            var canvas_img_data = canvas.toDataURL('image/png');
            var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");

            $("#firma").val(img_data);

            if ( $("p.error").is(':visible') ) {
              $("p.error").text("Falta la firma del documento.");
              
            }else{
              //alert("fdfdfd")
                $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  url: '{{route('ordentrabajo.send')}}',
                  data: $("#form_pad").serialize(),
                  type: 'post',
                  dataType: 'json',
                  success: function (response) {
                    alert(response.msg);
                     window.location.reload();
                  }
                });
            }
            
          
          }
        });// fin html2canvas
      }); //fin firma

});
</script>

@endsection
@extends('layouts.app')
@section('title','Recibo De Pago - '.config('app.name'))
@section('header','Recibo De Pago')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('login')}}"><i class="fa fa-home" aria-hidden="true"></i> Login</a></li>
	  <li> Recibo De Pago {{$recibo->cod_seguimiento}} </li>
	  <li class="active">Ver </li>
	</ol>
@endsection
@section('content')

	<section class="perfil">
		<div class="row">
    	<div class="col-md-12">
    		<h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-user" aria-hidden="true"></i>
          {{ 'Recibo De Pago '.$recibo->cod_seguimiento }}
          <small class="pull-right">Registrado: {{ $recibo->created_at }}</small>
          <span class="clearfix"></span>
        </h2>
    	</div>
      
			<div class="col-md-5">
				<h4>Detalles de la empresa</h4>
				<p><b>Usuario: </b> {{$recibo->user->nombre}} </p>
        <p><b>Empresa: </b> {{strtoupper($recibo->empresa->r_social)}}</p>
        <p><b>Ciudad: </b> {{strtoupper($recibo->empresa->ciudad)}}</p>
        <p><b>RUT: </b> {{strtoupper($recibo->empresa->rut)}}</p>
        <p><b>Contacto: </b> {{strtoupper($recibo->empresa->contacto)}}</p>
        <p><b>Telefono: </b> {{strtoupper($recibo->empresa->telefono)}}</p>
        <p><b>Direccion: </b> {{strtoupper($recibo->empresa->direccion)}}</p>
			</div>

      <div class="col-md-2"> 
        <p>&nbsp;</p>
        <p><b>Logo</b></p>
        <img src="{{asset('img/empresas/'.$recibo->empresa->logo)}}" class="img-responsive">
      </div>
		</div>
  <br>
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
          <input type="hidden" name="id_recibo" value="{{$recibo->id}}">
          <input type="hidden" name="firma" id="firma" required>
          <div class="row">
            @if(!$recibo->status)
             <div class="col-md-6 col-md-offset-3">
                {{-- <label class="control-label" for="Firma">Firma: *</label> --}}
              <div id="signArea" >
                <div class="sig sigWrapper" style="height:auto;">
                  <div class="typed"></div>
                  <canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
                </div>
                <h3 class="tag-ingo text-center">Sr/Sra. {{strtoupper($recibo->recibe)}}</h3>
              </div>
            </div>
           @else
            <div class="col-md-6 col-md-offset-3">
              <img src="{{asset('img/firmas/recibog').'/'.$recibo->firma_receptor}}">
              <h3 class="tag-ingo text-center">Confirmado</h3>
            </div>
           @endif
          </div>
        @if(!$recibo->status)
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
    <br>
      <div class="row">
      <div class="col-md-12">
        <h2 class="page-header" style="margin-top:0!important">
          <i class="fa fa-list" aria-hidden="true"></i>
          Detalles Del Recibo
          <span class="clearfix"></span>
        </h2>
      </div>
      <div class="col-md-6">
          <p><b>Concepto: </b>{{strtoupper($detalle->concepto)}}</p>
          <p><b>Cantidad:</b> {{number_format($detalle->cantidad)}}</p>
          <p><b>Cuenta:</b> {{$detalle->cuenta}}</p>
          <p><b>Tipo De Pago:</b> {{strtoupper($detalle->transferencia_efectivo)}}</p>
          <p><b>Adicional:</b> {{strtoupper($detalle->adicional?$detalle->adicional:'N/T')}}</p>
          <p><b>Observaciones:</b> {{strtoupper($detalle->observaciones?$detalle->observaciones:'N/T')}}</p>
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
                  url: '{{route('recibogastos.send')}}',
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
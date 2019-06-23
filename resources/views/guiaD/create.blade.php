@extends('layouts.app')
@section('title','Guia De Despacho - '.config('app.name'))
@section('header','Guia De Despacho')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('guiadespacho.index')}}" title="Guia De Despacho"> Guia De Despacho </a></li>
	  <li class="active">Guia De Despacho</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				
			</div>
		</div>

		<div class="row">
	  	<div class="col-md-12">
	    	<div class="box box-success">
		      <div class="box-header with-border">
		        <h3 class="box-title"><i class="fa fa-users"></i> Registrar Guia De Despacho</h3>
		        <span class="pull-right"></span>
		       </div>
      			<div class="box-body">
					<form   method="POST" enctype="multipart/form-data" id="form_pad">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}
					{{-- <input type="hidden" name="id_empresa" value="{{$empresa->id}}"> --}}
					<input type="hidden" name="firma" id="firma" required>
					<h4>Empresa</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group {{ $errors->has('empresa')?'has-error':'' }}">
								<label class="control-label" for="empresa">Empresa: *</label>
									<select class="form-control" name="id_empresa">
										<option value="">Seleccione...</option>
										@foreach($empresa as $e)
											<option value="{{$e->id}}">{{$e->r_social}}</option>
										@endforeach
									</select>
							</div>
						</div>
					</div>
					<hr>
						<h2 class="text-center">Empresa Receptora</h2>
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="empresa">Empresa: *</label>
									<select class="form-control" name="id_empresa_despacho" id="empresa_despacho" required="">
										@foreach($empresa_despachos as $e)
											<option value="{{$e->id}}">{{strtoupper($e->r_social)}}</option>
										@endforeach
									</select>
									<span><a data-toggle="modal" data-target="#delModal">Registrar Empresa</a></span>
							</div>
						</div>
						<hr>
						<h2 class="text-center">Responsable</h2>
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="recibe">Nombre Completo: *</label>
								<input type="text" name="recibe" class="form-control">
							</div>
						</div>
					<hr>
						<h2 class="text-center">Productos</h2>
					<hr>
						<div class="field_wrapper row">
							<div class="col-md-3">
								<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Tipo: *</label>
										<input id="razon_social" class="form-control" type="text" name="tipo_modelo[]" onkeyup="mayus(this);" placeholder="Tipo" required >
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Producto: *</label>
										<input id="razon_social" class="form-control" type="text" name="producto[]" onkeyup="mayus(this);"  placeholder="Producto" required >
								</div>
							</div>
							
							<div class="col-md-3">
								<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Precio Unt: *</label>
										<input id="razon_social" class="form-control" type="number" name="precio_unt[]"  placeholder="Precio Unitario." required >
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Cantidad: *</label>
										<input id="razon_social" class="form-control" type="number" name="cantidad[]"  placeholder="Cantidad" required >
								</div>
							</div>  
						</div>
						
						<div class="row">
							<div class="col-md-1 col-md-offset-6">
						        <a href="javascript:void(0);" class=" btn btn-sm btn-success add_button" title="Add field"><i class="fa fa-plus"></i></a>
						    </div>

						    <hr>
						 <h2 class="text-center">Observaciones</h2>
					    <hr>
						
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="razon_social">Observación: *</label>
										<textarea class="form-control" name="observaciones" placeholder="Observación"></textarea>
								</div>
							</div>

						    <div class="col-md-6 col-md-offset-3">
						    	{{-- <label class="control-label" for="Firma">Firma: *</label> --}}
								<div id="signArea" >
									
									<div class="sig sigWrapper" style="height:auto;">
										<div class="typed"></div>
										<canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
									</div>
									<h3 class="tag-ingo text-center">{{Auth::user()->nombre}}</h3>
									
								</div>
						    </div>
						</div>
						
					</div>

					@if (count($errors) > 0)
			          <div class="alert alert-danger alert-important">
				          <ul>
				            @foreach($errors->all() as $error)
				              <li>{{$error}}</li>
				            @endforeach
				          </ul>  
			          </div>
			        @endif
					<div class="form-group text-right">
						<a class="btn btn-flat btn-default" href="{{route('users.index')}}"><i class="fa fa-reply"></i> Atras</a>
						<button type="button" id="clear" class="btn btn-warning" align="center">Limpiar firma</button>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
					<br>
				</form>
				</div>
			</div>
		</div>
	</div>


	<div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="delModalLabel">Registrar Empresa</h4>
        </div>
        <div class="modal-body">
        	<div class="content">
        		<div class="row">
        			<h4 id="message_error" class="text-danger"></h4>
		           <form class="" enctype="multipart/form-data" id="form_empresa_despacho">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('r_social')?'has-error':'' }}">
								<label class="control-label" for="r_social">Razon Social: *</label>
								<input id="r_social" class="form-control" type="text" name="r_social" value="{{ old('r_social')?old('r_social'):'' }}" placeholder="Razon Social" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('contacto')?'has-error':'' }}">
								<label class="control-label" for="contacto">Contacto: *</label>
								<input id="contacto" class="form-control" type="text" name="contacto" value="{{ old('contacto')?old('contacto'):'' }}" placeholder="Contacto" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('rut')?'has-error':'' }}">
								<label class="control-label" for="rut">RUT: *</label>
								<input id="rut" class="form-control rut" type="text" name="rut" value="{{ old('rut')?old('rut'):'' }}" placeholder="RUT" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('ciudad')?'has-error':'' }}">
								<label class="control-label" for="ciudad">Ciudad: *</label>
								<input id="ciudad" class="form-control" type="text" name="ciudad" value="{{ old('ciudad')?old('ciudad'):'' }}" placeholder="Ciudad" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('telefono')?'has-error':'' }}">
								<label class="control-label" for="telefono_user">Telefono: *</label>
								<input id="telefono" class="form-control tlf" type="text" name="telefono" value="{{ old('telefono')?old('telefono_user'):'' }}" placeholder="Telefono" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('direccion')?'has-error':'' }}">
								<label class="control-label" for="direccion_user">Direccion: *</label>
								<input id="direccion" class="form-control" type="text" name="direccion" value="{{ old('direccion')?old('direccion'):'' }}" placeholder="Direccion" required>
							</div>
						</div>
					</div>

					@if (count($errors) > 0)
			          <div class="alert alert-danger alert-important">
				          <ul>
				            @foreach($errors->all() as $error)
				              <li>{{$error}}</li>
				            @endforeach
				          </ul>  
			          </div>
			        @endif
					<div class="form-group text-right">
						<a class="btn btn-flat btn-default" href="{{route('users.index')}}"><i class="fa fa-reply"></i> Atras</a>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
				</form>
          </div>
        	</div>
          
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')

<script type="text/javascript">
	function mayus(e) {//poner datos en mayusula
	    e.value = e.value.toUpperCase();
	}
	$(document).ready(function(){

		$("#clear").click(function(e){ //borrar firma
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

						$("#clear").click(function(event) {
							alert("ssf");
						});


						if ( $("p.error").is(':visible') ) {
						  $("p.error").text("Falta la firma del documento.");
						  
						}else{
							//alert("fdfdfd")
								$.ajax({
									url: '{{route('guiadespacho.store')}}',
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
/// aqui es para agregar mas productos

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="remove"><div class="col-md-3"><div class="form-group"><label class="control-label" for="razon_social">Tipo: *</label><input id="razon_social" class="form-control" type="text" name="tipo_modelo[]" onkeyup="mayus(this);"  placeholder="Tipo" required ></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="razon_social">Producto: *</label><input id="razon_social" class="form-control" type="text" name="producto[]" onkeyup="mayus(this);"  placeholder="Producto" required ></div></div><div class="col-md-3"><div class="form-group "><label class="control-label" for="razon_social">Precio Unt.: *</label><input id="razon_social" class="form-control" type="number" name="precio_unt[]" placeholder="Precio Unt." required ></div></div><div class="col-md-2"><div class="form-group"><label class="control-label" for="razon_social">Cantidad: *</label><input id="razon_social" class="form-control" type="number" name="cantidad[]"  placeholder="Cantidad" required ></div></div><div class="col-md-1"><div class="form-group"><label class="control-label" for="razon_social">Eliminar: *</label><br><a href="javascript:void(0);" class="btn btn-sm btn-danger remove_button" title="Remove field">X</a></div></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        //alert($(this).parent('div'));
        console.log($(this).parent('div'));
        $(this).parent('div').parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });




    $("#form_empresa_despacho").submit(function(event) {
    	event.preventDefault();
    	$.ajax({
    		url: '{{route('guiadespacho.empresa')}}',
    		type: 'POST',
    		dataType: 'json',
    		data: $("#form_empresa_despacho").serialize(),
    	})
    	.done(function(data) {
    		console.log(data.empresas);
    		if (data.status) {
    			$("#delModal").modal('hide');
    			$("#form_empresa_despacho")[0].reset();

    			var datos = "";
    			$.each(data.empresas, function(index, val) {
    				datos += "<option val="+val.id+">"+val.r_social+"</option>";
    			});
    			$("#empresa_despacho").html(datos);
    		}else{
    			$("#message_error").text(data.msg);
    		}
    	})
    	.fail(function() {
    		console.log("error");
    	})
    	.always(function() {
    		console.log("complete");
    	});
    	
    });
});// fin document ready
</script>

@endsection

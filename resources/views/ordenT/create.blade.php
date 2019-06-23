@extends('layouts.app')
@section('title','Orden Trabajo - '.config('app.name'))
@section('header','Orden Trabajo')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('ordentrabajo.index')}}" title="Orden Trabajo"> Orden Trabajo </a></li>
	  <li class="active">Orden Trabajo</li>
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
		        <h3 class="box-title"><i class="fa fa-file-o"></i> Registrar Orden De Trabajo</h3>
		        <span class="pull-right"></span>
		       </div>
      			<div class="box-body">
					<form   method="POST" enctype="multipart/form-data" id="form_pad">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}
					<input type="hidden" name="id_user" value="{{Auth::user()->id}}">
					<input type="hidden" name="firma" id="firma" required>
					<h4>Datos de la empresa</h4>
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
					<h4>Datos de responsable</h4>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('empresa')?'has-error':'' }}">
								<label class="control-label" for="empresa">Nombre: *</label>
									<input id="empresa" class="form-control" type="text"  value="{{strtoupper(Auth::user()->nombre)}}" placeholder="Razon Social" required readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
								<label class="control-label" for="razon_social">RUT: *</label>
									<input id="razon_social" class="form-control" type="text"  value="{{strtoupper(Auth::user()->rut_user)}}" placeholder="Razon Social" required readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
								<label class="control-label" for="razon_social">Dirección: *</label>
									<textarea class="form-control" readonly="">{{Auth::user()->direccion_user}}</textarea>
							</div>
						</div>
						
					</div>
					<hr>
						 <h2 class="text-center">Fechas</h2>
					    <hr>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group {{ $errors->has('fecha_inicio')?'has-error':'' }}">
									<label class="control-label" for="fecha_inicio">Fecha Inicio: *</label>
										<input id="fecha_inicio" class="form-control" type="date" name="fecha_inicio"  placeholder="Acción" required >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group {{ $errors->has('fecha_fin')?'has-error':'' }}">
									<label class="control-label" for="fecha_fin">Fecha Fin: *</label>
										<input id="fecha_fin" class="form-control" type="date" name="fecha_fin"  placeholder="Acción" required >
								</div>
							</div>
						</div>
						
						
						{{-- <div class="row">
							<div class="col-md-1 col-md-offset-6">
						        <a href="javascript:void(0);" class=" btn btn-sm btn-success add_button_acciones" title="Add field"><i class="fa fa-plus"></i></a>
						    </div>
						</div> --}}
					
					<hr>
						<h2 class="text-center">Participantes</h2>
					<hr>
						<div class="field_wrapper_acciones row">
							<div class="col-md-3">
								<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Nombre: *</label>
										<input id="razon_social" class="form-control" type="text" name="nombre_part[]" onkeyup="mayus(this);" placeholder="Nombre" required >
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Apellido: *</label>
										<input id="razon_social" class="form-control" type="text" name="apellido[]" onkeyup="mayus(this);"  placeholder="Apellido" required >
								</div>
							</div>
							
							<div class="col-md-3">
								<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Cargo: *</label>
									<input id="razon_social" class="form-control" type="text" name="cargo[]"   placeholder="Cargo" required >
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Email: *</label>
									<input id="razon_social" class="form-control" type="email" name="email[]"   placeholder="Email" required >
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-1 col-md-offset-6">
						        <a href="javascript:void(0);" class=" btn btn-sm btn-success add_button_acciones" title="Add field"><i class="fa fa-plus"></i></a>
						    </div>
						</div>

						<hr>
						<h2 class="text-center">Detalles De Trabajos</h2>
					<hr>
						<div class="field_wrapper row">
							<div class="col-md-6">
								<div class="form-group {{ $errors->has('cantidad')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Nombre: *</label>
										<input id="razon_social" class="form-control" type="text" name="nombre[]" onkeyup="mayus(this);" placeholder="Nombre" required >
								</div>
							</div>

							<div class="col-md-5">
								<div class="form-group {{ $errors->has('cantidad')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Cantidad: *</label>
										<input id="razon_social" class="form-control" type="number" name="cantidad[]" onkeyup="mayus(this);"  placeholder="Cantidad" required >
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-1 col-md-offset-6">
						        <a href="javascript:void(0);" class=" btn btn-sm btn-success add_button" title="Add field"><i class="fa fa-plus"></i></a>
						    </div>
						</div>

						  <div class="col-md-6 col-md-offset-3">
						    	{{-- <label class="control-label" for="Firma">Firma: *</label> --}}
								<div id="signArea" >
									
									<div class="sig sigWrapper" style="height:auto;">
										<div class="typed"></div>
										<canvas class="sign-pad" id="sign-pad" width="300" height="100"></canvas>
									</div>
									<h3 class="tag-ingo text-center">Responsable:</h3>
									<h3 class="tag-ingo text-center">{{Auth::user()->nombre}}</h3>
									
								</div>
						    </div>
					</div>
					
					<div class="form-group text-right">
						<a class="btn btn-flat btn-default" href="{{route('users.index')}}"><i class="fa fa-reply"></i> Atras</a>
						<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
					</div>
					<br>
				</form>
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
									url: '{{route('ordentrabajo.store')}}',
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

/// aqui es para agregar personas
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="remove">'+
    						'<div class="col-md-6">'+
								'<div class="form-group">'+
									'<label class="control-label" for="razon_social">Nombre: *</label>'+
										'<input id="razon_social" class="form-control" type="text" name="nombre[]" onkeyup="mayus(this);" placeholder="Nombre" required >'+
								'</div>'+
							  '</div>'+
								'<div class="col-md-5">'+
								'<div class="form-group">'+
									'<label class="control-label" for="razon_social">Cantidad: *</label>'+
										'<input id="razon_social" class="form-control" type=" number" name="cantidad[]" onkeyup="mayus(this);"  placeholder="Cantidad" require>'+
								'</div>'+
							'</div>'+
							'<div class="col-md-1"><div class="form-group"><label class="control-label" for="razon_social">Eliminar: *</label><br><a href="javascript:void(0);" class="btn btn-sm btn-danger remove_button" title="Remove field">X</a></div></div>'+
						 '</div>';

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
    //fin agregar personas

/// aqui es para agregar acciones
    var maxField_acciones = 10; //Input fields increment limitation
    var addButton_acciones = $('.add_button_acciones'); //Add button selector
    var wrapper_acciones = $('.field_wrapper_acciones'); //Input field wrapper
    var fieldHTML_acciones = '<div class="remove">'+
    						'<div class="col-md-3">'+
								'<div class="form-group">'+
									'<label class="control-label" for="razon_social">Nombre: *</label>'+
										'<input id="razon_social" class="form-control" type="text" name="nombre_part[]" onkeyup="mayus(this);" placeholder="Nombre" required >'+
								'</div>'+
							  '</div>'+
								'<div class="col-md-3">'+
								'<div class="form-group">'+
									'<label class="control-label" for="razon_social">Apellido: *</label>'+
										'<input id="razon_social" class="form-control" type="text" name="apellido[]" onkeyup="mayus(this);"  placeholder="Producto" required >'+
								'</div>'+
							'</div>'+
							'<div class="col-md-3">'+
								'<div class="form-group">'+
									'<label class="control-label" for="razon_social">Cargo: *</label>'+
									'<input id="razon_social" class="form-control" type="text" name="cargo[]"  placeholder="Cargo" required  >'+
								'</div>'+
							'</div>'+
							'<div class="col-md-2">'+
								'<div class="form-group">'+
									'<label class="control-label" for="razon_social">Email: *</label>'+
									'<input id="razon_social" class="form-control" type="email" name="email[]"  placeholder="Email" required  >'+
								'</div>'+
							'</div>'+
							'<div class="col-md-1"><div class="form-group"><label class="control-label" for="razon_social">Eliminar: *</label><br><a href="javascript:void(0);" class="btn btn-sm btn-danger remove_button" title="Remove field">X</a></div></div>'+
						 '</div>';

    var x = 1; //Initial field counter is 1
    $(addButton_acciones).click(function(){ //Once add button is clicked
        if(x < maxField_acciones){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper_acciones).append(fieldHTML_acciones); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button_acciones', function(e){ //Once remove button is clicked
        e.preventDefault();
        //alert($(this).parent('div'));
        console.log($(this).parent('div'));
        $(this).parent('div').parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    //fin agregar acciones

});
</script>

@endsection

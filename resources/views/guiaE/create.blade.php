@extends('layouts.app')
@section('title','Guia De Entrega - '.config('app.name'))
@section('header','Guia De Entrega')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('guiaentrega.index')}}" title="Guia De Entrega"> Guia De Entrega </a></li>
	  <li class="active">Guia De Entrega</li>
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
		        <h3 class="box-title"><i class="fa fa-users"></i> Registrar Guia De Entrega</h3>
		        <span class="pull-right"></span>
		       </div>
      			<div class="box-body">
					<form   method="POST" enctype="multipart/form-data" id="form_pad">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}
					<input type="hidden" name="id_empresa" value="{{$empresa->id}}">
					<input type="hidden" name="firma" id="firma" required>
					<h4>Empresa</h4>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('empresa')?'has-error':'' }}">
								<label class="control-label" for="empresa">Empresa: *</label>
									<input id="empresa" class="form-control" type="text"  value="{{strtoupper($empresa->r_social)}}" placeholder="Razon Social" required readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
								<label class="control-label" for="razon_social">RUT: *</label>
									<input id="razon_social" class="form-control" type="text"  value="{{strtoupper($empresa->rut)}}" placeholder="Razon Social" required readonly>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
								<label class="control-label" for="razon_social">Dirección: *</label>
									<textarea class="form-control" readonly="">{{$empresa->direccion}}</textarea>
							</div>
						</div>
						<div class="col-md-3 col-md-offset-5">
							<a href="{{route('empresas.edit',['id' => $empresa->id])}}" class="btn btn-warning">Editar Empresa</a>
						</div>
						
					</div>
					<hr>
						<h2 class="text-center">Recibe: </h2>
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="empresa">Nombre Completo: *</label>
								<input type="text" name="recibe" class="form-control" required="">
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


						if ( $("p.error").is(':visible') ) {
						  $("p.error").text("Falta la firma del documento.");
						  
						}else{
							//alert("fdfdfd")
								$.ajax({
									url: '{{route('guiaentrega.store')}}',
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
});// fin document ready
</script>

@endsection

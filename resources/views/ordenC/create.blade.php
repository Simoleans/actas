@extends('layouts.app')
@section('title','Orden De Compra - '.config('app.name'))
@section('header','Orden De Compra')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('users.index')}}" title="Orden De Compra"> Orden De Compra </a></li>
	  <li class="active">Orden De Compra</li>
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
		        <h3 class="box-title"><i class="fa fa-users"></i> Registrar Orden De Compra</h3>
		        <span class="pull-right"></span>
		       </div>
      			<div class="box-body">
					<form   method="POST" enctype="multipart/form-data" id="form_pad">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}
					<input type="hidden" name="firma" id="firma" required>
					<h4>Agregar Proveedor</h4>
					<div class="row">
						<div class="col-md-6">
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
						<div class="col-md-6">
							<div class="form-group {{ $errors->has('contacto')?'has-error':'' }}">
								<label class="control-label" for="contacto">Proveedor: *</label>
								<select name="id_proveedor" id="id_proveedor" class="form-control" required>
									<option value="">Seleccione...</option>
									@foreach($proveedor as $p)
										<option value="{{$p->id}}">{{$p->razon_social}}</option>
									@endforeach
								</select>
							</div>
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

						$("#clear").click(function(event) {
							alert("ssf");
						});


						if ( $("p.error").is(':visible') ) {
						  $("p.error").text("Falta la firma del documento.");
						  
						}else{
							//alert("fdfdfd")
								$.ajax({
									url: '{{route('ordencompra.store')}}',
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
});
</script>

@endsection

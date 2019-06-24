@extends('layouts.app')
@section('title','Actas - '.config('app.name'))
@section('header','Actas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('users.index')}}" title="Actas"> Actas </a></li>
	  <li class="active">Actas</li>
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
		        <h3 class="box-title"><i class="fa fa-users"></i> Registrar Actas</h3>
		        <span class="pull-right"></span>
		       </div>
      			<div class="box-body">
					<form   method="POST" enctype="multipart/form-data" id="form_pad">
					{{ method_field( 'POST' ) }}
					{{ csrf_field() }}
					<input type="hidden" name="id_user" value="{{Auth::user()->id}}">
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
						<h2 class="text-center">Participantes</h2>
					<hr>
						<div class="field_wrapper row">
							<div class="col-md-3">
								<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Nombre: *</label>
										<input id="razon_social" class="form-control" type="text" name="nombre[]" onkeyup="mayus(this);" placeholder="Nombre" required >
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
									<label class="control-label" for="razon_social">Email: *</label>
										<input id="razon_social" class="form-control" type="text" name="email[]"   placeholder="Email" required >
								</div>
							</div>
							
							<div class="col-md-3">
								<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Cargo: *</label>
									<input id="razon_social" class="form-control" type="text" name="cargo[]"   placeholder="Cargo" required >
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-1 col-md-offset-6">
						        <a href="javascript:void(0);" class=" btn btn-sm btn-success add_button" title="Add field"><i class="fa fa-plus"></i></a>
						    </div>
						</div>

						<hr>
						 <h2 class="text-center">Acciones Realizadas</h2>
					    <hr>
						<div class="field_wrapper_acciones row">
							<div class="col-md-12">
								<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
									<label class="control-label" for="razon_social">Accion: *</label>
										<input id="razon_social" class="form-control" type="text" name="accion[]" onkeyup="mayus(this);" placeholder="Acción" required >
								</div>
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-md-1 col-md-offset-6">
						        <a href="javascript:void(0);" class=" btn btn-sm btn-success add_button_acciones" title="Add field"><i class="fa fa-plus"></i></a>
						    </div>
						</div>

						<hr>
						 <h2 class="text-center">Observaciones</h2>
					    <hr>
						<div class="field_wrapper_observaciones row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label" for="razon_social">Observación: *</label>
										<textarea class="form-control obs" name="observaciones[]" placeholder="Observación"></textarea>
										
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-1 col-md-offset-6">
						        <a href="javascript:void(0);" class=" btn btn-sm btn-success add_button_observaciones" title="Add field"><i class="fa fa-plus"></i></a>
						    </div>
						</div>

						<div class="row">
						<div class="col-md-12">
							<label class="control-label" for="razon_social">Fotos: *</label>
							<input id="multimedia" name="foto[]" type="file" class="file" multiple 
    						data-show-upload="false" data-show-caption="false"  required="">
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





	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {{-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> --}}
      <div class="modal-body">
        <h3 id="text_response" class="text-center"></h3>
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> --}}
    </div>
  </div>
</div>
@endsection

@section('script')

<script type="text/javascript">
	$("#multimedia").fileinput({
            browseClass: "btn btn-primary btn-block",
            showCaption: false,
            browseLabel: "Agregar Fotos",
            browseIcon: "<i class=\"fa fa-file-image-o\"></i> <i class=\"fa fa-volume-off\"></i> <i class=\"fa fa-video-camera\"></i> ",
            showRemove: false,
            showUpload: false,
            showCancel: false,
            showClose: false,
            dropZoneEnabled: false,
             maxFileCount: 5
        });

	function mayus(e) {//poner datos en mayusula
	    e.value = e.value.toUpperCase();
	}

	$(document).ready(function(){
		//registrar todo el fomulario
			$("#form_pad").submit(function(e){
				e.preventDefault();	
				$('#exampleModal').modal('toggle');	
				$("#text_response").text("Guardando...");
			var formData = new FormData($("#form_pad")[0]);
				$.ajax({
					url: '{{route('actas.store')}}',
					data: formData,
					type: 'post',
					dataType: 'json',
					contentType: false,
			        cache: false,
			        processData:false,
					success: function (response) {
						//alert(response.msg);
						$("#text_response").text(response.msg);
						$('#exampleModal').modal('hide');	
					   window.location.replace(response.url);
					},
				});	
			}); //fin guardar formulario

/// aqui es para agregar personas
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="remove">'+
    						'<div class="col-md-3">'+
								'<div class="form-group">'+
									'<label class="control-label" for="razon_social">Nombre: *</label>'+
										'<input id="razon_social" class="form-control" type="text" name="nombre[]" onkeyup="mayus(this);" placeholder="Nombre" required>'+
								'</div>'+
							  '</div>'+
								'<div class="col-md-3">'+
								'<div class="form-group">'+
									'<label class="control-label" for="razon_social">Apellido: *</label>'+
										'<input id="razon_social" class="form-control" type="text" name="apellido[]" onkeyup="mayus(this);"  placeholder="Producto" required>'+
								'</div>'+
							'</div>'+
							'<div class="col-md-3">'+
								'<div class="form-group">'+
								 '<label class="control-label" for="razon_social">Email: *</label>'+
								 '<input id="razon_social" class="form-control" type="text" name="email[]"  placeholder="Email" required>'+
								'</div>'+
							'</div>'+
							'<div class="col-md-3">'+
								'<div class="form-group">'+
									'<label class="control-label" for="razon_social">Cargo: *</label>'+
									'<input id="razon_social" class="form-control" type="text" name="cargo[]"  placeholder="Cargo" required>'+
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
    					    '<div class="col-md-11">'+
								'<div class="form-group">'+
									'<label class="control-label" for="razon_social">Accion: *</label>'+
										'<input id="razon_social" class="form-control" type="text" name="accion[]" onkeyup="mayus(this);" placeholder="Acción" required >'+
								'</div>'+
							'</div>'+
								
							'<div class="col-md-1"><div class="form-group"><label class="control-label" for="razon_social">Eliminar: *</label><br><a href="javascript:void(0);" class="btn btn-sm btn-danger remove_button_acciones" title="Remove field">X</a></div></div>'+
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

    /// aqui es para agregar observaciones
    var maxField_observaciones = 10; //Input fields increment limitation
    var addButton_observaciones = $('.add_button_observaciones'); //Add button selector
    var wrapper_observaciones = $('.field_wrapper_observaciones'); //Input field wrapper
    var fieldHTML_observaciones = '<div class="remove">'+
    					    '<div class="col-md-11">'+
								'<div class="form-group">'+
									'<label class="control-label" for="razon_social">Observación: *</label>'+
										'<textarea class="form-control obs" name="observaciones[]" placeholder="Observación"></textarea>'+
								'</div>'+
								'<div class="contador"></div>'+
							'</div>'+
								
							'<div class="col-md-1"><div class="form-group"><label class="control-label" for="razon_social">Eliminar: *</label><br><a href="javascript:void(0);" class="btn btn-sm btn-danger remove_button_observaciones" title="Remove field">X</a></div></div>'+
						 '</div>';

    var x = 1; //Initial field counter is 1
    $(addButton_observaciones).click(function(){ //Once add button is clicked
        if(x < maxField_observaciones){ //Check maximum number of input fields
            x++; //Increment field counter
           
            $(wrapper_observaciones).append(fieldHTML_observaciones); // Add field html
        }else{
        	alert("¡Ya tiene un maximo de 8 observaciones")
        }
    });
    $(wrapper).on('click', '.remove_button_observaciones', function(e){ //Once remove button is clicked
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

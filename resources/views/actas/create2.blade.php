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
						<input type="hidden" name="id_empresa" value="{{ $empresa->id}}">
						<h4>Datos de la empresa</h4>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group {{ $errors->has('empresa')?'has-error':'' }}">
									<label class="control-label" for="empresa">Empresa: *</label>
										<input type="text" name="empresa" value="{{ strtoupper($empresa->r_social)}}" placeholder="{{ strtoupper($empresa->r_social)}}" readonly="" class="form-control">
								</div>
							</div>
						</div>
						<hr>
							<h2 class="text-center">Clientes</h2>
						<hr>
							<div class="field_wrapper row">
								{{-- Aqui se pinta el formulario --}}
							</div>
							<div class="row">
					           <div class="col-md-5 col-md-offset-5">
					             <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
					              ¡Agregar Clientes! <i class="fa fa-plus"></i>
					            </a>
					           </div>
					         </div>



							<hr>
							 <h2 class="text-center">Acciones Realizadas</h2>
						    <hr>
							<div class="field_wrapper_acciones row">
								<div class="col-md-12">
									<div class="form-group {{ $errors->has('razon_social')?'has-error':'' }}">
										<label class="control-label" for="razon_social">Accion: *</label>
											<textarea rows="5" cols="80" id="razon_social" class="form-control" type="text" name="accion[]" onkeyup="mayus(this);" placeholder="Acción" required ></textarea>
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
		    						data-show-upload="false" data-show-caption="false" >
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

	@include('partials.modal')

	@include('partials.modalCliente')



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

	 $("#form-cliente").submit(function(event) {
	    event.preventDefault();

	    $.ajax({
	      url: '{{ route('clientes.store') }}',
	      type: 'POST',
	      dataType: 'json',
	      data: $(this).serialize(),
	    })
	    .done(function(data) {
	      if (data.status) {
	        var table = "<tr class='data-cliente'>"+
	        	  "<td style='display:none' class='cliente-id'>"+data.id+"</td>"+
	              "<td class='cliente-nombre'>"+$("#nombre").val()+"</td>"+
	              "<td class='cliente-apellido'>"+$("#apellido").val()+"</td>"+
	              "<td class='cliente-email'>"+$("#email").val()+"</td>"+
	              "<td class='cliente-rut'>"+$("#rut").val()+"</td>"+
	               "<td class='cliente-plan' style='display:none'>"+$("#plan").val()+"</td>"+
	              "<td>"+
	                "<a class='btn btn-flat btn-success btn-sm add-row' title='Add'><i class='fa fa-plus'></i></a>"+
	              "</td>"+
	            "</tr>";
	            $("table tbody").append(table);

	        Swal.fire({
	          type: data.type,
	          title: data.msg,
	        })
	        $('#modal-cliente').modal('hide');
	      }else{
	        Swal.fire({
	          type: data.type,
	          title: data.msg,
	        })
	      }
	    })
	    .fail(function() {
	      console.log("error");
	    })
	    .always(function() {
	      console.log("complete");
	    });

	  });

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
						let timerInterval
							Swal.fire({
							  title: response.msg,
							  type: response.type,
							  html: 'Sera redireccionado en <strong></strong> segundos',
							  timer: 1500,
							  onBeforeOpen: () => {
							    Swal.showLoading()
							    timerInterval = setInterval(() => {
							      Swal.getContent().querySelector('strong')
							        .textContent = Swal.getTimerLeft()
							    }, 100)
							  },
							  onClose: () => {
							    clearInterval(timerInterval)
							  }
							}).then((result) => {
							  if (
							    // Read more about handling dismissals
							    result.dismiss === Swal.DismissReason.timer
							  ) {
							    window.location.replace(response.url);
							  }
							})
						$('#exampleModal').modal('hide');
					   //window.location.replace(response.url);
					},
				});
			}); //fin guardar formulario

/// aqui es para agregar personas
    var maxField = 10; //Input fields increment limitation
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var x = 0; //Initial field counter is 1
    $("#tbody-clientes").on('click', '.add-row', function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
        	let btn = $(this),
        		tr = btn.closest('.data-cliente'),
        		nombre = tr.find('.cliente-nombre').text(),
        		apellido = tr.find('.cliente-apellido').text(),
        		email = tr.find('.cliente-email').text(),
        		rut = tr.find('.cliente-rut').text(),
        		id = tr.find('.cliente-id').text();
        		id_plan = tr.find('.cliente-plan').text();
        		id_empresa = '{{$empresa->id}}';

            x++; //Increment field counter
            $(wrapper).append('<div class="remove">'+
            						'<input class="id" type="hidden" value="'+id+'" name="id[]">'+
            						'<input class="plan" type="hidden" value="'+id_plan+'" name="id_plan[]">'+
		    						'<div class="col-md-3">'+
										'<div class="form-group">'+
											'<label class="control-label" for="razon_social">Nombre: *</label>'+
												'<input  class="form-control nombre" type="text"  name="nombre[]" onkeyup="mayus(this);" placeholder="Nombre" readonly required value="'+nombre+'">'+
										'</div>'+
									  '</div>'+
										'<div class="col-md-3">'+
										'<div class="form-group">'+
											'<label class="control-label" for="razon_social">Apellido: *</label>'+
												'<input  class="form-control apellido" type="text" name="apellido[]" onkeyup="mayus(this);"  readonly value="'+apellido+'" placeholder="Producto" required>'+
										'</div>'+
									'</div>'+
									'<div class="col-md-3">'+
										'<div class="form-group">'+
										 '<label class="control-label" for="razon_social">Email: *</label>'+
										 '<input  class="form-control email" type="text" name="email[]" readonly value="'+email+'" placeholder="Email" required>'+
										'</div>'+
									'</div>'+
									'<div class="col-md-2">'+
										'<div class="form-group">'+
											'<label class="control-label" for="razon_social">RUT: *</label>'+
											'<input class="form-control rut" type="text" name="rut[]" readonly value="'+rut+'" placeholder="Cargo" required>'+
										'</div>'+
									'</div>'+
									'<div class="col-md-1"><div class="form-group"><label class="control-label">Eliminar: *</label><br><a href="javascript:void(0);" class="btn btn-sm btn-danger remove_button" title="Remove field">X</a></div></div>'+
							 '</div>'); // Add field html

			   	$(this).parents("tr").remove();

        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();

        let btn = $(this),
        	parent = btn.closest('.remove'),
        	nombre = parent.find('.nombre').val(),
        	id = parent.find('.id').val(),
        	apellido = parent.find('.apellido').val(),
        	email = parent.find('.email').val(),
        	rut = parent.find('.rut').val();


        var table = "<tr>"+
        					"<td style='display:none'>"+id+"</td>"+
							"<td>"+nombre+"</td>"+
							"<td>"+apellido+"</td>"+
							"<td>"+rut+"</td>"+
							"<td>"+email+"</td>"+
							"<td>"+
								"<a class='btn btn-flat btn-success btn-sm add-row' title='Add'><i class='fa fa-plus'></i></a>"+
							"</td>"+
						"</tr>";
            $("table tbody").append(table);
        parent.remove()

        // $(this).parent('div').parent('div').parent('div').remove(); //Remove field html
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
										'<textarea rows="5" cols="80"  class="form-control" type="text" name="accion[]" onkeyup="mayus(this);" placeholder="Acción" required ></textarea>'+
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
    $(wrapper_acciones).on('click', '.remove_button_acciones', function(e){ //Once remove button is clicked
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
    $(wrapper_observaciones).on('click', '.remove_button_observaciones', function(e){ //Once remove button is clicked
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

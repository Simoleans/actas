@extends('layouts.app')
@section('title','Inicio - '.config('app.name'))
@section('header','Inicio')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Inicio</li>
	</ol>
@endsection

@section('content')
@if($empresaExist)
	@if(Auth::user()->empresaExist(Auth::user()->id)  || Auth::user()->exitsEmp(Auth::user()->id))
		 {{-- @if(Auth::user()->exitsEmp(Auth::user()->id)) --}}
		  <div class="row">
		    <div class="col-md-4 col-sm-6 col-xs-12">
		      <div class="info-box">
		        <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

		        <div class="info-box-content">
		          <span class="info-box-text">Clientes</span>
		          <span class="info-box-number">{{ count($clientes) }}</span>
		        </div>
		        <!-- /.info-box-content -->
		      </div>
		      <!-- /.info-box -->
		    </div>
		    <div class="col-md-4 col-sm-6 col-xs-12">
		      <div class="info-box">
		        <span class="info-box-icon bg-green"><i class="fa fa-file-text"></i></span>

		        <div class="info-box-content">
		          <span class="info-box-text">Actas</span>
		          <span class="info-box-number">{{ count($actas) }}</span>
		        </div>
		        <!-- /.info-box-content -->
		      </div>
		      <!-- /.info-box -->
		    </div>
		    <div class="col-md-4 col-sm-6 col-xs-12">
		      <div class="info-box">
		        <span class="info-box-icon bg-red"><i class="fa fa-times-circle"></i></span>

		        <div class="info-box-content">
		          <span class="info-box-text">Actas SIN FIRMAR</span>
		          <span class="info-box-number">{{ count($participantes) }}</span>
		        </div>
		        <!-- /.info-box-content -->
		      </div>
		      <!-- /.info-box -->
		    </div>
		  </div><!--row-->
			<div class="row">
			  	<div class="col-md-6">
			    	<div class="box box-warning">
				      <div class="box-header with-border">
				        <h3 class="box-title"><i class="fa fa-users"></i> Actas</h3>
				        <span class="pull-right">
							<a href="{{ route('actas.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Acta</a>
						</span>
				      </div>
		      			<div class="box-body">
							<table class="table data-table table-bordered table-hover table-condensed nowrap" style="width:100%">
								<thead>
									<tr>
										<th class="text-center">Codigo</th>
										<th class="text-center">Usuario</th>
										<th class="text-center">Empresa</th>
										<th class="text-center">Participantes</th>
										<th class="text-center">Fecha inicio</th>
										<th class="text-center">Accion</th>
									</tr>
								</thead>
								<tbody class="text-center">
									@foreach($actas as $d)
										<tr>
											<td>{{$d->codigo}}</td>
											<td>{{$d->user->nombre}}</td>
											<td>{{strtoupper($d->empresa->r_social)}}</td>
											<td>{{$d->total($d->id)}}</td>
											<td>{{$d->created_at->format('Y-m-d')}}</td>
											<td>
												<a class="btn btn-primary btn-flat btn-sm" href="{{ route('actas.show',[$d->id])}}"><i class="fa fa-search"></i></a>
												<a class="btn btn-danger btn-flat btn-sm" href="{{ route('actas.pdf',[$d->id])}}"><i class="fa fa-print"></i></a>
												<a href="#" data-id="{{$d->id}}" data-acta="{{$d->codigo}}" title="Enviar Acta" class="btn btn-flat btn-success btn-sm btn_sendPDF" title="Editar"><i class="fa fa-envelope"></i></a>  
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="col-md-6">
			    	<div class="box box-danger">
				      <div class="box-header with-border">
				        <h3 class="box-title"><i class="fa fa-users"></i> Actas SIN FIRMAR</h3>
				        <span class="pull-right">
							<a href="{{ route('actas.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Acta</a>
						</span>
				      </div>
		      			<div class="box-body">
							<table class="table data-table table-bordered table-hover table-condensed nowrap" style="width:100%">
								<thead>
									<tr>
										<th class="text-center">Codigo</th>
										<th class="text-center">Usuario</th>
										<th class="text-center">Empresa</th>
										<th class="text-center">Fecha inicio</th>
										<th class="text-center">Accion</th>
									</tr>
								</thead>
								<tbody class="text-center">
									@foreach($participantes as $d)
										<tr>
											<td style="background-color: #F99C9C;">{{$d->acta->codigo}}</td>
											<td style="background-color: #F99C9C;">{{$d->acta->user->nombre}}</td>
											<td style="background-color: #F99C9C;">{{strtoupper($d->acta->empresa->r_social)}}</td>
											<td style="background-color: #F99C9C;">{{$d->acta->created_at->format('Y-m-d')}}</td>
											<td style="background-color: #F99C9C;">
												<a class="btn btn-primary btn-flat btn-sm" href="{{ route('actas.show',[$d->acta->id])}}"><i class="fa fa-search"></i></a>
												 <a class="btn btn-danger btn-flat btn-sm" href="{{ route('actas.pdf',[$d->acta->id])}}"><i class="fa fa-print"></i></a>
												{{-- <a href="{{route('ordencompra.edit',[$d->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>  --}}
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				@if(Auth::user()->rol == 1 || Auth::user()->rol == 2 || Auth::user()->rol == 3)
				@if(Auth::user()->rol != 3)
				<div class="col-md-12">
			    	<div class="box box-danger">
				      <div class="box-header with-border">
				        <h3 class="box-title"><i class="fa fa-users"></i> Usuarios</h3>
				        <span class="pull-right">
									<a href="{{ route('users.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Usuario</a>
								</span>
				      </div>
		      			<div class="box-body">
							<table class="table data-table table-bordered table-hover table-condensed">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Nombre</th>
										<th class="text-center">Email</th>
										<th class="text-center">RUT</th>
										<th class="text-center">Telefono</th>
										<th class="text-center">Accion</th>
									</tr>
								</thead>
								<tbody class="text-center">
									@foreach($users as $d)
										<tr>
											<td>{{$loop->index+1}}</td>
											<td>{{$d->nombre}}</td>
											<td>{{$d->email}}</td>
											<td>{{$d->rut_user}}</td>
											<td>{{$d->telefono_user}}</td>
											<td>
												<a class="btn btn-primary btn-flat btn-sm" href="{{ route('users.show',[$d->id])}}"><i class="fa fa-search"></i></a>
												@if(Auth::user()->rol == 1)
													<a href="{{route('users.edit',[$d->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
												@endif
											</td>
										</tr>
									@endforeach
								</tbody>
						</table>
						</div>
					</div>
				</div>
				@endif
				<div class="col-md-12">
			    	<div class="box box-danger">
				      <div class="box-header with-border">
				        <h3 class="box-title"><i class="fa fa-users"></i> Clientes</h3>
				        <span class="pull-right">
							<a href="{{ route('clientes.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Cliente</a>
						</span>
				      </div>
		      			<div class="box-body">
							<table class="table data-table table-bordered table-hover table-condensed">
								 <thead>
			                        <tr>
			                          <th class="text-center" style="display: none;">id</th>
			                          <th class="text-center">Nombre</th>
			                          <th class="text-center">Apellido</th>
			                          <th class="text-center">RUT</th>
			                          <th class="text-center">Email</th>
			                          <th class="text-center">Accion</th>
			                        </tr>
			                      </thead>
			                      <tbody id="tbody-clientes" class="text-center">
			                        @foreach($clientes as $d)
			                          <tr class="data-cliente">
			                            <td class="cliente-id" style="display: none;">{{$d->id}}</td>
			                            <td class="cliente-nombre">{{$d->nombre}}</td>
			                            <td class="cliente-apellido">{{$d->apellido}}</td>
			                            <td class="cliente-rut">{{$d->rut}}</td>
			                            <td class="cliente-email">{{$d->email}}</td>
			                            <td>
			                              <a href="{{route('clientes.edit',[$d->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>

			                          </tr>
			                        @endforeach
			                      </tbody>
							</table>
						</div>
					</div>
				</div>
				@endif
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
		{{-- @endif --}}
	@endif
@else
<div class="col-md-12">
	<div class="box box-danger">
		<div class="box-body">
			<h2 class="text-center">No tienes una empresa registrada</h2>
			<h3 class="text-center">Puedes registrar una <strong><a href="{{route('empresas.create')}}">Aquí</a></strong></h3>
		</div>
	</div>
</div>
@endif

@endsection

@section('script')

<script type="text/javascript">
	$(document).ready(function() {
		$(".data-table").on('click','.btn_sendPDF', function () {
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
	});
</script>
@endsection

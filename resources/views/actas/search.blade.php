@extends('layouts.app')
@section('title','Actas - '.config('app.name'))
@section('header','Actas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Actas </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
  	<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Actas</span>
          <span class="info-box-number">{{ count($actas) }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div><!--row-->

	<div class="row">
	  	<div class="col-md-12">
	  		<div class="box box-danger">
		      <div class="box-header with-border">
		        <h3 class="box-title"><i class="fa fa-users"></i> Actas</h3>
		        <!-- <span class="pull-right">
					<a href="{{ route('actas.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i>Buscar</a>
				</span> -->
		      </div>
      			<div class="box-body">
					<div class="row">
						<div class="col-md-9 col-md-offset-3">
							<form class="form-inline" method="POST" action="{{route('search.actas')}}">
								<input type="hidden" name="id_empresa" value="{{$empresa->id}}">
								{{ method_field( 'POST' ) }}
								{{ csrf_field() }}
							  <div class="form-group">
							    <label for="exampleInputEmail2">Plan</label>
							     <select name="id_plan" class="form-control">
							    	<option value="">Seleccione...</option>
							    	@foreach($planes as $c)
							    		<option value="{{$c->id}}">{{strtoupper($c->nombre)}}</option>
							    	@endforeach
							    </select>
							  </div>&nbsp;&nbsp;&nbsp;
							   <div class="form-group">
							    <label for="exampleInputEmail2">Clientes</label>
							    <select name="id_cliente" class="form-control">
							    	<option value="">Seleccione...</option>
							    	@foreach($clientes as $c)
							    		<option value="{{$c->id}}">{{strtoupper($c->rut.' - '.$c->nombre.' '.$c->apellido)}}</option>
							    	@endforeach
							    </select>
							  </div>&nbsp;&nbsp;&nbsp;
							  <button type="submit" name="send" class="btn btn-flat btn-success">Buscar</button>
							</form>
						</div>
					</div>
				</div>
			</div>
	    	<div class="box box-danger">
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
								<th class="text-center">Participantes</th>
								<th class="text-center">Fecha inicio</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($actas as $d)
								<tr>
									<td>{{$d->acta->codigo}}</td>
									<td>{{$d->acta->total($d->acta->id)}}</td>
									<td>{{$d->acta->created_at->format('Y-m-d')}}</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ route('actas.show',[$d->acta->id])}}"><i class="fa fa-search"></i></a>
										 <a class="btn btn-danger btn-flat btn-sm" href="{{ route('actas.pdf',[$d->acta->id])}}"><i class="fa fa-print"></i></a>
										 <a href="#" data-id="{{$d->id}}" data-acta="{{$d->codigo}}" title="Enviar Acta" class="btn btn-flat btn-success btn-sm btn_sendPDF" title="Editar"><i class="fa fa-envelope"></i></a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
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

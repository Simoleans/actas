@extends('layouts.app')
@section('title','Inicio - '.config('app.name'))
@section('header','Inicio')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Inicio</li>
	</ol>
@endsection

@section('content')
@if($empresa > 0) {{-- Si tiene empresa registrada --}}
	<div class="row">
	  	<div class="col-md-6">
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
									<td>{{$d->total($d->codigo)}}</td>
									<td>{{$d->created_at->format('Y-m-d')}}</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ route('actas.show',[$d->id])}}"><i class="fa fa-search"></i></a>
										 <a class="btn btn-danger btn-flat btn-sm" href="{{ route('actas.pdf',[$d->id])}}"><i class="fa fa-print"></i></a>
										{{-- <a href="{{route('ordencompra.edit',[$d->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>  --}}
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
		        <h3 class="box-title"><i class="fa fa-users"></i> Usuarios</h3>
		        <span class="pull-right">
							<a href="{{ route('users.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo usuario</a>
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
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@else {{--Si no tiene empresa--}}
	<div class="row">
		<div class="col-md-12">
	    	<div class="box box-danger">
		      <div class="box-header with-border">
		        <span class="pull-right">
					{{-- <a href="{{ route('actas.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Acta</a> --}}
				</span>
		      </div>
      			<div class="box-body">
					<div class="row">
						<div class="col-md-6 col-md-offset-5">
							<h4>¡Registra una empresa!</h4>
						</div>
						<br>
						<div class="col-md-6 col-md-offset-5">
							<a href="{{route('empresas.create')}}" class="btn btn-lg btn-success btn-flat">Registrar Empresa</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endif
@endsection
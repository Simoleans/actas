@extends('layouts.app')
@section('title','Planes - '.config('app.name'))
@section('header','Planes')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Planes </li>
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
          <span class="info-box-text">Planes</span>
          <span class="info-box-number">{{ count($planes) }}</span>
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
		        <h3 class="box-title"><i class="fa fa-users"></i> Mis Planes</h3>
		        <span class="pull-right">
							<a href="{{ route('clientes.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Proveedor</a>
						</span>
		      </div>
      			<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Plan</th>
								<th class="text-center">Fecha In.</th>
								<th class="text-center">Fecha Fin.</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($planes as $d)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td>{{strtoupper($d->nombre)}}</td>
									<td>{{strtoupper($d->fecha_inicio)}}</td>
									<td>{{strtoupper($d->fecha_fin)}}</td>
									<td>
{{-- 		<a class="btn btn-primary btn-flat btn-sm" href="{{ route('clientes.show',[$d->id])}}"><i class="fa fa-search"></i></a> --}}
										<a href="{{route('planes.edit',[$d->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
@extends('layouts.app')
@section('title','Ordenes De Trabajo - '.config('app.name'))
@section('header','Ordenes De Trabajo')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Ordenes De Trabajo </li>
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
          <span class="info-box-text">Ordenes</span>
          <span class="info-box-number">{{ count($ordenest) }}</span>
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
		        <h3 class="box-title"><i class="fa fa-users"></i> Ordenes de Trabajo</h3>
		        <span class="pull-right">
							<a href="{{ route('ordentrabajo.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Orden de trabajo</a>
						</span>
		      </div>
      			<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="text-center">Codigo</th>
								<th class="text-center">Usuario</th>
								<th class="text-center">Empresa</th>
								<th class="text-center">Fecha Inicio</th>
								<th class="text-center">Fecha Fin</th>
								<th class="text-center">Firma</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($ordenest as $d)
								<tr>
									<td class="text-center">{{$d->cod_seguimiento}}</td>
									<td class="text-center">{{$d->user->nombre}}</td>
									<td class="text-center">{{strtoupper($d->empresa->r_social)}}</td>
									<td class="text-center">{{$d->fecha_inicio}}</td>
									<td class="text-center">{{$d->fecha_fin}}</td>
									<td class="text-center">
										<img src="{{asset('img/firmas/ordent').'/'.$d->firma}}" class="img-responsive"  align="center">
									</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ route('ordentrabajo.show',[$d->id])}}"><i class="fa fa-search"></i></a>
										<a class="btn btn-danger btn-flat btn-sm" href="{{ route('ordentrabajo.pdf',[$d->id])}}"><i class="fa fa-print"></i></a> 
										 <!-- <a href="{{route('ordencompra.edit',[$d->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a> -->
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
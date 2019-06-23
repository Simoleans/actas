@extends('layouts.app')
@section('title','Empresas - '.config('app.name'))
@section('header','Empresas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Empresas </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
  	<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-industry"></i></span>
        
        <div class="info-box-content">
          <span class="info-box-text">Empresas</span>
          <span class="info-box-number">{{ count($empresas) }}</span>
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
		        <h3 class="box-title"><i class="fa fa-users"></i> Empresas</h3>
		        <span class="pull-right">
							<a href="{{ route('empresas.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Empresa</a>
						</span>
		      </div>
      			<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Razon S. </th>
								<th class="text-center">RUT</th>
								<th class="text-center">Contacto</th>
								<th class="text-center">Telefono</th>
								<th class="text-center">Giro Comercial</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($empresas as $d)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td>{{strtoupper($d->r_social)}}</td>
									<td>{{$d->rut}}</td>
									<td>{{$d->contacto}}</td>
									<td>{{$d->telefono}}</td>
									<td>{{$d->giro_comercial}}</td>
									<td>
										 <a class="btn btn-primary btn-flat btn-sm" href="{{ route('empresas.show',[$d->id])}}"><i class="fa fa-search"></i></a> 
										<a href="{{route('empresas.edit',[$d->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
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
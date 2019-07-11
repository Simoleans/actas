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
          <span class="info-box-text">Empresa:</span>
          <span class="info-box-number">{{ strtoupper($empresa->r_social) }}</span>
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
		        @if(Auth::user()->rol == 1)
			        <span class="pull-right">
						{{-- <a href="{{ route('empresas.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Empresa</a> --}}
					</span>
				@endif
		      </div>
      			<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="text-center">Razon S. </th>
								<th class="text-center">RUT</th>
								<th class="text-center">Contacto</th>
								<th class="text-center">Telefono</th>
								<th class="text-center">Giro Comercial</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
								<tr>
									<td>{{strtoupper($empresa->r_social)}}</td>
									<td>{{$empresa->rut}}</td>
									<td>{{$empresa->contacto}}</td>
									<td>{{$empresa->telefono}}</td>
									<td>{{$empresa->giro_comercial}}</td>
									<td>
										 <a class="btn btn-primary btn-flat btn-sm" href="{{ route('empresas.show',[$empresa->id])}}"><i class="fa fa-search"></i></a> 
										<a href="{{route('empresas.edit',[$empresa->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
									</td>
								</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
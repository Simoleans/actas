@extends('layouts.app')
@section('title','Ayuda - '.config('app.name'))
@section('header','Ayuda')
@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
    <li><a href="{{route('ayudas.index')}}" title="Ayuda"> Ayudas </a></li>
    <li class="active">Agregar</li>
  </ol>
@endsection
@section('content')
   
@foreach($faq as $f)
<div class="row">
  <div class="col-md-6 col-md-offset-2">
    <div class="box box-success" >
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-question"></i> <a href="#" data-toggle="collapse" data-target="#{{$f->video}}">{{$f->titulo}}</a></h3>
            <span class="pull-right"></span>
           </div>
            <div class="box-body">
                <div id="{{$f->video}}" class="collapse">
                  <h3>{{$f->descripcion}}</h3>
                  <br>
                 <div class="video-responsive">
                    <iframe  src="https://www.youtube.com/embed/{{$f->video}}" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                 </div>
                </div>
           </div>
      </div>
  </div>
</div>
      
@endforeach
      
@endsection

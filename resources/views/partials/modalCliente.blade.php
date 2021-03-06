 <!-- Modal -->
<div class="modal fade" id="modal-cliente" tabindex="-1" role="dialog" aria-labelledby="myModalCliente" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar Clientes</h4>
      </div>
      <div class="modal-body">
         <form class="" id="form-cliente"  method="POST" enctype="multipart/form-data">
          {{ method_field( 'POST' ) }}
          {{ csrf_field() }}
          <input type="hidden" name="id_empresa" value="{{ $empresa->id}}">
          <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
          <h4>Agregar Cliente</h4>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group {{ $errors->has('id_empresa')?'has-error':'' }}">
                <label class="control-label" for="id_empresa">Empresa: *</label>
                <input id="id_empresa" class="form-control" type="text" name="empresa" value="{{ strtoupper($empresa->r_social)}}"  required readonly="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group {{ $errors->has('nombre')?'has-error':'' }}">
                <label class="control-label" for="nombre">Nombre: *</label>
                <input id="nombre" class="form-control" type="text" name="nombre" value="{{ old('nombre')?old('nombre'):'' }}" placeholder="Nombre" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group {{ $errors->has('apellido')?'has-error':'' }}">
                <label class="control-label" for="apellido">Apellido: *</label>
                <input id="apellido" class="form-control" type="text" name="apellido" value="{{ old('apellido')?old('apellido'):'' }}" placeholder="Apellido" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group {{ $errors->has('email')?'has-error':'' }}">
                <label class="control-label" for="email">Email: *</label>
                <input id="email" class="form-control" type="text" name="email" value="{{ old('email')?old('email'):'' }}" placeholder="Email" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group {{ $errors->has('rut')?'has-error':'' }}">
                <label class="control-label" for="rut">RUT: *</label>

                  <input type="text" id="rut" name="rut" required  placeholder="Ingrese RUT" class="form-control rut" maxlength="12">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group {{ $errors->has('telefono')?'has-error':'' }}">
                <label class="control-label" for="telefono_user">Telefono: *</label>
                <input id="telefono" class="form-control tlf" type="text" name="telefono" value="{{ old('telefono')?old('telefono'):'' }}" placeholder="Telefono" required>
              </div>
            </div>
           <div class="col-md-6">
              <div class="form-group {{ $errors->has('id_plan')?'has-error':'' }}">
                <label class="control-label" for="id_plan">Planes: *</label>
                <select class="form-control" name="id_plan" required="" id="plan_id">
                  <option value="">Seleccione...</option>
                  @foreach($planes as $p)
                    <option value="{{$p->id}}">{{$p->nombre}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group {{ $errors->has('ciudad')?'has-error':'' }}">
                <label class="control-label" for="ciudad">Direccion: *</label>
                <textarea class="form-control" name="direccion" required=""></textarea>
              </div>
            </div>

          </div>


          <div class="form-group text-right">
{{--        <a class="btn btn-flat btn-default" href="{{route('users.index')}}"><i class="fa fa-reply"></i> Atras</a> --}}
            <button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
          </div>
        </form>
      </div>

    </form>
    </div>
  </div>
</div>
<!-- fin modal -->

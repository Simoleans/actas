 <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Agregar Clientes</h4>
      </div>
      <div class="modal-body">
         <div class="row">
                <div class="col-md-12">
                    <div class="box-header with-border">
                      {{-- <h3 class="box-title"><i class="fa fa-users"></i> Actas</h3> --}}
                      <span class="pull-right">
                    {{-- a href="{{ route('actas.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva Acta</a> --}}
                    <small><a href="#"  id="myModalCliente" data-toggle="modal" data-target="#modal-cliente" class="btn btn-flat btn-sm btn-success">Registrar Nuevo</a></small>
                  </span>
                    </div>
                      <div class="box-body">
                  <div class="table-responsive">
                    <table class="table data-table table-bordered table-hover table-condensed nowrap display" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th class="text-center" style="display: none;">id</th>
                          <th class="text-center">Nombre</th>
                          <th class="text-center">Apellido</th>
                          <th class="text-center">RUT</th>
                          <th class="text-center">Email</th>
                          <th class="text-center">Plan</th>
                          <th class="text-center" style="display: none;">Accion</th>
                        </tr>
                      </thead>
                      <tbody id="tbody-clientes" class="text-center">
                        @foreach($clientes as $d)
                          <tr class="data-cliente">
                            <td class="cliente-plan" style="display: none;">{{$d->id_plan}}</td>
                            <td class="cliente-id" style="display: none;">{{$d->id}}</td>
                            <td class="cliente-nombre">{{$d->nombre}}</td>
                            <td class="cliente-apellido">{{$d->apellido}}</td>
                            <td class="cliente-rut">{{$d->rut}}</td>
                            <td class="cliente-email">{{$d->email}}</td>
                            <td>
                              <a class="btn btn-flat btn-success btn-sm add-row" title="Add"><i class="fa fa-plus"></i></a>
                              {{-- <a href="{{route('ordencompra.edit',[$d->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>  --}}
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div><!-- box body fin -->
                </div> <!-- fin tabla repsonsive -->
              </div>
            </div>
      </div>
      {{-- <div class="modal-footer">
        <button type="button" id="clear" class="btn btn-warning" align="center">Limpiar firma</button>
        <button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
      </div> --}}
    </form>
    </div>
  </div>
</div>
<!-- fin modal -->

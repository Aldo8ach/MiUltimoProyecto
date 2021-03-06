@extends('layouts.main')
@section('contenidoAd')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Vinos</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalAgregar"> <i class="fas fa-plus fa-sm text-white-50"></i>Agregar Vino</a>
  </div>

<div class="row">
  @if($message=Session::get('Listo'))
  <div class="col-12 alert alert-success alert-dismissable fade show" role="alert">
    
  
  <span>{{$message}}</span>
  </ul>
  </div>

@endif


  @foreach($vinos as $vino)
  
<div class="card m-2" style="width: 18rem;">
<img class="card-img-top" src="{{ asset('/img/vinos/'.$vino->img)}}" style ="height:250px" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Nombre: {{ $vino->nombre }}</h5>
    <p class="card-text">Descripcion: {{ $vino->descripcion }}</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Categoria: {{ $vino->categoria }}</li>
    <li class="list-group-item">Tiempo de elavoración: {{ $vino->demora }}</li>
    
  </ul>
  <div class="card-body">
    <td>
      <button class="btn btn-round btnEliminar" data-id="{{ $vino->id }} " data-toggle="modal" data-target="#modalEliminar"><i class="fa fa-trash"></i></button>
      <button class="btn btn-round btnEditar" data-id="{{ $vino->id }}" data-catego="{{ $vino->categoria }}" data-name="{{ $vino->nombre }}" data-descripcion="{{ $vino->descripcion }}" data-demora="{{ $vino->demora }}" data-toggle="modal" data-target="#modalEditar"><i class="fa fa-edit"></i></button>
      <form action="{{ url('/admin/vinos', ['id'=>$vino->id ]) }}" method="POST" id="formEliminar_{{ $vino->id}}">
      @csrf
      <input type="hidden" name="id" value="{{ $vino->id }}">
      <input type="hidden" name="_method" value="delete">
      </form>
    </td>
  </div>
</div>
@endforeach







</div>

<!-- Modal -->
<div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agrega un vino</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/admin/vinos" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        @if($message=Session::get('ErrorInsert'))
        <div class="col-12 alert alert-danger alert-dismissable fade show" role="alert">
          
          <h5>Errores:</h5>
          <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
        </div>

    @endif
        <div class="form-group">
          <input type="text" class="form-control" name="categoria" placeholder="Categoria"  value="{{old('categoria')}}">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="nombre" placeholder="Nombre del vino" value="{{old('nombre')}}">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="descripcion" placeholder="Descripcion" value="{{old('descripcion')}}">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="demora" placeholder="Tiempo de elavoracion" value="{{old('demora')}}">
                </div>
                <div class="form-group">
                  <input type="file" class="form-control" name="imagen" placeholder="Imagen" >
                  </div>

          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- Modal Eliminar -->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Vino</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
       <h5>¿Desea eliminar el Vino?</h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger btnModalEliminar">Eliminar</button>
      </div>
    
    </div>
  </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar un vino</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/admin/vinos/edit" method="post">
        @csrf
      <div class="modal-body">
        @if($message=Session::get('ErrorInsert'))
        <div class="col-12 alert alert-danger alert-dismissable fade show" role="alert">
          
          <h5>Errores:</h5>
          <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
        </div>

    @endif
    <input type="hidden" name="id" id="idEdit">
        <div class="form-group">
          <input type="text" class="form-control" name="categoria" placeholder="Categoria"  value="{{old('categoria')}}" id="categoriaEdit">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="nombre" placeholder="Nombre del vino" value="{{old('nombre')}}" id="nameEdit">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="descripcion" placeholder="Descripcion" value="{{old('descripcion')}}" id="descripcionEdit">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="demora" placeholder="Tiempo de elavoracion" value="{{old('demora')}}" id="demoraEdit">
                </div>
                

          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection


@section('scripts')
    <script>
      var idEliminar=0;
      $(document).ready(function(){
        @if($message=Session::get('ErrorInsert'))
        $("#modalAgregar").modal('show');
        
        @endif


        $(".btnEliminar").click(function(){
          idEliminar=$(this).data('id');
         
        });

        $(".btnModalEliminar").click(function(){
          $("#formEliminar_"+idEliminar).submit();
         
        });

        $(".btnEditar").click(function(){
          $("#idEdit").val($(this).data('id'));
          $("#categoriaEdit").val($(this).data('catego'));
          $("#nameEdit").val($(this).data('name'));
          $("#descripcionEdit").val($(this).data('descripcion'));
          $("#demoraEdit").val($(this).data('demora'));
         
        });

      });
    </script>
@endsection


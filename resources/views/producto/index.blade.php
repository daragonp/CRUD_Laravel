@extends('layouts.app')

@section('content')
    <div class="container">
            @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session::get('mensaje')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <br>
        <a href="{{url('producto/create')}}" class="btn btn-primary">Crear nuevo producto</a>
        <br>
        <br>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Ítem</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>IVA</th>
                    <th>Cantidad</th>
                    <th>Costo</th>
                    <th>Estado</th>
                    <th>Imagen</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{$producto->id}}</td>
                        <td>{{$producto->nombre}}</td>
                        <td>{{$producto->precio}}</td>
                        <td>{{$producto->precio*0.19+$producto->precio}}</td>
                        <td>{{$producto->cantidad}}</td>
                        <td>{{$producto->costo}}</td>
                        <td>{{$producto->estado==0 ? 'Inactivo':'Activo'}}</td>
                        <td><img src="{{asset('storage'.'/'.$producto->imagen)}}" alt="" width="120"></td>
                        <td>
                            <a href="{{url('/producto/'.$producto->id).'/edit'}}" class="btn btn-warning">Editar</a> 
                        </td>
                        <td>
                            <form action="{{url('/producto/'.$producto->id)}}" method="post" class="d-inline">
                                @csrf
                                {{method_field('DELETE')}}
                                <input type="submit" class="btn btn-danger"  value="Eliminar" onclick="return confirm('Esta opción no se puede deshacer. ¿Desea elimnar?')">
                            </form>
                        </td>    
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $productos->links() !!}
    </div>
@endsection
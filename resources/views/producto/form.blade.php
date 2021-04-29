<h1>{{$modo}} registro</h1>
@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="form-group">
    <label for="nombre">Nombre</label>
    <input class="form-control"  type="text" name="nombre" id="nombre" value="{{isset($producto->nombre)?$producto->nombre:old('nombre')}}"><br>
    <label for="precio">Precio</label>
    <input class="form-control"  type="number" name="precio" id="precio" value="{{isset($producto->precio)?$producto->precio:old('precio')}}"><br>
    <label for="precio">IVA</label><br>
    <input class="form-control" type="text" placeholder="{{isset($producto->precio)?$producto->precio:old('precio')*0.19}}" readonly>
    <label for="cantidad">Cantidad</label>
    <input class="form-control"  type="number" name="cantidad" id="cantidad" value="{{isset($producto->cantidad)?$producto->cantidad:old('cantidad')}}"><br>
    <label for="costo">Costo</label>
    <input class="form-control"  type="number" name="costo" id="costo" value="{{isset($producto->costo)?$producto->costo:old('costo')}}"><br>
    <label for="estado">Estado</label>
        <select name="estado" id="estado">
            <option value="1" class="form-control">Activo</option>
            <option value="0" class="form-control">Inactivo</option>
        </select>
    <!--<input class="form-control"  type="number" name="estado" id="estado" value="{{isset($producto->estado)?$producto->estado:old('estado')}}"><br>-->
</div>
<label for="imagen">Fotografía del producto</label>
<div class="form-group">
    @if(isset($producto->imagen))
    <img class="img-fluid img-thumbnail" src="{{asset('storage'.'/'.$producto->imagen)}}" alt="">
    @endif
    <input type="file" class="form-group" name="imagen" id="imagen" value=""><br>
</div>
<div class="d-flex justify-content-end">
    <a href="{{url('producto/')}}" class="btn btn-primary">Regresar</a>
    <input type="submit" value="{{$modo}} datos" class="btn btn-success">
</div>
    <p>
    <h3 >En estado elija 1 para producto con existencias y 0 para producto sin existencias<h3>
    </p>
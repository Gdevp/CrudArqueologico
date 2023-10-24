<!-- formulario que tendrá datos en común con create.blade y edit.blade -->
<h1> {{ $modo }} Sitio </h1>
@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">

    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" name="nombre"
        value="{{ isset($lugar->nombre) ? $lugar->nombre : old('nombre') }}" id="nombre"><br>
</div>

<div class="form-group">
    <label for="descripcion">Descripción:</label>
    <textarea rows="10" cols="40" class="form-control" name="descripcion" id="descripcion">{{ isset($lugar->descripcion) ? $lugar->descripcion : old('descripcion') }}</textarea>
</div>


<label for="foto"> </label>
@if (isset($lugar->foto))
    <img class="img-thumbnail img-fluid" src="{{ asset('storage') . '/' . $lugar->foto }}" width="350" height="150"
        alt=""><br>
@endif
<input type="file" class="form-control" name="foto" value=""id="foto"><br>

<input class="btn btn-success" type="submit" value="{{ $modo }} datos">
<a class="btn btn-primary" href="{{ url('lugar/') }}">Volver</a>

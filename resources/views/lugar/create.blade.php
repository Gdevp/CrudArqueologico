<!--formulario de creacion nde empleados que va incluido
  al archivo form.blade.php-->

@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ url('/lugar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('lugar.form', ['modo' => 'Añadir'])
        </form>
    </div>
@endsection

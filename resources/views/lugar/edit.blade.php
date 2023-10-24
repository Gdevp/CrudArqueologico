<!-- Mismo formulario que el create.blade,
  solo hago el llamado con include-->

@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ url('/lugar/' . $lugar->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }}
            @include('lugar.form', ['modo' => 'Editar'])
        </form>
    </div>
@endsection

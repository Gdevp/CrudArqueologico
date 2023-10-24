@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Session::has('mensaje'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!-- Form -->
        <a href="{{ url('lugar/create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Agregar Sitio Turístico</a>
        <br><br>
        <div class="row justify-content-center">
            @foreach ($lugars as $lugar)
                <div class="col-md-6 mb-3">
                    <div class="custom-card">
                        <img class="card-img-top" src="{{ asset('storage') . '/' . $lugar->foto }}" alt="Foto del Lugar">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $lugar->nombre }}</h5>
                            <p class="card-text">{{ $lugar->descripcion }}</p>
                            <div class="btn-dobles">
                                <a href="{{ url('/lugar/' . $lugar->id . '/edit') }}" class="btn btn-warning">
                                    Editar
                                </a>
                                <form action="{{ url('/lugar/' . $lugar->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <input class="btn btn-danger" type="submit"
                                        onclick="return confirm('¿Desea Borrar esta información?')" value="Borrar">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <br><br>
        <div class="d-flex justify-content-center">
            {!! $lugars->onEachSide(2)->links() !!}

        </div>

    </div>
@endsection

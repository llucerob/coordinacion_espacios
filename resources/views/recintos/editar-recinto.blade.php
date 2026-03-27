@extends('layout.master')

@section('title', 'Editar Recinto')

@section('css')
    <style>
        .card-body { padding: 30px !important; }
        label { font-size: 18px !important; font-weight: 600 !important; margin-bottom: 10px; }
        .form-control { font-size: 18px !important; padding: 12px !important; height: auto !important; }
        .btn-grande { font-size: 18px !important; padding: 10px 20px !important; }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Editar Recinto</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Recintos</li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5>Editar: {{ $recinto->nombre }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('recintos.update', $recinto->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="form-label">Nombre del Recinto</label>
                            <input type="text" name="nombre" class="form-control" value="{{ $recinto->nombre }}" required>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('recintos.index') }}" class="btn btn-secondary btn-grande me-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary btn-grande">Actualizar Recinto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layout.master')

@section('title', 'Editar Material')

@section('breadcrumb-title')
    <h3>Editar Material</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Materiales</li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Editando: {{ $material->nombre }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('materiales.update', $material->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nombre del Material</label>
                                <input class="form-control" type="text" name="nombre" value="{{ $material->nombre }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Departamento</label>
                                <select class="form-control" name="departamento_id" required>
                                    @foreach($departamentos as $d)
                                        <option value="{{ $d->id }}" {{ $material->departamento_id == $d->id ? 'selected' : '' }}>
                                            {{ $d->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Cantidad (Stock)</label>
                                <input class="form-control" type="number" name="cantidad" value="{{ $material->cantidad }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Unidad de Medida</label>
                                <input class="form-control" type="text" name="unidad_medida" value="{{ $material->unidad_medida }}">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Descripción</label>
                                <textarea class="form-control" name="descripcion" rows="3">{{ $material->descripcion }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <a href="{{ route('materiales.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
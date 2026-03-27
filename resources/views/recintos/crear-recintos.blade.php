@extends('layout.master')

@section('title', 'Crear Nuevo Recinto')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <style>
        .card-body { padding: 25px !important; }
        
        label { 
            font-size: 13px !important; 
            font-weight: 600 !important; 
            margin-bottom: 6px;
            color: #2c3e50;
        }
        
        .form-control, .form-select { 
            font-size: 13px !important; 
            padding: 8px 12px !important; 
            height: auto !important;
            border-radius: 4px;
        }

        .btn-grande { 
            font-size: 13px !important; 
            padding: 8px 16px !important; 
            font-weight: 500;
        }

        .mb-3 { margin-bottom: 15px !important; }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Crear Nuevo Recinto</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Recintos</li>
    <li class="breadcrumb-item active">Nuevo</li>
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Formulario de Registro</h5>
                </div>
                
                <form class="needs-validation" action="{{ route('recinto.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inputNombre">Nombre del Recinto</label>
                                    <input class="form-control" id="inputNombre" type="text" required name="nombre" placeholder="Ej: Gimnasio Municipal" autofocus>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inputUbicacion">Ubicación</label>
                                    <input class="form-control" id="inputUbicacion" type="text" name="ubicacion" placeholder="Ej: Av. Principal #123">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="SelectDepartamento">Departamento Encargado</label>
                                    <select name="departamento_id" id="SelectDepartamento" class="form-select">
                                        <option value="">-- Seleccione Departamento --</option>
                                        @if(isset($categorias))
                                            @foreach ($categorias as $c)
                                                <option value="{{$c->id}}">{{$c->nombre}}</option>    
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inputDias">Días Disponibles</label>
                                    <input class="form-control" id="inputDias" type="text" name="dias_disponibles" placeholder="Ej: Lunes a Viernes">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Horario Apertura</label>
                                    <input class="form-control" type="time" name="h_apertura" required>
                                </div>
                            </div>
                                
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Horario Cierre</label>
                                    <input class="form-control" type="time" name="h_cierre" required>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('recintos.index') }}" class="btn btn-secondary btn-grande me-2">Cancelar</a>
                        <button class="btn btn-primary btn-grande" type="submit">Guardar Recinto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
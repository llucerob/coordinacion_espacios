@extends('layout.master')
@section('title', 'Nueva Actividad')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .card-hover-shadow { transition: transform 0.3s ease, box-shadow 0.3s ease; border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .form-control:focus, .form-select:focus { box-shadow: 0 0 0 0.25rem rgba(115, 102, 255, 0.15); border-color: #7366ff; }
        .input-group-text { background-color: #f8f9fa; border-right: none; color: #7366ff; }
        .form-control, .form-select { border-left: none; padding-left: 0; }
        .form-select { padding-left: 10px; }
        .form-label { font-weight: 600; color: #2c3e50; margin-bottom: 8px; }
        .header-style { background: linear-gradient(to right, #7366ff, #a927f9); color: white; border-radius: 15px 15px 0 0 !important; padding: 20px; }
        .select2-container .select2-selection--multiple { border: 1px solid #ced4da !important; min-height: 45px !important; border-radius: 5px !important; }
        .cantidad-item { background: #f8f9fa; padding: 10px; border-radius: 8px; margin-bottom: 10px; border-left: 4px solid #7366ff; }
    </style>
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6"><h3>Gestión de Actividades</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Actividades</li>
                        <li class="breadcrumb-item active">Nueva</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-xl-10">
                <div class="card card-hover-shadow">
                    <div class="card-header header-style">
                        <h5 class="mb-0 text-white"><i class="fa fa-calendar-plus-o me-2"></i> Nueva Actividad</h5>
                        <small class="text-light opacity-75">Complete los detalles. El stock se descontará automáticamente.</small>
                    </div>

                    <div class="card-body p-5">
                        @if(session('error'))
                            <div class="alert alert-danger inverse alert-dismissible fade show" role="alert">
                                <i class="icon-alert"></i> <p>{{ session('error') }}</p>
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('actividad.store') }}" method="POST" class="needs-validation">
                            @csrf
                            
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Nombre de la Actividad</label>
                                    <input class="form-control" name="nombre" type="text" placeholder="Ej: Bingo" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Lugar / Recinto</label>
                                    <select class="form-select" name="recinto_id" required>
                                        <option value="" selected disabled>Seleccione lugar...</option>
                                        @foreach($recintos as $recinto)
                                            <option value="{{ $recinto->id }}">{{ $recinto->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label class="form-label">Seleccionar Materiales</label>
                                    <select class="form-select select2-materiales" name="materiales_seleccionados[]" multiple="multiple" style="width: 100%" id="select-materiales">
                                        @foreach($materiales as $material)
                                            <option value="{{ $material->id }}" data-nombre="{{ $material->nombre }}" data-stock="{{ $material->cantidad }}">
                                                {{ $material->nombre }} (Stock Disp: {{ $material->cantidad }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="contenedor-cantidades" class="mb-4"></div>

                            <hr class="mb-4" style="opacity: 0.1">

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Fecha Inicio</label>
                                    <input class="form-control" type="date" name="f_inicio" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Fecha Fin</label>
                                    <input class="form-control" type="date" name="f_fin" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Hora Inicio</label>
                                    <input class="form-control" type="time" name="hora_inicio" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Hora Fin</label>
                                    <input class="form-control" type="time" name="hora_fin" required>
                                </div>
                            </div>

                            <div class="card-footer border-0 bg-transparent text-end p-0 mt-5">
                                <a href="{{ route('actividades.index') }}" class="btn btn-light px-4 me-2">Cancelar</a>
                                <button class="btn btn-primary px-4" type="submit">Guardar Actividad</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#select-materiales').select2({
                placeholder: "Busque y seleccione materiales...",
                allowClear: true
            });

            $('#select-materiales').on('change', function() {
                var selectedOptions = $(this).select2('data');
                var container = $('#contenedor-cantidades');
                container.empty(); 

                if(selectedOptions.length > 0) {
                    container.append('<label class="form-label mt-2 text-primary">Indique las cantidades a utilizar:</label>');
                }

                selectedOptions.forEach(function(option) {
                    var stockMax = option.element.dataset.stock; 
                    
                    var html = `
                        <div class="cantidad-item d-flex justify-content-between align-items-center">
                            <span><strong>${option.text}</strong></span>
                            <div class="input-group" style="width: 200px;">
                                <span class="input-group-text">Cant.</span>
                                <input type="number" 
                                       name="cantidades[${option.id}]" 
                                       class="form-control" 
                                       min="1" 
                                       max="${stockMax}" 
                                       required 
                                       placeholder="Máx ${stockMax}">
                            </div>
                        </div>
                    `;
                    container.append(html);
                });
            });
        });
    </script>
@endsection
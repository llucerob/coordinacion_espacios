@extends('layout.master')
@section('title', 'Editar Actividad')

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
                <div class="col-sm-6"><h3>Editar Actividad</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Actividades</li>
                        <li class="breadcrumb-item active">Editar</li>
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
                        <h5 class="mb-0 text-white"><i class="fa fa-pencil-square-o me-2"></i> Editar Actividad</h5>
                        <small class="text-light opacity-75">Modifique los datos necesarios.</small>
                    </div>

                    <div class="card-body p-5">
                        @if(session('error'))
                            <div class="alert alert-danger inverse alert-dismissible fade show" role="alert">
                                <i class="icon-alert"></i> <p>{{ session('error') }}</p>
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('actividades.update', $actividad->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Nombre</label>
                                    <input class="form-control" name="nombre" type="text" value="{{ $actividad->nombre }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Recinto</label>
                                    <select class="form-select" name="recinto_id" required>
                                        @foreach($recintos as $recinto)
                                            <option value="{{ $recinto->id }}" {{ $actividad->recinto_id == $recinto->id ? 'selected' : '' }}>
                                                {{ $recinto->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label class="form-label">Materiales</label>
                                    <select class="form-select select2-materiales" name="materiales_seleccionados[]" multiple="multiple" style="width: 100%" id="select-materiales">
                                        @foreach($materiales as $material)
                                            @php
                                                $enUso = $actividad->materiales->find($material->id);
                                                $stockReal = $material->cantidad + ($enUso ? $enUso->pivot->cantidad : 0);
                                            @endphp
                                            <option value="{{ $material->id }}" 
                                                data-stock="{{ $stockReal }}" 
                                                {{ $enUso ? 'selected' : '' }}>
                                                {{ $material->nombre }} (Stock Max: {{ $stockReal }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="contenedor-cantidades" class="mb-4">
                                @foreach($actividad->materiales as $mat)
                                    <div class="cantidad-item d-flex justify-content-between align-items-center" id="box-{{ $mat->id }}">
                                        <span><strong>{{ $mat->nombre }}</strong></span>
                                        <div class="input-group" style="width: 200px;">
                                            <span class="input-group-text">Cant.</span>
                                            <input type="number" 
                                                   name="cantidades[{{ $mat->id }}]" 
                                                   class="form-control" 
                                                   value="{{ $mat->pivot->cantidad }}"
                                                   min="1" 
                                                   max="{{ $mat->cantidad + $mat->pivot->cantidad }}" 
                                                   required>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="mb-4" style="opacity: 0.1">

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Inicio</label>
                                    <input class="form-control" type="date" name="f_inicio" value="{{ $actividad->f_inicio }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Fin</label>
                                    <input class="form-control" type="date" name="f_fin" value="{{ $actividad->f_fin }}" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Hora Inicio</label>
                                    <input class="form-control" type="time" name="hora_inicio" value="{{ $actividad->hora_inicio }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Hora Fin</label>
                                    <input class="form-control" type="time" name="hora_fin" value="{{ $actividad->hora_fin }}" required>
                                </div>
                            </div>

                            <div class="card-footer border-0 bg-transparent text-end p-0 mt-5">
                                <a href="{{ route('actividades.index') }}" class="btn btn-light px-4 me-2">Cancelar</a>
                                <button class="btn btn-primary px-4" type="submit">Actualizar Actividad</button>
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
            var $select = $('#select-materiales');
            var $container = $('#contenedor-cantidades');

            $select.select2({
                placeholder: "Modificar materiales...",
                allowClear: true
            });

            $select.on('change', function() {
                var selectedData = $select.select2('data');
                var currentIds = selectedData.map(function(item) { return item.id; });

                $container.children('.cantidad-item').each(function() {
                    var id = $(this).attr('id').replace('box-', '');
                    if (!currentIds.includes(id)) {
                        $(this).remove();
                    }
                });

                selectedData.forEach(function(item) {
                    if ($('#box-' + item.id).length === 0) {
                        var stockMax = item.element.dataset.stock;
                        var html = `
                            <div class="cantidad-item d-flex justify-content-between align-items-center" id="box-${item.id}">
                                <span><strong>${item.text.split('(')[0]}</strong></span>
                                <div class="input-group" style="width: 200px;">
                                    <span class="input-group-text">Cant.</span>
                                    <input type="number" 
                                           name="cantidades[${item.id}]" 
                                           class="form-control" 
                                           min="1" 
                                           max="${stockMax}" 
                                           required 
                                           placeholder="Máx ${stockMax}">
                                </div>
                            </div>
                        `;
                        $container.append(html);
                    }
                });
            });
        });
    </script>
@endsection
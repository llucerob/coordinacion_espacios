@extends('layout.master')

@section('title', 'Programación de Actividades')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <style>
        #tabla-actividades { 
            font-size: 15px !important; 
            width: 100% !important; 
        }
        #tabla-actividades th, #tabla-actividades td { 
            padding: 10px 12px !important; 
            vertical-align: middle !important; 
        }
        #tabla-actividades thead th { 
            background-color: #f8f9fa; 
            border-bottom: 2px solid #dee2e6;
            font-weight: 700;
        }
        .btn-grande { 
            padding: 6px 12px !important; 
            font-size: 14px !important; 
            border-radius: 6px !important; 
            margin-right: 5px; 
        }
        .form-eliminar { display: inline-block; margin: 0; }
        .badge { 
            font-size: 13px !important; 
            padding: 6px 10px !important; 
            margin-right: 4px; 
            margin-bottom: 4px; 
            display: inline-block; 
            font-weight: 500;
        }
        .filter-card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Programación de Actividades</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Actividades</li>
    <li class="breadcrumb-item active">Ver</li>
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            
            <div class="card mb-4">
                <div class="card-body" style="background-color: #fcfcfc;">
                    <form action="{{ route('actividades.index') }}" method="GET">
                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Filtrar por Recinto</label>
                                <select name="recinto_id" class="form-select">
                                    <option value="">Todos los recintos</option>
                                    @foreach($recintos as $r)
                                        <option value="{{ $r->id }}" {{ request('recinto_id') == $r->id ? 'selected' : '' }}>
                                            {{ $r->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Fecha Desde</label>
                                <input type="date" name="fecha_desde" class="form-control" value="{{ request('fecha_desde') }}">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label fw-bold">Fecha Hasta</label>
                                <input type="date" name="fecha_hasta" class="form-control" value="{{ request('fecha_hasta') }}">
                            </div>

                            <div class="col-md-3">
                                <div class="d-grid gap-2 d-md-block">
                                    <button type="submit" class="btn btn-primary w-100 mb-2">
                                        <i class="fa fa-filter"></i> Filtrar
                                    </button>
                                    @if(request()->anyFilled(['recinto_id', 'fecha_desde', 'fecha_hasta']))
                                        <a href="{{ route('actividades.index') }}" class="btn btn-outline-secondary w-100">
                                            Limpiar Filtros
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Lista de Actividades</h5>
                    <a href="{{ route('actividad.agendar') }}" class="btn btn-primary">Nueva Actividad</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-striped" id="tabla-actividades">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Horario</th>
                                    <th>Actividad</th>
                                    <th>Recinto</th>
                                    <th>Materiales (Cant.)</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($actividades as $a)
                                <tr>
                                    <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($a->f_inicio)->format('d/m/Y') }}</td>
                                    <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($a->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($a->hora_fin)->format('H:i') }}</td>
                                    <td><strong>{{ $a->nombre }}</strong></td>
                                    
                                    <td>
                                        @if($a->recinto)
                                            <span class="badge badge-info">{{ $a->recinto->nombre }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @forelse($a->materiales as $material)
                                            @php
                                                $cantidad = $material->pivot->cantidad;
                                                $unidad = $material->unidad_medida;
                                                if($cantidad > 1) {
                                                    if(strtolower($unidad) == 'unidad') {
                                                        $unidad .= 'es';
                                                    } elseif(in_array(strtolower(substr($unidad, -1)), ['a','e','i','o','u'])) {
                                                        $unidad .= 's';
                                                    }
                                                }
                                            @endphp
                                            
                                            <span class="badge badge-primary">
                                                {{ $material->nombre }} ({{ $cantidad }} {{ $unidad }})
                                            </span>
                                        @empty
                                            <span class="text-muted">-</span>
                                        @endforelse
                                    </td>

                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('actividades.edit', $a->id) }}" class="btn btn-primary btn-grande">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <form action="{{ route('actividades.destroy', $a->id) }}" method="POST" class="form-eliminar">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-grande" onclick="return confirm('¿Borrar? Esto devolverá el stock al inventario.')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#tabla-actividades').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json' },
                responsive: true,
                searching: false
            });
        });
    </script>
@endsection
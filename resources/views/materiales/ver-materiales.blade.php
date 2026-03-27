@extends('layout.master')

@section('title', 'Inventario de Materiales')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <style>
        #tabla-materiales { font-size: 15px !important; width: 100% !important; }
        #tabla-materiales th, #tabla-materiales td { padding: 10px 12px !important; vertical-align: middle !important; }
        #tabla-materiales thead th { background-color: #f8f9fa; border-bottom: 2px solid #dee2e6; font-weight: 700; }
        .btn-grande { padding: 6px 12px !important; font-size: 14px !important; border-radius: 6px !important; margin-right: 5px; }
        .form-eliminar { display: inline-block; margin: 0; }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Inventario de Materiales</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Materiales</li>
    <li class="breadcrumb-item active">Ver</li>
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Lista de Materiales</h5>
                    <a href="{{ route('material.create') }}" class="btn btn-primary">Nuevo Material</a>
                </div>
                <div class="card-body">
                    
                    @if (session('success'))
                        <div class="alert alert-success inverse alert-dismissible fade show" role="alert">
                            <i class="icon-thumb-up"></i>
                            <p><b>¡Listo!</b> {{ session('success') }}</p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="display table table-striped" id="tabla-materiales">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del Material</th>
                                    <th>Stock Disponible</th>
                                    <th>Unidad de Medida</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                        
                                @foreach ($materiales as $m)
                                <tr>
                                    <td>{{ $m->id }}</td>
                                    <td><strong>{{ $m->nombre }}</strong></td>
                                    
                                    <td>
                                        @if($m->cantidad > 10)
                                            <span class="badge badge-success" style="font-size: 14px">{{ $m->cantidad }}</span>
                                        @elseif($m->cantidad > 0)
                                            <span class="badge badge-warning" style="font-size: 14px">{{ $m->cantidad }}</span>
                                        @else
                                            <span class="badge badge-danger" style="font-size: 14px">Agotado</span>
                                        @endif
                                    </td>

                                    <td>{{ $m->unidad_medida }}</td>

                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('materiales.edit', $m->id) }}" class="btn btn-primary btn-grande">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <form action="{{ route('materiales.destroy', $m->id) }}" method="POST" class="form-eliminar">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-grande" onclick="return confirm('¿Seguro que desea eliminar este material?')">
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
            $('#tabla-materiales').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json' },
                responsive: true
            });
        });
    </script>
@endsection
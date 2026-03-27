@extends('layout.master')

@section('title', 'Gestión de Recintos')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <style>
        #tabla-recintos { 
            font-size: 14px !important; 
            width: 100% !important; 
        }
        
        #tabla-recintos th, #tabla-recintos td { 
            padding: 12px !important; 
            vertical-align: middle !important; 
        }

        #tabla-recintos thead th { 
            background-color: #f8f9fa; 
            border-bottom: 2px solid #dee2e6;
            font-weight: 700;
            text-transform: uppercase;
        }
        
        .btn-grande { 
            padding: 8px 16px !important; 
            font-size: 16px !important; 
            border-radius: 8px !important; 
            margin-right: 5px; 
        }
        
        .form-eliminar { display: inline-block; margin: 0; }
    </style>
@endsection

@section('breadcrumb-title')
    <h3>Gestión de Recintos</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Recintos</li>
    <li class="breadcrumb-item active">Listar</li>
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Listado de Recintos</h5>
                    <a href="{{ route('recinto.create') }}" class="btn btn-primary btn-lg">Nuevo Recinto</a>
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
                        <table class="display table table-striped" id="tabla-recintos">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">ID</th>
                                    <th style="width: 70%;">Nombre del Recinto</th>
                                    <th style="width: 20%;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recintos as $r)
                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td><strong>{{ $r->nombre }}</strong></td>

                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('recintos.edit', $r->id) }}" class="btn btn-primary btn-grande">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <form action="{{ route('recintos.destroy', $r->id) }}" method="POST" class="form-eliminar">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-grande" onclick="return confirm('¿Seguro que desea eliminar este recinto?')">
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
            $('#tabla-recintos').DataTable({
                language: { url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json' },
                responsive: true,
                autoWidth: false
            });
        });
    </script>
@endsection
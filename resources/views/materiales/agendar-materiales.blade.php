@extends('layout.master')

@section('title', 'Asignar Material')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Asignar material</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Materiales</li>
    <li class="breadcrumb-item active">Asignar</li>
@endsection

@section('main_content')
<div class="container-fluid">
    <div class="row starter-main">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Asignar material a actividad</h3>
                </div>
                
                <div class="card-body pb-0">
                    @if (session('swal_success'))
                        <div class="alert alert-success inverse alert-dismissible fade show" role="alert">
                            <i class="icon-thumb-up"></i>
                            <p><b>¡Excelente!</b> {{ session('swal_success') }}</p>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger inverse alert-dismissible fade show" role="alert">
                            <i class="icon-thumb-down"></i>
                            <p><b>¡Atención!</b> Revisa los siguientes errores:</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>

                <form action="{{ route('materiales.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="inputMaterial">Material</label>
                                    <input class="form-control" list="listaMateriales" id="inputMaterial" name="material_nombre" placeholder="Escribe o selecciona..." required autocomplete="off">
                                    <datalist id="listaMateriales">
                                        @foreach ($materiales as $m)
                                            <option value="{{$m->nombre}}">
                                        @endforeach
                                    </datalist>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="unidad_medida">Unidad de Medida (Opcional)</label>
                                    <input class="form-control" id="unidad_medida" name="unidad_medida" type="text" placeholder="Metros, Litros, dejar vacío si son Unidades">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label" for="cantidad">Cantidad</label>
                                    <input class="form-control" id="cantidad" name="cantidad" type="number" placeholder="Ej: 5" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="SelectActividad">Actividad</label>
                                    <select name="actividad_id" id="SelectActividad" class="form-control" required>
                                        <option value="" disabled selected>Seleccione actividad...</option>
                                        @foreach ($actividades as $a)
                                            <option value="{{$a->id}}">{{$a->nombre}}</option>    
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="SelectDepartamento">Departamento</label>
                                    <select name="departamento_id" id="SelectDepartamento" class="form-control" required>
                                        <option value="" disabled selected>Seleccione departamento...</option>
                                        @foreach ($departamentos as $d)
                                            <option value="{{$d->id}}">{{$d->nombre}}</option>    
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="descripcion">Descripción (Opcional)</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="1" placeholder="Detalles..."></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <a href="{{ url()->previous() }}" class="btn btn-light">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @if(session('swal_success'))
        <script>
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Operación Exitosa!',
                    text: "{{ session('swal_success') }}",
                    confirmButtonColor: '#7366ff'
                });
            }
        </script>
    @endif
@endsection
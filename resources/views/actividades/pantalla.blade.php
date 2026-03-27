<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="300"> 
    <title>Cartelera de Actividades - Municipalidad de Coinco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; color: #333; }
        
        .header-title { background-color: #0a3d62; color: white; padding: 50px; text-align: center; border-radius: 0 0 30px 30px; margin-bottom: 50px; box-shadow: 0 10px 25px rgba(10, 61, 98, 0.2); border-bottom: 5px solid #f39c12; }
        
        h1 { font-weight: 900; font-size: 3.8rem; margin: 0; letter-spacing: 2px; text-transform: uppercase; display: flex; align-items: center; justify-content: center; gap: 20px; }
        
        .logo-muni { height: 80px; width: auto; object-fit: contain; }

        .table-container { background: white; border-radius: 25px; padding: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.06); margin: 0 50px 50px 50px; border: 1px solid #e1e8ed; }
        
        table { font-size: 2rem; }
        
        th { background-color: #f8f9fa !important; color: #0a3d62; font-weight: 800; text-transform: uppercase; padding: 30px !important; border-bottom: 4px solid #e9ecef !important; border-top: 5px solid #f39c12 !important; }
        
        td { padding: 30px !important; vertical-align: middle; border-bottom: 1px solid #f1f1f1; }
        
        .fecha-text { font-weight: 600; color: #6c757d; }
        
        .actividad-nombre { font-weight: 800; color: #0a3d62; font-size: 2.5rem; text-transform: uppercase; }
        
        .badge-recinto { background-color: #f39c12; color: white; padding: 15px 30px; border-radius: 50px; font-size: 1.7rem; font-weight: 700; box-shadow: 0 6px 12px rgba(243, 156, 18, 0.25); text-transform: none; display: inline-block; }
    </style>
</head>
<body>

    <div class="header-title">
        <h1>
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo Municipalidad" class="logo-muni">
            CARTELERA DE ACTIVIDADES
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo Municipalidad" class="logo-muni">

        </h1>
    </div>
    
    <div class="table-container">
        <table class="table table-hover table-borderless">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Horario</th>
                    <th>Actividad</th>
                    <th>Lugar / Recinto</th>
                </tr>
            </thead>
            <tbody>
                @forelse($actividades as $a)
                    <tr>
                        <td class="fecha-text">{{ \Carbon\Carbon::parse($a->f_inicio)->format('d/m/Y') }}</td>
                        <td><strong>{{ \Carbon\Carbon::parse($a->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($a->hora_fin)->format('H:i') }}</strong></td>
                        <td class="actividad-nombre">{{ $a->nombre }}</td>
                        <td>
                            @if($a->recinto)
                                <span class="badge-recinto">{{ $a->recinto->nombre }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                            
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5" style="font-size: 2.5rem; color: #a9a9a9; font-weight: 600;">
                            No hay actividades programadas próximamente en Coinco.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>
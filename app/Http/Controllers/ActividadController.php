<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Recinto;
use App\Models\Material;
use Illuminate\Support\Facades\DB;

class ActividadController extends Controller
{
    public function index(Request $request)
    {
        $query = Actividad::with(['recinto', 'materiales']);

        if ($request->filled('recinto_id')) {
            $query->where('recinto_id', $request->recinto_id);
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('f_inicio', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('f_inicio', '<=', $request->fecha_hasta);
        }

        $actividades = $query->orderBy('f_inicio', 'asc')->get();
        $recintos = Recinto::all();

        return view('actividades.ver-actividades', compact('actividades', 'recintos'));
    }

    public function create()
    {
        $recintos = Recinto::all();
        $materiales = Material::where('cantidad', '>', 0)->get();
        return view('actividades.agendar-actividad', compact('recintos', 'materiales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'f_inicio' => 'required',
            'f_fin' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'recinto_id' => 'required',
        ]);

        $choque = Actividad::where('recinto_id', $request->recinto_id)
            ->where('f_inicio', $request->f_inicio)
            ->where(function ($query) use ($request) {
                $query->where('hora_inicio', '<', $request->hora_fin)
                      ->where('hora_fin', '>', $request->hora_inicio);
            })
            ->first();

        if ($choque) {
            return redirect()->back()
                ->withInput()
                ->with('error_horario', 'Ya existe la activiadad "' . $choque->nombre . '" que es desde las ' . $choque->hora_inicio . ' hasta las ' . $choque->hora_fin . '.');
        } 


        try {
            DB::beginTransaction();

            $actividad = Actividad::create($request->all());

            if ($request->has('materiales_seleccionados')) {
                foreach ($request->materiales_seleccionados as $material_id) {
                    $cantidad = $request->cantidades[$material_id];
                    $material = Material::lockForUpdate()->find($material_id);

                    if ($material->cantidad < $cantidad) {
                        DB::rollBack();
                        return back()->with('error', "Stock insuficiente para {$material->nombre}. Disponibles: {$material->cantidad}")->withInput();
                    }

                    $material->decrement('cantidad', $cantidad);
                    $actividad->materiales()->attach($material_id, ['cantidad' => $cantidad]);
                }
            }

            DB::commit();
            return redirect()->route('actividades.index')->with('success', 'Actividad agendada con éxito.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $actividad = Actividad::with('materiales')->findOrFail($id);
        $recintos = Recinto::all();
        $materiales = Material::all();
        
        return view('actividades.editar-actividad', compact('actividad', 'recintos', 'materiales'));
    }

    public function update(Request $request, $id)
    {
        $actividad = Actividad::with('materiales')->findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'f_inicio' => 'required',
            'f_fin' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'recinto_id' => 'required',
        ]);

        $choque = Actividad::where('recinto_id', $request->recinto_id)
            ->where('f_inicio', $request->f_inicio)
            ->where('id', '!=', $id)
            ->where(function ($query) use ($request) {
                $query->where('hora_inicio', '<', $request->hora_fin)
                      ->where('hora_fin', '>', $request->hora_inicio);
            })
            ->first();

         if ($choque) {
            return redirect()->back()
                ->withInput()
                ->with('error_horario', 'Ya existe la activiadad "' . $choque->nombre . '" que es desde las ' . $choque->hora_inicio . ' hasta las ' . $choque->hora_fin . '.');
        }

        try {
            DB::beginTransaction();

            foreach ($actividad->materiales as $material) {
                $material->increment('cantidad', $material->pivot->cantidad);
            }
            $actividad->materiales()->detach();

            $actividad->update($request->except(['materiales_seleccionados', 'cantidades']));

            if ($request->has('materiales_seleccionados')) {
                foreach ($request->materiales_seleccionados as $material_id) {
                    $cantidad = $request->cantidades[$material_id];
                    $material = Material::lockForUpdate()->find($material_id);

                    if ($material->cantidad < $cantidad) {
                        DB::rollBack();
                        return back()->with('error', "Stock insuficiente para {$material->nombre}. Disponibles: {$material->cantidad}")->withInput();
                    }

                    $material->decrement('cantidad', $cantidad);
                    $actividad->materiales()->attach($material_id, ['cantidad' => $cantidad]);
                }
            }

            DB::commit();
            return redirect()->route('actividades.index')->with('success', 'Actividad actualizada con éxito.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al actualizar: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $actividad = Actividad::with('materiales')->findOrFail($id);
        
        foreach ($actividad->materiales as $material) {
            $material->increment('cantidad', $material->pivot->cantidad);
        }

        $actividad->delete();
        return back()->with('success', 'Actividad eliminada correctamente.');
    }

    public function pantalla()
    {
      
        $actividades = Actividad::with('recinto')
            ->whereDate('f_inicio', '>=', now()->toDateString())
            ->orderBy('f_inicio', 'asc')
            ->orderBy('hora_inicio', 'asc')
            ->get();

        return view('actividades.pantalla', compact('actividades'));
    }

}
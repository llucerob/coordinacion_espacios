<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Departamento;
use App\Models\Actividad;
use App\Models\AgendaMaterial;

class MaterialesController extends Controller
{
    public function index()
    {
        $materiales = Material::with('departamento')->get();
        return view('materiales.ver-materiales', compact('materiales'));
    }

    public function create()
    {
        $materiales = Material::all();
        $actividades = Actividad::all();
        $departamentos = Departamento::all();
        return view('materiales.agendar-materiales', compact('materiales', 'actividades', 'departamentos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_nombre' => 'required|string|max:255',
            'actividad_id' => 'required|exists:actividades,id',
            'cantidad' => 'nullable|integer',
            'departamento_id' => 'required|exists:departamentos,id'
        ]);

        $material = Material::firstOrCreate(
            ['nombre' => $request->material_nombre],
            [
                'cantidad' => $request->cantidad ?? 0,
                'unidad_medida' => $request->unidad_medida ?? 'Unidad',
                'descripcion' => $request->descripcion,
                'departamento_id' => $request->departamento_id
            ]
        );

        AgendaMaterial::create([
            'material_id' => $material->id,
            'actividad_id' => $request->actividad_id,
            'cantidad' => $request->cantidad
        ]);

        return back()->with('swal_success', 'Material asignado correctamente.');
    }

    

    public function edit($id)
    {
        $material = Material::findOrFail($id);
        $departamentos = Departamento::all();
        return view('materiales.editar-materiales', compact('material', 'departamentos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad_medida' => 'nullable|string',
            'cantidad' => 'required|integer',
            'departamento_id' => 'required|exists:departamentos,id'
        ]);

        $material = Material::findOrFail($id);
        $material->update([
            'nombre' => $request->nombre,
            'unidad_medida' => $request->unidad_medida,
            'cantidad' => $request->cantidad,
            'descripcion' => $request->descripcion,
            'departamento_id' => $request->departamento_id
        ]);

        return redirect()->route('materiales.index')->with('swal_success', 'Material actualizado correctamente.');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()->route('materiales.index')->with('swal_success', 'Material eliminado correctamente.');
    }
}
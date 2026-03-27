<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recinto;
use App\Models\Departamento;

class RecintoController extends Controller
{
    public function index()
    {
        $recintos = Recinto::all();
        return view('recintos.ver-recintos', compact('recintos'));
    }

    public function create()
    {
        $categorias = Departamento::all();
        return view('recintos.crear-recintos', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'h_apertura' => 'nullable',
            'h_cierre' => 'nullable',
        ]);

        Recinto::create($request->all());

        return redirect()->route('recintos.index');
    }

    public function edit($id)
    {
        $recinto = Recinto::findOrFail($id);
        return view('recintos.editar-recinto', compact('recinto'));
    }
    
    public function update(Request $request, $id)
    {
        $recinto = Recinto::findOrFail($id);
        $recinto->update($request->all());
        return redirect()->route('recintos.index');
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       

    public function destroy($id)
    {
        $recinto = Recinto::findOrFail($id);
        $recinto->delete();
        return back();
    }
}
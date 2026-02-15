<?php

namespace App\Http\Controllers;

use App\Models\Experiencia;
use App\Models\Habilidade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Environment\Console;

class HabilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = User::with(['habilidades'])->findOrFail(Auth::id());
        $habilidadEdit = null;
        // Vemos si nos llega un request de editar con el id, si es asi la pasamos para que se pueda editar
        if ($request->has('edit')) {
            $habilidadEdit = $user->habilidades->find($request->edit);
        }

        return view('habilidades.index', compact('user', 'habilidadEdit'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $data = $request->validate([
            'nombre_habilidad' => 'required|string|max:255',
            'nivel' => 'required|integer|min:1|max:5'
        ]);

        $user->habilidades()->create($data);
        return redirect()->back()->with('success', 'Habilidad añadida');
    }

    /**
     * Display the specified resource.
     */
    public function show(Habilidade $habilidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Habilidade $habilidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    //* OJO * El nombre de la variable DEBE ser $habilidade coincidiendo con la ruta o si no no va, al ejecutar route:list lo indica.
    public function update(Request $request, Habilidade $habilidade)
    {
        $data = $request->validate([
            'nombre_habilidad' => 'required|string|max:255',
            'nivel' => 'required|integer|min:1|max:5'
        ]);

        $habilidade->update($data);
        return redirect()->back()->with('success', 'Habilidad actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    // El nombre de la variable DEBE ser $habilidad coincidiendo con la ruta o si no no va
    public function destroy(Habilidade $habilidade)
    {
        $habilidade->delete();
        return back()->with('delete', 'Habilidad eliminada');
    }
}

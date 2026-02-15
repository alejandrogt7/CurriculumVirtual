<?php

namespace App\Http\Controllers;

use App\Models\Experiencia;
use App\Models\Habilidade;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Environment\Console;

class   ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = User::with(['proyectos'])->findOrFail(Auth::id());
        $proyectoEdit = null;
        // Vemos si nos llega un request de editar con el id, si es asi la pasamos para que se pueda editar
        if ($request->has('edit')) {
            $proyectoEdit = $user->proyectos->find($request->edit);
        }

        return view('proyectos.index', compact('user', 'proyectoEdit'));
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
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'enlace_proyecto' => 'nullable|url|max:255'
        ]);

        $user->proyectos()->create($data);
        return redirect()->back()->with('success', 'Proyecto añadido');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    //* OJO * El nombre de la variable DEBE ser $proyecto coincidiendo con la ruta o si no no va, al ejecutar route:list lo indica.
    public function update(Request $request, Proyecto $proyecto)
    {
        $data = $request->validate([
            'nombre_habilidad' => 'required|string|max:255',
            'nivel' => 'required|integer|min:1|max:5'
        ]);

        $proyecto->update($data);
        return redirect()->back()->with('success', 'Proyecto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    // El nombre de la variable DEBE ser $proyecto coincidiendo con la ruta o si no no va
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        return back()->with('delete', 'Proyecto eliminado');
    }   
}

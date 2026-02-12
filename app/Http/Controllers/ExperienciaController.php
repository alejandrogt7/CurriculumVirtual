<?php

namespace App\Http\Controllers;

use App\Models\Experiencia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

class ExperienciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with(['experiencias'])->findOrFail(Auth::id());
        // Esto busca: resources/views/experiencialaboral/index.blade.php
        return view('experiencialaboral.index', compact('user'));
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
            'empresa' => 'required|string|max:255',
            'puesto' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'descripcion' => 'required|string|max:255'
        ]);

        $user->experiencias()->create($data);
        return redirect()->back()->with('success', 'Experiencia añadida');
    }

    /**
     * Display the specified resource.
     */
    public function show(Experiencia $experiencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experiencia $experiencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experiencia $experiencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // El nombre de la variable DEBE ser $experiencialaboral coincidiendo con la ruta o si no no va
    public function destroy(Experiencia $experiencialaboral)
    {
        $experiencialaboral->delete();
        return back()->with('delete', 'Experiencia eliminada');
    }
}

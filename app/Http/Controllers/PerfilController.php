<?php

namespace App\Http\Controllers;

use App\Models\Perfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $user = User::with(['perfil'])->findOrFail(Auth::id());
        $perfilEdit = null;

        if ($request->has('edit') && $user->perfil) {
            $perfilEdit = $user->perfil;
        }

        return view('perfil.index', compact('user', 'perfilEdit'));
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
            'nombre_completo' => 'required|string|max:255',
            'correo_electronico' => 'required|email|max:255', // Email público del perfil
            'profesion'       => 'required|string|max:255',
            'sobre_mi'        => 'required|string',
            'telefono'        => 'nullable|string|max:20',
            'linkedin'        => 'nullable|url',
            'github'          => 'nullable|url',
        ]);

        $user->perfil()->create($data);

        return back()->with('success', 'Perfil creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $relacionesCV = ['perfil', 'educaciones', 'experiencias', 'habilidades', 'proyectos'];
        $user = User::with($relacionesCV)->findOrFail($id);
        return view('busquedaperfiles.index', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perfile $perfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perfile $perfil)
    {
        $data = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'correo_electronico' => 'required|email|max:255',
            'profesion'       => 'required|string|max:255',
            'sobre_mi'        => 'required|string',
            'telefono'        => 'nullable|string|max:20',
            'linkedin'        => 'nullable|url',
            'github'          => 'nullable|url',
        ]);

        $perfil->update($data);

        return back()->with('success', 'Perfil actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perfile $perfil)
    {
        $perfil->delete();
        return back()->with('delete', 'Perfil eliminado');
    }
}

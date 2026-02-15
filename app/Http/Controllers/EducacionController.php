<?php

namespace App\Http\Controllers;

use App\Models\Educacione; // O Educacion, según tu archivo
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;

class EducacionController extends Controller
{
    public function index(Request $request)
    {
        $user = User::with(['educaciones'])->findOrFail(Auth::id());
        $eduEdit = null;

        // Si viene ?edit_edu=ID, buscamos esa formación para el formulario
        if ($request->has('edit_edu')) {
            $eduEdit = $user->educaciones->find($request->edit_edu);
        }

        return view('educacion.index', compact('user', 'eduEdit'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo_obtenido' => 'required|string|max:255',
            'institucion' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
        ]);

        $user = User::findOrFail(Auth::id());
        $user->educaciones()->create($data);
        return back()->with('success', 'Formación añadida correctamente');
    }

    public function update(Request $request, Educacione $educacion)
    {
        $data = $request->validate([
            'titulo_obtenido' => 'required|string|max:255',
            'institucion' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'descripcion' => 'nullable|string',
        ]);

        $educacion->update($data);
        return redirect()->route('educacion.index')->with('success', 'Formación actualizada');
    }

    public function destroy(Educacione $educacion)
    {
        $educacion->delete();
        return back()->with('delete', 'Formación eliminada');
    }
}
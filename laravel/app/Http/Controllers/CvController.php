<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experiencia;
use App\Models\Formacion;
use App\Models\Idioma;
use App\Models\DatoExtra;

class CvController extends Controller
{
    public function addExperiencia(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string',
            'compania' => 'required|string',
            'inicio_mes' => 'required|integer',
            'inicio_ano' => 'required|integer',
            'fin_mes' => 'nullable|integer',
            'fin_ano' => 'nullable|integer',
            'ciudad' => 'required|string',
            'pais' => 'required|string',
        ]);
        $validated['user_id'] = $request->user()->id;
        $exp = Experiencia::create($validated);
        return response()->json($exp, 201);
    }
    public function updateExperiencia(Request $request, $id)
    {
        $exp = Experiencia::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $validated = $request->validate([
            'titulo' => 'sometimes|required|string',
            'compania' => 'sometimes|required|string',
            'inicio_mes' => 'sometimes|required|integer',
            'inicio_ano' => 'sometimes|required|integer',
            'fin_mes' => 'nullable|integer',
            'fin_ano' => 'nullable|integer',
            'ciudad' => 'sometimes|required|string',
            'pais' => 'sometimes|required|string',
        ]);
        $exp->update($validated);
        return response()->json($exp);
    }
    public function deleteExperiencia($id)
    {
        $exp = Experiencia::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $exp->delete();
        return response()->json(['message' => 'Eliminado']);
    }

    public function addFormacion(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string',
            'institucion' => 'required|string',
            'inicio_mes' => 'required|integer',
            'inicio_ano' => 'required|integer',
            'fin_mes' => 'nullable|integer',
            'fin_ano' => 'nullable|integer',
        ]);
        $validated['user_id'] = $request->user()->id;
        $form = Formacion::create($validated);
        return response()->json($form, 201);
    }
    public function updateFormacion(Request $request, $id)
    {
        $form = Formacion::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $validated = $request->validate([
            'titulo' => 'sometimes|required|string',
            'institucion' => 'sometimes|required|string',
            'inicio_mes' => 'sometimes|required|integer',
            'inicio_ano' => 'sometimes|required|integer',
            'fin_mes' => 'nullable|integer',
            'fin_ano' => 'nullable|integer',
        ]);
        $form->update($validated);
        return response()->json($form);
    }
    public function deleteFormacion($id)
    {
        $form = Formacion::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $form->delete();
        return response()->json(['message' => 'Eliminado']);
    }

    // IDIOMAS
    public function addIdioma(Request $request)
    {
        $validated = $request->validate([
            'idioma' => 'required|string',
            'nivel' => 'required|string',
        ]);
        $validated['user_id'] = $request->user()->id;
        $idioma = Idioma::create($validated);
        return response()->json($idioma, 201);
    }
    public function updateIdioma(Request $request, $id)
    {
        $idioma = Idioma::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $validated = $request->validate([
            'idioma' => 'sometimes|required|string',
            'nivel' => 'sometimes|required|string',
        ]);
        $idioma->update($validated);
        return response()->json($idioma);
    }
    public function deleteIdioma($id)
    {
        $idioma = Idioma::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $idioma->delete();
        return response()->json(['message' => 'Eliminado']);
    }

    // DATOS EXTRA
    public function addDatoExtra(Request $request)
    {
        $validated = $request->validate([
            'tipo' => 'required|string',
            'valor' => 'required|string',
        ]);
        $validated['user_id'] = $request->user()->id;
        $dato = DatoExtra::create($validated);
        return response()->json($dato, 201);
    }
    public function updateDatoExtra(Request $request, $id)
    {
        $dato = DatoExtra::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
        $validated = $request->validate([
            'tipo' => 'sometimes|required|string',
            'valor' => 'sometimes|required|string',
        ]);
        $dato->update($validated);
        return response()->json($dato);
    }
    public function deleteDatoExtra($id)
    {
        $dato = DatoExtra::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $dato->delete();
        return response()->json(['message' => 'Eliminado']);
    }
}

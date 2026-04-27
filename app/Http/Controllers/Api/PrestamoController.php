<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index()
    {
        return response()->json(Autor::all(), 200);
    }

    public function store(Request $request)
    {
        $autor = Autor::create($request->all());
        return response()->json($autor, 201);
    }

    public function show($id)
    {
        $autor = Autor::find($id);
        if (!$autor) return response()->json(['error' => 'No encontrado'], 404);
        return response()->json($autor, 200);
    }

    public function update(Request $request, $id)
    {
        $autor = Autor::find($id);
        if (!$autor) return response()->json(['error' => 'No encontrado'], 404);
        $autor->update($request->all());
        return response()->json($autor, 200);
    }

    public function destroy($id)
    {
        $autor = Autor::find($id);
        if (!$autor) return response()->json(['error' => 'No encontrado'], 404);
        $autor->delete();
        return response()->json(['message' => 'Eliminado'], 200);
    }
}
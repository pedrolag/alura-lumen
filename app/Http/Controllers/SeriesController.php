<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        return Serie::all();
    }

    public function show(int $id)
    {
        $serie = Serie::find($id);

        // Caso não encontre a série
        if (is_null($serie)) {
            return response()->json([
                'error' => 'Recurso não encontrado.',
                'code' => 404
            ]);
        }

        return response()->json(
            Serie::find($id),
            201
        );
    }

    public function store(Request $request)
    {
        return response()->json(
            Serie::create($request->all()),
            201
        );
    }

    public function update(int $id, Request $request)
    {
        $serie = Serie::find($id);

        // Caso não encontre a série
        if (is_null($serie)) {
            return response()->json([
                'error' => 'Recurso não encontrado.',
                'code' => 404
            ]);
        }

        // Atualizar a série
        $serie->fill($request->all());
        $serie->save();

        return response()->json(
            $serie,
            201
        );
    }

    
    public function destroy(int $id)
    {
        $quantidadeDeRecursosRemovidos = Serie::destroy($id);

        // Caso não encontre a série
        if ($quantidadeDeRecursosRemovidos === 0) {
            return response()->json([
                'error' => 'Recurso não encontrado.',
                'code' => 404
            ]);
        }

        return response()->json('', 204);
    }
}

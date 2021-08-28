<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index()
    {
        return Episodio::all();
    }

    public function show(int $id)
    {
        $episodio = Episodio::find($id);

        // Caso não encontre o episódio
        if (is_null($episodio)) {
            return response()->json([
                'error' => 'Recurso não encontrado.',
                'code' => 404
            ]);
        }

        return response()->json(
            Episodio::find($id),
            201
        );
    }

    public function store(Request $request)
    {
        return response()->json(
            Episodio::create($request->all()),
            201
        );
    }

    public function update(int $id, Request $request)
    {
        $episodio = Episodio::find($id);

        // Caso não encontre o episódio
        if (is_null($episodio)) {
            return response()->json([
                'error' => 'Recurso não encontrado.',
                'code' => 404
            ]);
        }

        // Atualizar a episódio
        $episodio->fill($request->all());
        $episodio->save();

        return response()->json(
            $episodio,
            201
        );
    }

    
    public function destroy(int $id)
    {
        $quantidadeDeRecursosRemovidos = Episodio::destroy($id);

        // Caso não encontre o episódio
        if ($quantidadeDeRecursosRemovidos === 0) {
            return response()->json([
                'error' => 'Recurso não encontrado.',
                'code' => 404
            ]);
        }

        return response()->json('', 204);
    }
}

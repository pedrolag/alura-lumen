<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController
{
    protected $classe;

    public function index(Request $request)
    {
        // return $this->classe::all();
        // $offset = ($request->page - 1) * $request->per_page;
        // return $this->classe::query()
        //     ->offset($offset)
        //     ->limit($request->per_page)
        //     ->get();
        return $this->classe::paginate($request->per_page);
    }

    public function show(int $id)
    {
        $recurso = $this->classe::find($id);

        // Caso não encontre o recurso
        if (is_null($recurso)) {
            return response()->json([
                'error' => 'Recurso não encontrado.',
                'code' => 404
            ]);
        }

        return response()->json(
            $this->classe::find($id),
            201
        );
    }

    public function store(Request $request)
    {
        return response()->json(
            $this->classe::create($request->all()),
            201
        );
    }

    public function update(int $id, Request $request)
    {
        $recurso = $this->classe::find($id);

        // Caso não encontre o recurso
        if (is_null($recurso)) {
            return response()->json([
                'error' => 'Recurso não encontrado.',
                'code' => 404
            ]);
        }

        // Atualizar a recurso
        $recurso->fill($request->all());
        $recurso->save();

        return response()->json(
            $recurso,
            201
        );
    }

    
    public function destroy(int $id)
    {
        $quantidadeDeRecursosRemovidos = $this->classe::destroy($id);

        // Caso não encontre o recurso
        if ($quantidadeDeRecursosRemovidos === 0) {
            return response()->json([
                'error' => 'Recurso não encontrado.',
                'code' => 404
            ]);
        }

        return response()->json('', 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Marca::withCount('productos')->get(),
            'status' => 'success'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100|unique:marcas',
        ], [
            'nombre.required' => 'El nombre de la marca es obligatorio',
            'nombre.unique' => 'Esta marca ya existe'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 'error'
            ], 422);
        }

        $marca = Marca::create($request->all());

        return response()->json([
            'data' => $marca,
            'status' => 'success',
            'message' => 'Marca creada correctamente'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        return response()->json([
            'data' => $marca->load('productos'),
            'status' => 'success'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100|unique:marcas,nombre,'.$marca->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 'error'
            ], 422);
        }

        $marca->update($request->all());

        return response()->json([
            'data' => $marca,
            'status' => 'success',
            'message' => 'Marca actualizada correctamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        if ($marca->productos()->exists()) {
            return response()->json([
                'error' => 'No se puede eliminar: la marca tiene productos asociados',
                'status' => 'error'
            ], 409);
        }

        $marca->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Marca eliminada correctamente'
        ], 200);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Producto::query()->with('marca');

        // Filtro por marca_id si existe
        if ($request->has('marca_id')) {
            $query->where('marca_id', $request->marca_id);
        }

        return response()->json([
            'data' => $query->get(),
            'status' => 'success'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:200',
            'precio' => 'required|decimal:2|min:0.01',
            'marca_id' => 'required|exists:marcas,id'
        ], [
            'marca_id.exists' => 'La marca seleccionada no existe',
            'precio.min' => 'El precio mínimo es 0.01'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 'error'
            ], 422);
        }

        $producto = Producto::create($request->all());

        return response()->json([
            'data' => $producto->load('marca'),
            'status' => 'success',
            'message' => 'Producto creado correctamente'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return response()->json([
            'data' => $producto->load('marca'),
            'status' => 'success'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'sometimes|string|max:200',
            'precio' => 'sometimes|decimal:2|min:0.01',
            'marca_id' => 'sometimes|exists:marcas,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 'error'
            ], 422);
        }

        $producto->update($request->all());

        return response()->json([
            'data' => $producto->fresh('marca'),
            'status' => 'success',
            'message' => 'Producto actualizado correctamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Producto eliminado correctamente'
        ], 200);
    }
}
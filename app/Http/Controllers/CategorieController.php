<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Exception;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Categorie::all();
            return response() -> json($categories, 200);
        } catch (\Throwable $th) {
            response() -> json('Impossible To Fetch Categories', 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $categorie = new Categorie([
                'nomCategorie' => $request ->input('nomCategorie'),
                'imageCategorie' => $request ->input('imageCategorie')
            ]);
            $categorie -> save();
            return response() -> json($categorie, 200);
         } catch (Exception $e) {
            return response() -> json('Impossible to Store', 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $categorie = Categorie::findOrFail($id);
            return response()->json($categorie, 200);
        } catch(Exception $e) {
            return response() -> json($e -> getMessage(), $e -> getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $categorie = Categorie::findOrFail($id);
            $categorie -> update($request -> all());
            return response()->json($categorie, 200);
        } catch(Exception $e) {
            return response() -> json($e -> getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $categorie = Categorie::findOrFail($id);
            $categorie -> delete();
            return response() -> json("Categorie was deleted succesfully");
        } catch(Exception $e) {
            return response() -> json($e -> getMessage(), $e -> getCode());
        }
    }
}

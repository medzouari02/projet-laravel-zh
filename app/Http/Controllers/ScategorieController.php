<?php

namespace App\Http\Controllers;

use App\Models\Scategorie;
use Exception;
use Illuminate\Http\Request;

class ScategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* 
        * The relation attribute is the name of the function in the model class
        * It refers to the name of the relation, which is basically a function
        */ 
        try {
        $sCategories = sCategorie::with('categorie')->get();
        return response()-> json($sCategories);
        } catch(Exception $e) {
            return response() -> json($e -> getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $sCategory = new Scategorie([
                'nomScategorie' => $request -> input('nomScategorie'),
                'imageScategorie' => $request -> input('imagesScategorie'),
                'categorieID' => $request -> input('categorieID'),
            ]);
        } catch(Exception $e) {
            return response() -> json('Impossible To Store', 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $sCategory = Scategorie::with('categorie') -> findOrFail($id);
            return response() -> json($sCategory);
        } catch(Exception $e) {
            return response() -> json($e -> getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $sCategory = Scategorie::findOrFail($id);
            $sCategory -> update($request -> all());
            return response() -> json($sCategory);
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
            $sCategory = Scategorie::findOrFail($id);
            $sCategory -> delete(); 
            return response() -> json("sCategorie was deleted succesfully");
        } catch(Exception $e) {
            return response() -> json($e -> getMessage());
        }
    }
}

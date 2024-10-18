<?php

namespace App\Http\Controllers;

use App\Models\article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $articles = Article::with('scategorie') -> get();
            return response() -> json($articles);
        } catch(\Exception $e) {
            response() -> json('Impossible To Fetch Articles', 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $article = new Article([
                'designation' => $request -> input('designation'),
                'reference' => $request -> input('reference'),
                'marque' => $request -> input('qtestock'),
                'scategorieID', $request -> input('scategorieID'),
                'imageart' => $request -> input('imageart')
            ]);
            $article -> save();
            return response() -> json($article);
        } catch(\Exception $e) {
            return response() -> json('Impossible to Store', 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $article=Article::with('scategorie') -> findOrFail($id);
            return response() -> json($article);
        } catch (\Exception $e) {
            return response() -> json(data: $e -> getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);
            $article -> updat($request -> all());
            return response() -> json($article);
        } catch(\Exception $e) {
            return response() -> json(data: $e -> getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);
            $article -> delete();
            return response() -> json("Article was deleted succesfully");
        } catch (\Exception $e) {
            return response() -> json("{$e -> getMessage()}");
        }
    }

    public function showArticleBySCAT($idscat) {
        try {
            $articles = Article::where('scategorieID', $idscat) -> with('scategorie') -> get();
            return response() -> json($articles);
        } catch(\Exception $e) {
            return response() -> json("Impossible to Select an article by its Sub-Categorie");
        }
    }

    public function articlesPaginate(){
        try {
            $perPage = request() -> input('pageSize', 2); 
            $articles = Article::with('scategorie')->paginate($perPage);
            return response() -> json([
            'products' => $articles -> items(), 
            'totalPages' => $articles -> lastPage(), 
            ]);
        } catch (\Exception $e) {
            return response() -> json("Impossible to select {$e->getMessage()}");
        }
    }
}

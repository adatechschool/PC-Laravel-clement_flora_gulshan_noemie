<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class ArticleController extends BaseController
{
    public function index()
    {
        $articles = Article::all();
        return view("articles.index", compact('articles'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("articles.edit");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request) {
        // 1. La validation
        $this->validate($request, [
            'description' => 'bail|required|string|max:255',
            "img_url" => 'bail|required|image|max:1024',
            "name" => 'bail|required',
        ]);
    
        // 2. On upload l'image dans "/storage/app/public/posts"
        $chemin_image = $request->img_url->store("articles");
    
        // 3. On enregistre les informations du Post
        Article::create([
            "description" => $request->description,
            "img_url" => $chemin_image,
            "name" => $request->name,
        ]);
    
        // 4. On retourne vers tous les posts : route("posts.index")
        return redirect(route("articles.dashboard"));
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', [
            'article' => $article
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view("articles.edit", compact("article"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        // 1. La validation

    // Les règles de validation pour "title" et "content"
    $rules = [
        'description' => 'bail|required|string|max:255',
        "name" => 'bail|required',
    ];

    // Si une nouvelle image est envoyée
    if ($request->has("img_url")) {
        // On ajoute la règle de validation pour "picture"
        $rules["img_url"] = 'bail|required|image|max:1024';
    }

    $this->validate($request, $rules);

    // 2. On upload l'image dans "/storage/app/public/posts"
    if ($request->has("img_url")) {

        //On supprime l'ancienne image
        Storage::delete($article->img_url);

        $chemin_image = $request->img_url->store("articles");
    }

    // 3. On met à jour les informations du Post
    $article->update([
        "description" => $request->description,
        "img_url" => isset($chemin_image) ? $chemin_image : $article->img_url,
        "name" => $request->name
    ]);

    // 4. On affiche le Post modifié : route("posts.show")
    return redirect(route("articles.show", $article));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        // On supprime l'image existant
    Storage::delete($article->img_url);

    // On les informations du $post de la table "posts"
    $article->delete();

    // Redirection route "posts.index"
    return redirect(route('articles.dashboard'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Articles;
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Articles::paginate(15);

        //Resource Collection
        return ArticleResource::collection($article);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $article = isMethod('put') ? Articles::findOrFail($request->article_id) : new Articles;
        
        $article->id = $request->article_id;
        $article->title = $request->title;
        $article->body = $request->body;

        if ($article->save()) {
            return new ArticleResource($article);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get article
        $article = Articles::findOrFail($id);

        return new ArticleResource($article);
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $article = Articles::findOrFail($id);

        if ($article->delete()) {
            return new ArticleResource($article);
        }
    }
}

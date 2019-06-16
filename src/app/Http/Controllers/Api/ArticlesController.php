<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        $data = [];
        foreach ($articles as $idx => $article) {
            $data[$idx]['id'] = $article->id;
            $data[$idx]['title'] = $article->title;
            $data[$idx]['body'] = $article->short_body;
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $article = new Article;
        $article->title = $request->title;
        $article->body = $request->body;
        $article->save();
        return redirect('api/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $data = [];
        $data['id'] = $article->id;
        $data['title'] = $article->title;
        $data['body'] = $article->mark_body;
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ArticleRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = Article::find($id);
        $article->title = $request->title;
        $article->body = $request->body;
        $article->save();
        return redirect("api/articles/{$id}");
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
    }

    /**
     * Search the freeword from body.
     *
     * @param  string $freeword
     * @return void
     */
    public function search($freeword)
    {
        $articles = Article::freeword($freeword)->get();
        $data = [];
        foreach ($articles as $idx => $article) {
            $data[$idx]['id'] = $article->id;
            $data[$idx]['title'] = $article->title;
            $data[$idx]['body'] = $article->short_body;
        }
        return $data;
    }
}

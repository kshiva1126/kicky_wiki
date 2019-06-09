<?php

namespace App\Http\Controllers\Api;

<<<<<<< HEAD
use App\Article;
use App\Http\Requests\ArticleRequest;
=======
use Illuminate\Http\Request;
use App\Article;
>>>>>>> 5422dc375f52e1969898d366614ed5b9543ef2ea
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
<<<<<<< HEAD
            $data[$idx]['title'] = $article->title;
            $data[$idx]['body'] = $article->short_mark_body;
=======
            $data[$idx]['id'] = $article->id;
            $data[$idx]['title'] = $article->title;
            $data[$idx]['body'] = $article->short_body;
>>>>>>> 5422dc375f52e1969898d366614ed5b9543ef2ea
            // 一覧画面には必要ない情報かも？
            foreach ($article->article_images as $image) {
                $data[$idx]['image'][] = $image->image_path;
            }
        }
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
<<<<<<< HEAD
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
=======
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
>>>>>>> 5422dc375f52e1969898d366614ed5b9543ef2ea
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
<<<<<<< HEAD
     * @param  App\Http\Requests\ArticleRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
=======
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
>>>>>>> 5422dc375f52e1969898d366614ed5b9543ef2ea
    {
        //
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
}

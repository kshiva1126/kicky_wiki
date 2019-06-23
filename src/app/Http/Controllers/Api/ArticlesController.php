<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\ArticleImage;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Log;

class ArticlesController extends Controller
{
    public $tmp_dir = '/tmp/';

    public $images_dir = '/images/';
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
     * @param ArticleRequest $request
     * @return string
     */
    public function store(ArticleRequest $request)
    {
        Log::debug($request->all());
        Log::debug('start to regist article');
        $article = new Article;
        if ($request->images) {
            list($body, $images) = $this->processBodyAndImages($request->body, explode(',', rtrim($request->images, ',')));
        } else {
            $images = [];
            $body = $request->body;
        }
        $article->title = $request->title;
        $article->body = $body;
        $article->save();
        Log::debug('end to regist article');

        if ($images) {
            Log::debug('start to regist article_image');
            $article_id = $article->id;
            foreach ($images as $image) {
                ArticleImage::create([
                    'article_id' => $article_id,
                    'image_path' => $image,
                ]);
            }
            Log::debug('end to regist article_image');
        }

        return response()->json([
            'Id' => $article->id,
        ]);
    }


    private function processBodyAndImages($body, $images = [])
    {
        Log::debug('ArticleController@processBodyAndImages() start');
        $processed_body = '';
        $genuine_images = [];
        foreach ($images as $image) {
            if (strpos($body, $image) !== false) {
                $image_name = str_replace($this->tmp_dir, '', $image);
                $this->mvImagesFromTmpToImagesDir($image_name);
                $body = str_replace($image, "{$this->images_dir}{$image_name}", $body);
                $genuine_images[] = "{$this->images_dir}{$image_name}";
            }
        }
        $processed_body = $body;
        Log::debug('ArticleController@processBodyAndImages() end');
        return [$processed_body, $genuine_images];
    }

    private function mvImagesFromTmpToImagesDir($image_name)
    {
        Log::debug('ArticleController@mvImagesFromTmpToImagesDir() start');
        $tmp = public_path() . "{$this->tmp_dir}{$image_name}";
        $perm = public_path() . "{$this->images_dir}{$image_name}";
        $command = sprintf('mv %s %s', $tmp, $perm);
        exec($command);
        Log::debug('ArticleController@mvImagesFromTmpToImagesDir() end');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Article::find($id);
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
        return response()->json([
            'Id' => $article->id,
        ]);
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

    /**
     * Upload an image.
     *
     * @param Request $request
     * @return void
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file'  => [
                'file',
                'image',
                'mimes:jpeg, png',
            ],
        ]);
        
        $image = Image::make($request->image);
        $fileName = $this->tmp_dir . str_random(32) . '.png';
        $filePath = public_path();
        $image->save($filePath . $fileName);
        return response()->json([
            'fileName' => $fileName,
        ]);
    }
}

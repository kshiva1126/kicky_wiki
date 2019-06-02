<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Article;

class ArticleImage extends Model
{
    /**
     * article belongsTo設定
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

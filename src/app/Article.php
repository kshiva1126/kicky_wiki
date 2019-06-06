<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ArticleImage;
use cebe\markdown\GithubMarkdown as Markdown;

class Article extends Model
{
    /**
     * 一覧表示用に内容を100文字で丸め、Markdownにparseする
     */
    public function getShortMarkBodyAttribute()
    {
        // "..."も含めて100文字で丸める
        $short_body = mb_strimwidth($this->body, 0, 100, '...', 'UTF-8');
        return $this->parse($short_body);
    }

    /**
     * 内容をMarkdownにparseする
     */
    public function getMarkBodyAttribute()
    {
        return $this->parse($this->body);
    }

    /**
     * Markdownにparseする
     * @param $body
     */
    public function parse($body)
    {
        $parser = new Markdown();
        return $parser->parse($body);
    }

    /**
     * articleImage hasmany設定
     */
    public function article_images()
    {
        return $this->hasMany(ArticleImage::class);
    }
}

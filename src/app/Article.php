<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ArticleImage;
use cebe\markdown\GithubMarkdown as Markdown;

class Article extends Model
{
    /**
     * 一覧表示用に内容を100文字で丸め、Markdownにparseした上で
     * HTML および PHP タグを取り除いた文字列を返す
     */
    public function getShortBodyAttribute()
    {
        // "..."も含めて100文字で丸める
        $short_body = mb_strimwidth($this->body, 0, 100, '...', 'UTF-8');
        // Markdownにparseする
        $short_body = $this->parse($short_body);
        // HTML および PHP タグを取り除く
        $short_body = strip_tags($this->parse($short_body));
        // 改行コードを取り除く
        return str_replace(['\r', '\n'], $short_body, '');
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

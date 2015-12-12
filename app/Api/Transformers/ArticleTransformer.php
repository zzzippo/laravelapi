<?php
namespace App\Api\Transformers;
use League\Fractal\TransformerAbstract;
use App\Article;

class ArticleTransformer extends TransformerAbstract
{
    public function transform(Article $article)
    {
        return $article->toArray();
    }
}

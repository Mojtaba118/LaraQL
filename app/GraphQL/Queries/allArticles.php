<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Article;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class allArticles extends Query
{
    protected $attributes = [
        'name' => 'allArticles',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return \GraphQL::paginate('Article');
    }

    public function args(): array
    {
        return [
            'limit'=>['type'=>Type::int()],
            'page'=>['type'=>Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $limit=$args['limit']??10;
        $page=$args['page']??1;
        $articles=Article::paginate($limit,['*'],'page',$page);
        return $articles;
    }
}

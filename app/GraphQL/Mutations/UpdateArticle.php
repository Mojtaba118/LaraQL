<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Article;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class UpdateArticle extends Mutation
{
    protected $attributes = [
        'name' => 'updateArticle',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return \GraphQL::type("Article");
    }

    public function args(): array
    {
        return [
            'id'=>['type'=>Type::nonNull(Type::int())],
            'title'=>['type'=>Type::string()],
            'body'=>['type'=>Type::string()]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $article=Article::find($args['id']);
        $article->update($args);
        return $article;
    }
}

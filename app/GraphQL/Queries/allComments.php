<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Comment;
use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class allComments extends Query
{
    protected $attributes = [
        'name' => 'allComments',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(\Graphql::type('Comment'));
    }

    public function args(): array
    {
        return [

        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
       $comments=Comment::all();
       return $comments;
    }
}

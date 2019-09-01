<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class Comment extends GraphQLType
{
    protected $attributes = [
        'name' => 'Comment',
        'description' => 'A type for Comments Table'
    ];

    public function fields(): array
    {
        return [
            'id'=>['type'=>Type::int()],
            'user'=>['type'=>\GraphQL::type("User")],
            'article'=>['type'=>\GraphQL::type("Article")],
            'body'=>['type'=>Type::string()]
        ];
    }
}

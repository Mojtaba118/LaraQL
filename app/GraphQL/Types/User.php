<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class User extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type for Users'
    ];

    public function fields(): array
    {
        return [
            'id'=>['type'=>Type::int()],
            'articles'=>['type'=>Type::listOf(\GraphQL::type('Article'))],
            'comments'=>['type'=>Type::listOf(\GraphQL::type('Comment'))],
            'name'=>['type'=>Type::string()],
            'admin'=>['type'=>Type::boolean()],
            'email'=>['type'=>Type::string()],
        ];
    }
}

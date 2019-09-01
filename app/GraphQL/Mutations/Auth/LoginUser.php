<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Auth;

use Closure;
use GraphQL\Error\Error;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class LoginUser extends Mutation
{
    protected $attributes = [
        'name' => 'auth/LoginUser',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return \GraphQL::type("Token");
    }

    public function args(): array
    {
        return [
            'email'=>['type'=>Type::string()],
            'password'=>['type'=>Type::string()],
        ];
    }

    protected function rules(array $args = []): array
    {
        return [
            'email'=>['required','email'],
            'password'=>['required','string'],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (Auth::attempt(['email'=>$args['email'],'password'=>$args['password']])){
            $user=\auth()->user();
            $token=$user->createToken('login')->accessToken;
            return [
                'token'=>$token,
                'user'=>$user
            ];
        }

        return new Error('Invalid Credentials');
    }
}

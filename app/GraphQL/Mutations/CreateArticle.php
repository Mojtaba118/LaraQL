<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Article;
use Carbon\Carbon;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\UploadType;

class CreateArticle extends Mutation
{
    protected $attributes = [
        'name' => 'articleCreateArticle',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return \GraphQL::type("Article");
    }

    public function args(): array
    {
        return [
            'title'=>['type'=>Type::string()],
            'body'=>['type'=>Type::string()],
            'file'=>['type'=>\GraphQL::type("Upload")],
        ];
    }

    protected function rules(array $args = []): array
    {
        return [
            'title'=>['required','string','max:255'],
            'body'=>['required','string'],
            'file'=>['required','image']
        ];
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'title.required'=>'عنوان الزامی است',
            'body.required'=>'محتوای مقاله الزامی است',
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $file=$args['file'];
        $fileName=$file->getClientOriginalName();
        $year=Carbon::now()->year;
        $filePath="/uploads/images/{$year}";
        $file->move(public_path($filePath),$fileName);
        $fullPath="{$filePath}/{$fileName}";
        $article=auth()->user()->articles()->create([
            'title'=>$args['title'],
            'body'=>$args['body'],
            'image'=>$fullPath
        ]);
        return $article;
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\DTO\User\LoginData;
use App\DTO\User\RegisterData;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\ArticleCommentResource;
use App\Http\Resources\ArticlePreviewResource;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\UserResource;
use App\Models\Article;
use App\Services\User\AuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ArticleCommentController extends ApiController
{
    public function store(Request $request, Article $article)
    {
        $validated = $request->validate([
            'text' => 'required|min:5|max:30'
        ]);

        $comment = $article->comments()
            ->create([
                ...$validated,
                'user_id' => $request->user()->id
            ]);

        return $this->okResponse(__('comment.created'), new ArticleCommentResource($comment));
    }
}

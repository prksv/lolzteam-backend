<?php

namespace App\Http\Controllers\Api;

use App\DTO\User\LoginData;
use App\DTO\User\RegisterData;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\ArticlePreviewResource;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\UserResource;
use App\Models\Article;
use App\Services\User\AuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ArticleController extends ApiController
{
    public function index(Request $request)
    {
        $articles = Article::paginate(10);

        return $this->resourceCollectionResponse(ArticlePreviewResource::collection($articles), 'ok', false);
    }

    public function show(Request $request, Article $article)
    {
        return $this->okResponse('OK', new ArticleResource($article));
    }


}

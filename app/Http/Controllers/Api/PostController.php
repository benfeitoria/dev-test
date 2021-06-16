<?php

namespace App\Http\Controllers\Api;

use App\Architecture\Posts\Enum\PostEnum;
use App\Architecture\Posts\Models\Post;
use App\Enum\StatusEnum;
use App\Http\Requests\Posts\PostRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Str;
use stdClass;
use Throwable;

class PostController extends BaseController
{
    /**
     * @param PostRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(PostRequest $request) : JsonResponse
    {
        try {
            $params = new stdClass();
            $params->image_path = $request->input('image_path');
            $params->title = $this->limpa_tags($request->input('title'));
            $params->content = $this->limpa_tags($request->input('content'));
            $params->slug = $this->limpa_tags(Str::lower($request->input('slug')));
            $params->category_id = $this->limpa_tags($request->input(''));

            $this->IPostService->store($params);

            return $this->returnResponse(PostEnum::CREATED, StatusEnum::CREATED);
        } catch (Exception $err) {
            report($err);
            $this->shootExeception($err, PostEnum::NOT_CREATED);
        }
    }

    /**
     * @param PostRequest $request
     * @param Post $post
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(PostRequest $request, Post $post) : JsonResponse
    {
        try {
            $params = new stdClass();
            $params->image_path = $request->input('image_path');
            $params->title = $this->limpa_tags($request->input('title'));
            $params->content = $this->limpa_tags($request->input('content'));
            $params->slug = $this->limpa_tags(Str::lower($request->input('slug')));
            $params->category_id = $this->limpa_tags($request->input(''));

            $this->IPostService->update($post, $params);

            return $this->returnResponse(PostEnum::UPDATED, StatusEnum::OK);
        } catch (Exception $err) {
            report($err);
            $this->shootExeception($err, PostEnum::NOT_UPDATED);
        }
    }

    /**
     * @param Post $post
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Post $post) : JsonResponse
    {
        try {
            $this->IPostService->delete($post);

            return $this->returnResponse(PostEnum::DELETED, PostEnum::NOT_DELETED);
        } catch (Exception $err) {
            report($err);
            $this->shootExeception($err, PostEnum::NOT_DELETED);
        }
    }
}

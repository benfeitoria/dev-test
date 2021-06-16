<?php

namespace App\Http\Controllers\Api;

use App\Architecture\Categories\Enum\CategoryEnum;
use App\Architecture\Categories\Models\Category;
use App\Enum\StatusEnum;
use App\Http\Requests\Categories\CategoryRequest;
use Illuminate\Http\JsonResponse;
use Exception;
use Throwable;

class CategoryController extends BaseController
{
    /**
     * @param CategoryRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(CategoryRequest $request) : JsonResponse
    {
        try {
            $params = new \stdClass();
            $params->name = $this->limpa_tags($request->input('name'));
            $params->slug = $this->limpa_tags(str_replace(' ','_',trim($request->input('slug'))));

            $this->ICategoryService->store($params);

            return $this->returnResponse(CategoryEnum::CREATED, StatusEnum::CREATED);
        } catch (Exception $err) {
            report($err);
            $this->shootExeception($err, CategoryEnum::NOT_CREATED);
        }
    }

    /**
     * @param Category $category
     * @param CategoryRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(Category $category, CategoryRequest $request) : JsonResponse
    {
        try {
            $params = new \stdClass();
            $params->name = $this->limpa_tags($request->input('name'));
            $params->slug = $this->limpa_tags(str_replace(' ','_',trim($request->input('slug'))));

            $this->ICategoryService->update($category, $params);

            return $this->returnResponse(CategoryEnum::UPDATED, StatusEnum::OK);
        } catch (Exception $err) {
            report($err);
            $this->shootExeception($err, CategoryEnum::NOT_UPDATED);
        }
    }

    /**
     * @param Category $category
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Category $category): JsonResponse
    {
        try {
            $this->ICategoryService->delete($category);

            return $this->returnResponse(CategoryEnum::DELETED, StatusEnum::OK);
        } catch (Exception $err) {
            report($err);
            $this->shootExeception($err, CategoryEnum::NOT_DELETED);
        }
    }
}

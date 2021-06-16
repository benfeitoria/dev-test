<?php

namespace App\Architecture\Categories\Repositories;

use App\Architecture\Categories\Interfaces\ICategoryRepository;
use App\Architecture\Categories\Models\Category;
use App\Exceptions\SystemException;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class CategoryRepository implements ICategoryRepository
{

    /**
     * @inheritDoc
     */
    public function listCategories(): Collection
    {
        return Category::whereNull('deleted_at')->get();
    }

    /**
     * @param stdClass $params
     * @return Category
     * @throws SystemException
     */
    public function store(stdClass $params): Category
    {
        $category = new Category();
        $category->name = $params->name;
        $category->slug = $params->slug;

        if (!$category->save()) {
            throw new SystemException('Erro ao inserir a categoria.', 400);
        }

        return $category;
    }

    /**
     * @param Category $category
     * @param stdClass $params
     * @return Category
     * @throws SystemException
     */
    public function update(Category $category, stdClass $params): Category
    {
        $category->name = $params->name;
        $category->slug = $params->slug;

        if (!$category->save()) {
          throw new SystemException('Erro ao atualizar a categoria.', 400);
        }

        $category->refresh();

        return $category;
    }

    /**
     * @param Category $category
     * @return Category|null
     */
    public function delete(Category $category): ?Category
    {
        $category->forceDelete();

        return $category;
    }
}

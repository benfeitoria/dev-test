<?php

namespace App\Architecture\Categories\Services;

use App\Architecture\Categories\Interfaces\ICategoryRepository;
use App\Architecture\Categories\Interfaces\ICategoryService;
use App\Architecture\Categories\Models\Category;
use App\Architecture\Categories\Validates\CategoryValidate;
use Illuminate\Database\Eloquent\Collection;
use stdClass;
use Throwable;

class CategoryService implements ICategoryService
{
    /**
     * @var ICategoryRepository
     * @var CategoryValidate
     */
    protected $ICategoryRepository;
    protected $CategoryValidate;

    /**
     * CategoryService constructor.
     * @param ICategoryRepository $ICategoryRepository
     */
    public function __construct(ICategoryRepository $ICategoryRepository)
    {
        $this->ICategoryRepository = $ICategoryRepository;
    }

    /**
     * @return Collection
     */
    public function listCategories(): Collection
    {
        return $this->ICategoryRepository->listCategories();
    }

    /**
     * @param stdClass $params
     * @return Category
     * @throws Throwable
     */
    public function store(stdClass $params): Category
    {
        $this->getCategoryValidate()->validaParametros($params);
        return $this->ICategoryRepository->store($params);
    }

    /**
     * @param Category $category
     * @param stdClass $params
     * @return Category
     * @throws Throwable
     */
    public function update(Category $category, stdClass $params): Category
    {
        $this->getCategoryValidate()->validaParametros($params);
        return $this->ICategoryRepository->update($category, $params);
    }

    /**
     * @param Category $category
     * @return Category|null
     */
    public function delete(Category $category): ?Category
    {
        return $this->ICategoryRepository->delete($category);
    }

    /**
     * @return CategoryValidate
     */
    private function getCategoryValidate() : CategoryValidate
    {
        return $this->CategoryValidate;
    }
}

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

    public function update(Category $category, stdClass $params): Category
    {
        // TODO: Implement update() method.
    }

    public function delete(Category $category): ?Category
    {
        // TODO: Implement delete() method.
    }

    public function desactive(Category $category): ?Category
    {
        // TODO: Implement desactive() method.
    }

    public function active(Category $category): ?Category
    {
        // TODO: Implement active() method.
    }

    /**
     * @return CategoryValidate
     */
    private function getCategoryValidate() : CategoryValidate
    {
        return $this->CategoryValidate;
    }
}

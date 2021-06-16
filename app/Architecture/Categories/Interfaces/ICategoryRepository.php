<?php

namespace App\Architecture\Categories\Interfaces;

use App\Architecture\Categories\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

interface ICategoryRepository
{
    /**
     * @return Collection
     */
    public function listCategories() : Collection;

    /**
     * @param stdClass $params
     * @return Category
     */
    public function store(stdClass $params) : Category;

    /**
     * @param Category $category
     * @param stdClass $params
     * @return Category
     */
    public function update(Category $category, stdClass $params) : Category;

    /**
     * @param Category $category
     * @return Category|null
     */
    public function delete(Category $category) :? Category;
}

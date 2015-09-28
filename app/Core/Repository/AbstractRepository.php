<?php

namespace Keep\Core\Repository;

abstract class AbstractRepository
{
    /**
     * Get a collection of all model instances.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Count the number of total instances.
     *
     * @return int
     */
    public function countAll()
    {
        return $this->model->count();
    }

    /**
     * Find a model instance by its id.
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Find a model instance by its slug.
     *
     * @param $slug
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

    /**
     * Check if a collections of model instances can be sorted.
     *
     * @param array $params
     * @return bool
     */
    public function isSortable(array $params)
    {
        return $params['sortBy'] && $params['direction'];
    }
}

<?php

namespace Keep\Repositories;

abstract class AbstractEloquentRepository
{
    /**
     * Get a collection of all model instances.
     *
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Count the number of total instances.
     *
     * @return mixed
     */
    public function countAll()
    {
        return $this->model->count();
    }

    /**
     * Find a model instance by its id.
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Find a model instance by its slug.
     *
     * @param $slug
     * @return mixed
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

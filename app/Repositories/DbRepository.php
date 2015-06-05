<?php namespace Keep\Repositories;

abstract class DbRepository {

    public function getAll()
    {
        return $this->model->all();
    }

    public function countAll()
    {
        return $this->model->count();
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

    public function isSortable(array $params)
    {
        return $params['sortBy'] and $params['direction'];
    }

}
<?php

namespace Keep\Repositories\Contracts\Common;

interface RepositoryInterface
{
    /**
     * Get a collection of all model instances.
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Count the number of total instances.
     *
     * @return mixed
     */
    public function countAll();

    /**
     * Create a new model instance.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);
}

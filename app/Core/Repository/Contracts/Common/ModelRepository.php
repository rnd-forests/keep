<?php

namespace Keep\Core\Repository\Contracts\Common;

interface ModelRepository
{
    /**
     * Get a collection of all model instances.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Count the number of total instances.
     *
     * @return int
     */
    public function countAll();

    /**
     * Create a new model instance.
     *
     * @param array $data
     * @return static
     */
    public function create(array $data);
}

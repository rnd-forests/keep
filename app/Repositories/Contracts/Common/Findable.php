<?php

namespace Keep\Repositories\Contracts\Common;

interface Findable
{
    /**
     * Find a model instance by its id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function findById($id);

    /**
     * Find a model instance by its slug.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findBySlug($slug);
}

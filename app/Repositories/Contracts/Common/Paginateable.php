<?php

namespace Keep\Repositories\Contracts\Common;

interface Paginateable
{
    /**
     * Paginate a collection of models.
     *
     * @param $limit
     * @param array|null $params
     * @return mixed
     */
    public function paginate($limit, array $params = null);
}

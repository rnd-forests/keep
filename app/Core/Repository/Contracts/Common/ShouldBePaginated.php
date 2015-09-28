<?php

namespace Keep\Core\Repository\Contracts\Common;

interface ShouldBePaginated
{
    /**
     * Paginate a collection of models.
     *
     * @param $limit
     * @param array|null $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($limit, array $params = null);
}

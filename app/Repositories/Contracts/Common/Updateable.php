<?php

namespace Keep\Repositories\Contracts\Common;

interface Updateable
{
    /**
     * Update a model instance.
     *
     * @param array $data
     * @param $identifier1
     * @param null $identifier2
     * @return mixed
     */
    public function update(array $data, $identifier1, $identifier2 = null);
}

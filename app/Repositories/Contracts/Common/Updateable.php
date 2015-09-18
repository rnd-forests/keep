<?php

namespace Keep\Repositories\Contracts\Common;

interface Updateable
{
    /**
     * Update a model instance.
     *
     * @param array $data
     * @param $identifier
     * @param null $optionalIdentifier
     *
     * @return mixed
     */
    public function update(array $data, $identifier, $optionalIdentifier = null);
}

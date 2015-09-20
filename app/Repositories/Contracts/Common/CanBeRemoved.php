<?php

namespace Keep\Repositories\Contracts\Common;

interface CanBeRemoved
{
    /**
     * Restore a soft deleted model instance.
     *
     * @param $identifier
     * @return mixed
     */
    public function restore($identifier);

    /**
     * Soft delete a model instance.
     *
     * @param $identifier
     * @return mixed
     */
    public function softDelete($identifier);

    /**
     * Permanently delete a soft deleted model instance.
     *
     * @param $identifier
     * @return mixed
     */
    public function forceDelete($identifier);
}

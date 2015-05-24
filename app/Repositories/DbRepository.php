<?php namespace Keep\Repositories;

abstract class DbRepository {

    public function isSortable(array $params)
    {
        return $params['sortBy'] and $params['direction'];
    }

}
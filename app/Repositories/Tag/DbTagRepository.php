<?php namespace Keep\Repositories\Tag;

use Keep\Tag;

class DbTagRepository implements TagRepositoryInterface {

    public function lists()
    {
        return Tag::orderBy('name', 'asc')->lists('name', 'id');
    }

}
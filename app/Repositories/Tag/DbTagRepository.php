<?php  namespace Keep\Repositories\Tag; 

use Keep\Tag;

class DbTagRepository implements TagRepositoryInterface {

    public function lists()
    {
        return Tag::lists('name', 'id');
    }

}
<?php  namespace Keep\Repositories\Priority; 

use Keep\Priority;

class DbPriorityRepository implements PriorityRepositoryInterface {

    public function lists()
    {
        return Priority::orderBy('value', 'desc')->lists('name', 'id');
    }

}
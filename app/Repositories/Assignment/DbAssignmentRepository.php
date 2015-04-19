<?php  namespace Keep\Repositories\Assignment; 

use Keep\Assignment;

class DbAssignmentRepository implements AssignmentRepositoryInterface {

    public function create(array $data)
    {
        return Assignment::create([
            'name' => $data['name']
        ]);
    }

}
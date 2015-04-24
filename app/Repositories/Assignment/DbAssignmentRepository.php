<?php namespace Keep\Repositories\Assignment;

use Keep\Assignment;

class DbAssignmentRepository implements AssignmentRepositoryInterface {

    public function getPaginatedAssignments($limit)
    {
        return Assignment::with('task', 'users', 'groups')->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function findBySlug($slug)
    {
        return Assignment::with('task')->whereSlug($slug)->firstOrFail();
    }

    public function update($slug, array $data)
    {
        $assignment = $this->findBySlug($slug);

        $assignment->update($data);

        return $assignment;
    }

    public function delete($slug)
    {
        return $this->findBySlug($slug)->delete();
    }

    public function create(array $data)
    {
        return Assignment::create([
            'assignment_name' => $data['assignment_name']
        ]);
    }

    public function syncPolymorphicRelations($assignment, $users, $groups)
    {
        if ($assignment->users->isEmpty()) $assignment->groups()->sync($groups);

        if ($assignment->groups->isEmpty()) $assignment->users()->sync($users);
    }

}
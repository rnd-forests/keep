<?php namespace Keep\Repositories\Assignment;

use Keep\User;
use Keep\Assignment;
use Keep\Services\KeepHelper;
use Illuminate\Support\Collection;

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

    public function getGroupAssignmentsAssociatedWithAUser($userSlug)
    {
        return $this->fetchUserGroupAssignments($userSlug)->orderBy('created_at', 'desc')->get();
    }

    public function getAssignmentsAssociatedWithAUser($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return $user->assignments()->orderBy('created_at', 'desc')->get();
    }

    public function findPersonalAssignment($userSlug, $assignmentSlug)
    {
        $user = User::findBySlug($userSlug);

        return $user->assignments()->whereSlug($assignmentSlug)->firstOrFail();
    }

    public function findGroupAssignment($userSlug, $assignmentSlug)
    {
        return $this->fetchUserGroupAssignments($userSlug)->whereSlug($assignmentSlug)->firstOrFail();
    }

    /**
     * Fetching user group-assignment collection.
     *
     * @param $userSlug
     *
     * @return mixed
     */
    private function fetchUserGroupAssignments($userSlug)
    {
        $ids = new Collection;

        $user = User::findBySlug($userSlug);

        $user->groups->each(function ($group) use ($ids) {
            Collection::make(KeepHelper::getIdsOfAssignmentsInRelationWithGroup($group))->each(function ($id) use ($ids) {
                $ids->push($id);
            });
        });

        return Assignment::whereIn('id', $ids->unique()->toArray());
    }

}
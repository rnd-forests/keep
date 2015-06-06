<?php
namespace Keep\Repositories\Assignment;

use DB;
use Keep\Entities\User;
use Keep\Entities\Assignment;
use Keep\Services\KeepHelper;
use Illuminate\Support\Collection;
use Keep\Repositories\DbRepository;

class EloquentAssignmentRepository extends DbRepository implements AssignmentRepositoryInterface
{
    protected $model;

    public function __construct(Assignment $model)
    {
        $this->model = $model;
    }

    public function getPaginatedAssignments($limit)
    {
        return $this->model
            ->with('task', 'users', 'groups')
            ->latest('created_at')
            ->paginate($limit);
    }

    public function findBySlug($slug)
    {
        return $this->model
            ->with('task')
            ->where('slug', $slug)
            ->firstOrFail();
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
        return $this->model->create([
            'assignment_name' => $data['assignment_name']
        ]);
    }

    public function syncPolymorphicRelations($assignment, $users, $groups)
    {
        if ($assignment->users->isEmpty()) {
            $assignment->groups()->sync($groups);
        }
        if ($assignment->groups->isEmpty()) {
            $assignment->users()->sync($users);
        }
    }

    public function getGroupAssignmentsAssociatedWithAUser($userSlug)
    {
        return $this->fetchUserGroupAssignments($userSlug)
            ->latest('created_at')
            ->get();
    }

    public function getAssignmentsAssociatedWithAUser($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return $user->assignments()
            ->latest('created_at')
            ->get();
    }

    public function findPersonalAssignment($userSlug, $assignmentSlug)
    {
        $user = User::findBySlug($userSlug);

        return $user->assignments()
            ->where('slug', $assignmentSlug)
            ->firstOrFail();
    }

    public function findGroupAssignment($userSlug, $assignmentSlug)
    {
        return $this->fetchUserGroupAssignments($userSlug)
            ->where('slug', $assignmentSlug)
            ->firstOrFail();
    }

    private function fetchUserGroupAssignments($userSlug)
    {
        $ids = new Collection;
        $user = User::findBySlug($userSlug);
        $user->groups->each(function ($group) use ($ids) {
            Collection::make(
                KeepHelper::getAssignmentIdsRelatedToGroup($group)
            )->each(function ($id) use ($ids) {
                $ids->push($id);
            });
        });

        return $this->model->whereIn('id', $ids->unique()->toArray());
    }

    public function getTrashedAssignments($limit)
    {
        return $this->model
            ->onlyTrashed()
            ->latest('deleted_at')
            ->paginate($limit);
    }

    public function findTrashedAssignmentBySlug($slug)
    {
        return $this->model
            ->onlyTrashed()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function restore($slug)
    {
        $assignment = $this->findTrashedAssignmentBySlug($slug);
        $assignment->task()->withTrashed()->restore();

        return $assignment->restore();
    }

    public function forceDelete($slug)
    {
        $assignment = $this->findTrashedAssignmentBySlug($slug);
        $assignment->task()->withTrashed()->forceDelete();
        DB::table('assignables')->where('assignment_id', $assignment->id)->delete();
        $assignment->forceDelete();
    }
}
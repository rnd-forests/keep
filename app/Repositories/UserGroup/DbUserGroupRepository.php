<?php  namespace Keep\Repositories\UserGroup;

use Keep\User;
use Keep\Group;
use Keep\Services\KeepHelper;

class DbUserGroupRepository implements UserGroupRepositoryInterface {

    public function all()
    {
        return Group::all();
    }

    public function count()
    {
        return Group::count();
    }

    public function getPaginatedGroups($limit)
    {
        return Group::with('users')->latest('created_at')->paginate($limit);
    }

    public function findById($id)
    {
        return Group::findOrFail($id);
    }

    public function findBySlug($slug)
    {
        return Group::findBySlug($slug);
    }

    public function create(array $data)
    {
        return Group::create([
            'name' => $data['name'],
            'description' => $data['description']
        ]);
    }

    public function update($slug, array $data)
    {
        $group = $this->findBySlug($slug);

        $group->update($data);

        return $group;
    }

    public function restore($slug)
    {
        $group = $this->findTrashedGroupBySlug($slug);

        return $group->restore();
    }

    public function delete($slug)
    {
        return $this->findBySlug($slug)->delete();
    }

    public function forceDelete($slug)
    {
        $group = $this->findTrashedGroupBySlug($slug);

        $group->forceDelete();
    }

    public function getTrashedGroups()
    {
        return Group::with('users')->onlyTrashed()->latest('deleted_at')->paginate(10);
    }

    public function findTrashedGroupBySlug($slug)
    {
        return Group::onlyTrashed()->whereSlug($slug)->firstOrFail();
    }

    public function getPaginatedAssociatedUsers($group, $limit)
    {
        return $group->users()->orderBy('name', 'asc')->paginate($limit);
    }

    public function getUsersOutsideGroup($slug)
    {
        return User::whereNotIn('id', KeepHelper::getIdsOfUsersInRelationWithGroup($this->findBySlug($slug)))->get();
    }

    public function attachUsers($group, array $users)
    {
        $group->users()->attach($users);
    }

}
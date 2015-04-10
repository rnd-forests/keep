<?php  namespace Keep\Repositories\UserGroup; 

use Keep\Group;

class DbUserGroupRepository implements UserGroupRepositoryInterface {

    public function all()
    {
        return Group::all();
    }

    public function count()
    {
        return Group::all()->count();
    }

    public function getPaginatedGroups($limit)
    {
        return Group::with('users')->latest('created_at')->paginate($limit);
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
        return Group::onlyTrashed()->latest('deleted_at')->paginate(10);
    }

    public function findTrashedGroupBySlug($slug)
    {
        return Group::onlyTrashed()->whereSlug($slug)->firstOrFail();
    }

    public function getPaginatedAssociatedUsers($group, $limit)
    {
        return $group->users()->latest('created_at')->paginate($limit);
    }

}
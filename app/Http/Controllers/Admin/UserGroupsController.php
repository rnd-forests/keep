<?php
namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\UserGroupRequest;
use Keep\Http\Requests\AddUsersToGroupRequest;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;

class UserGroupsController extends Controller
{
    protected $groupRepo;

    /**
     * Create new user groups controller instance.
     *
     * @param UserGroupRepositoryInterface $groupRepo
     */
    public function __construct(UserGroupRepositoryInterface $groupRepo)
    {
        $this->groupRepo = $groupRepo;
    }

    /**
     * Get all current groups.
     *
     * @return \Illuminate\View\View
     */
    public function activeGroups()
    {
        $groups = $this->groupRepo->getPaginatedGroups(15);

        return view('admin.groups.active_groups', compact('groups'));
    }

    /**
     * Get form to create new group.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.groups.create');
    }

    /**
     * Persist new group.
     *
     * @param UserGroupRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserGroupRequest $request)
    {
        $this->groupRepo->create($request->all());
        flash()->success('The new group was successfully created.');

        return redirect()->route('admin::groups.active');
    }

    /**
     * Display a group.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $group = $this->groupRepo->findBySlug($slug);
        $users = $this->groupRepo->getPaginatedAssociatedUsers($group, 16);

        return view('admin.groups.show', compact('group', 'users'));
    }

    /**
     * Get form to update a group.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $group = $this->groupRepo->findBySlug($slug);

        return view('admin.groups.edit', compact('group'));
    }

    /**
     * Update information of a group.
     *
     * @param UserGroupRequest $request
     * @param                  $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserGroupRequest $request, $slug)
    {
        $this->groupRepo->update($slug, $request->all());
        flash()->info('The information of this group was updated.');

        return redirect()->route('admin::groups.active');
    }

    /**
     * Soft delete a group.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $this->groupRepo->softDelete($slug);
        flash()->info('This group was successfully sent to trash');

        return redirect()->back();
    }

    /**
     * Restore a soft deleted group.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($slug)
    {
        $this->groupRepo->restore($slug);
        flash()->success('This group was successfully restored');

        return redirect()->back();
    }

    /**
     * Get trashed groups.
     *
     * @return \Illuminate\View\View
     */
    public function trashedGroups()
    {
        $trashedGroups = $this->groupRepo->getTrashedGroups(10);

        return view('admin.groups.trashed_groups', compact('trashedGroups'));
    }

    /**
     * Permanently delete a group.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDeleteGroup($slug)
    {
        $this->groupRepo->forceDelete($slug);
        flash()->info('This group was permanently deleted.');

        return redirect()->back();
    }

    /**
     * Remove a user from a specific group.
     *
     * @param $groupSlug
     * @param $userId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeUser($groupSlug, $userId)
    {
        $this->groupRepo->findBySlug($groupSlug)->users()->detach($userId);
        flash()->info('This user was removed form the current group');

        return redirect()->back();
    }

    /**
     * Remove all users from a specific group.
     *
     * @param $groupSlug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function flush($groupSlug)
    {
        $this->groupRepo->findBySlug($groupSlug)->users()->detach();
        flash()->info('All members were removed from this group');

        return redirect()->route('admin::groups.active.show', $groupSlug);
    }

    /**
     * Get view to add new users to a group.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function addUsers($slug)
    {
        $group = $this->groupRepo->findBySlug($slug);
        $users = $this->groupRepo->getPaginatedAssociatedUsers($group, 30);
        $outsiders = $this->groupRepo->getUsersOutsideGroup($slug)->lists('name', 'id');

        return view('admin.groups.add_users', compact('group', 'users', 'outsiders'));
    }

    /**
     * Add new users to a group.
     *
     * @param                        $slug
     * @param AddUsersToGroupRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNewUsers($slug, AddUsersToGroupRequest $request)
    {
        $ids = $request->input('group_new_users');
        $this->groupRepo->attachUsers($this->groupRepo->findBySlug($slug), $ids);
        flash()->success($this->getUpdateMembersMessage($ids));

        return redirect()->back();
    }

    /**
     * Get the flash message after adding users.
     *
     * @param array $ids
     *
     * @return string
     */
    private function getUpdateMembersMessage(array $ids)
    {
        return count($ids) . ' new ' . str_plural('member', count($ids)) . ' added to this group';
    }
}

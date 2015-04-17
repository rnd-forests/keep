<?php namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\UserGroupRequest;
use Keep\Http\Requests\AddUsersToGroupRequest;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;

class UserGroupsController extends Controller {

    protected $groupRepository;

    /**
     * Constructor.
     *
     * @param UserGroupRepositoryInterface $groupRepository
     */
    public function __construct(UserGroupRepositoryInterface $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * Get all current groups.
     *
     * @return \Illuminate\View\View
     */
    public function activeGroups()
    {
        $groups = $this->groupRepository->getPaginatedGroups(15);

        return view('admin.groups.active_groups', compact('groups'));
    }

    /**
     * Get the form to create a new group.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.groups.create');
    }

    /**
     * Persist a new group.
     *
     * @param UserGroupRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserGroupRequest $request)
    {
        $this->groupRepository->create($request->all());

        flash()->success('The new group was successfully created.');

        return redirect()->route('admin.active.groups');
    }

    /**
     * Show a specific group.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $group = $this->groupRepository->findBySlug($slug);

        $users = $this->groupRepository->getPaginatedAssociatedUsers($group, 16);

        return view('admin.groups.show', compact('group', 'users'));
    }

    /**
     * Get the form to update a group.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $group = $this->groupRepository->findBySlug($slug);

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
        $this->groupRepository->update($slug, $request->all());

        flash()->info('The information of this group was updated.');

        return redirect()->route('admin.active.groups');
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
        $this->groupRepository->delete($slug);

        flash()->info('This group was successfully sent to trash');

        return redirect()->back();
    }

    /**
     * Restore a trashed group.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($slug)
    {
        $this->groupRepository->restore($slug);

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
        $trashedGroups = $this->groupRepository->getTrashedGroups(10);

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
        $this->groupRepository->forceDelete($slug);

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
        $this->groupRepository->findBySlug($groupSlug)->users()->detach($userId);

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
        $this->groupRepository->findBySlug($groupSlug)->users()->detach();

        flash()->info('All members were removed from this group');

        return redirect()->route('admin.groups.show', $groupSlug);
    }

    /**
     * Load view to add new users to a group.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function addUsers($slug)
    {
        $group = $this->groupRepository->findBySlug($slug);

        $users = $this->groupRepository->getPaginatedAssociatedUsers($group, 30);

        $outsiders = $this->groupRepository->getUsersOutsideGroup($slug)->lists('name', 'id');

        return view('admin.groups.add_users', compact('group', 'users', 'outsiders'));
    }

    /**
     * Add new users to current group.
     *
     * @param                        $slug
     * @param AddUsersToGroupRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNewUsers($slug, AddUsersToGroupRequest $request)
    {
        $ids = $request->input('group_new_users');

        $this->groupRepository->attachUsers($this->groupRepository->findBySlug($slug), $ids);

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

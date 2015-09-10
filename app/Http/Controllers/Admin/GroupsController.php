<?php

namespace Keep\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\UserGroupRequest;
use Keep\Repositories\Group\GroupRepositoryInterface as GroupRepository;

class GroupsController extends Controller
{
    protected $groups;

    public function __construct(GroupRepository $groups)
    {
        $this->groups = $groups;
    }

    /**
     * Get all current groups.
     *
     * @return \Illuminate\View\View
     */
    public function activeGroups()
    {
        $groups = $this->groups->fetchPaginatedGroups(15);

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserGroupRequest $request)
    {
        $this->groups->create($request->all());
        flash()->success(trans('administrator.group_created'));

        return redirect()->route('admin::groups.active');
    }

    /**
     * Display a group.
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $group = $this->groups->findBySlug($slug);
        $users = $this->groups->fetchPaginatedAssociatedUsers($group, 16);

        return view('admin.groups.show', compact('group', 'users'));
    }

    /**
     * Get form to update a group.
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $group = $this->groups->findBySlug($slug);

        return view('admin.groups.edit', compact('group'));
    }

    /**
     * Update information of a group.
     *
     * @param UserGroupRequest $request
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserGroupRequest $request, $slug)
    {
        $this->groups->update($slug, $request->all());
        flash()->info(trans('administrator.group_updated'));

        return redirect()->route('admin::groups.active');
    }

    /**
     * Soft delete a group.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $this->groups->softDelete($slug);
        flash()->info(trans('administrator.group_trashed'));

        return back();
    }

    /**
     * Restore a soft deleted group.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($slug)
    {
        $this->groups->restore($slug);
        flash()->success(trans('administrator.group_restored'));

        return back();
    }

    /**
     * Get trashed groups.
     *
     * @return \Illuminate\View\View
     */
    public function trashedGroups()
    {
        $trashedGroups = $this->groups->fetchTrashedGroups(10);

        return view('admin.groups.trashed_groups', compact('trashedGroups'));
    }

    /**
     * Permanently delete a group.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDeleteGroup($slug)
    {
        $this->groups->forceDelete($slug);
        flash()->info(trans('administrator.group_destroyed'));

        return back();
    }

    /**
     * Remove a user from a specific group.
     *
     * @param $groupSlug
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeUser($groupSlug, $userId)
    {
        $this->groups->findBySlug($groupSlug)->users()->detach($userId);
        flash()->info(trans('administrator.group_remove_user'));

        return back();
    }

    /**
     * Remove all users from a specific group.
     *
     * @param $groupSlug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function flush($groupSlug)
    {
        $this->groups->findBySlug($groupSlug)->users()->detach();
        flash()->info(trans('administrator.group_flush_users'));

        return redirect()->route('admin::groups.active.show', $groupSlug);
    }

    /**
     * Get view to add new users to a group.
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function addUsers($slug)
    {
        $group = $this->groups->findBySlug($slug);
        $users = $this->groups->fetchPaginatedAssociatedUsers($group, 30);
        $outsiders = $this->groups->fetchOutsiders($slug)->lists('name', 'id');

        return view('admin.groups.add_users', compact('group', 'users', 'outsiders'));
    }

    /**
     * Add new users to a group.
     *
     * @param $slug
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNewUsers($slug, Request $request)
    {
        $this->validate($request, ['group_new_users' => 'required']);
        $ids = $request->input('group_new_users');
        $this->groups->attachUsers($this->groups->findBySlug($slug), $ids);
        flash()->success($this->getUpdateMembersMessage($ids));

        return back();
    }

    /**
     * Get the flash message after adding users.
     *
     * @param array $ids
     * @return string
     */
    private function getUpdateMembersMessage(array $ids)
    {
        return plural2('member', 'new', count($ids)) . ' added to this group.';
    }
}

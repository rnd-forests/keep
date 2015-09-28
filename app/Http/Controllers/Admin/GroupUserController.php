<?php

namespace Keep\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Keep\Http\Controllers\Controller;
use Keep\Core\Repository\Contracts\GroupRepository;

class GroupUserController extends Controller
{
    protected $groups;

    public function __construct(GroupRepository $groups)
    {
        $this->groups = $groups;
    }

    /**
     * Get view to add new users to a group.
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function create($slug)
    {
        $group = $this->groups->findBySlug($slug);
        $users = $this->groups->associatedUsers($group, 30);
        $outsiders = $this->groups->outsiders($slug)->lists('name', 'id');

        return view('admin.groups.add_users', compact('group', 'users', 'outsiders'));
    }

    /**
     * Add new users to a group.
     *
     * @param $slug
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $slug)
    {
        $this->validate($request, ['group_new_users' => 'required']);
        $ids = $request->input('group_new_users');
        $this->groups->attachUsers($this->groups->findBySlug($slug), $ids);
        flash()->success($this->getUpdateMembersMessage($ids));

        return back();
    }

    /**
     * Remove a user from a specific group.
     *
     * @param $groupSlug
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($groupSlug, $userId)
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

        return redirect()->route('admin::groups.show', $groupSlug);
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
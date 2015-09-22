<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\GroupRepository;

class GroupsTrashedController extends Controller
{
    protected $groups;

    public function __construct(GroupRepository $groups)
    {
        $this->groups = $groups;
    }

    /**
     * Get trashed groups.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $trashedGroups = $this->groups->trashed(10);

        return view('admin.groups.trashed_groups', compact('trashedGroups'));
    }

    /**
     * Permanently delete a group.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $this->groups->forceDelete($slug);
        flash()->info(trans('administrator.group_destroyed'));

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
}
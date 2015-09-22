<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Requests\GroupRequest;
use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\GroupRepository;

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
    public function index()
    {
        $groups = $this->groups->paginate(15);

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
     * @param GroupRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(GroupRequest $request)
    {
        $this->groups->create($request->all());
        flash()->success(trans('administrator.group_created'));

        return redirect()->route('admin::groups');
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
        $users = $this->groups->associatedUsers($group, 16);

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
     * @param GroupRequest $request
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(GroupRequest $request, $slug)
    {
        $this->groups->update($request->all(), $slug);
        flash()->info(trans('administrator.group_updated'));

        return redirect()->route('admin::groups');
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
}

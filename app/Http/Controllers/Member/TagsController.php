<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\TagRepositoryInterface as TagRepository;

class TagsController extends Controller
{
    protected $tags;

    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
        $this->middleware('auth');
        $this->middleware('valid.user');
    }

    /**
     * Get all tags associated with a user's tasks.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
    public function index($userSlug)
    {
        $tags = $this->tags->fetchAttachedTags($userSlug);

        return view('users.tags.index', compact('tags'));
    }

    /**
     * Get all tasks of a user that is associated with a given tag.
     *
     * @param $userSlug
     * @param $tagName
     *
     * @return \Illuminate\View\View
     */
    public function show($userSlug, $tagName)
    {
        $tag = $this->tags->findBySlug($tagName);
        $tasks = $this->tags->associatedTasks($userSlug, $tagName, 10);

        return view('users.tags.show', compact('tag', 'tasks'));
    }
}

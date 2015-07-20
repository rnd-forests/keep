<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Tag\TagRepositoryInterface;

class TagsController extends Controller
{
    protected $tagRepo;

    /**
     * Create new tags controller instance.
     *
     * @param TagRepositoryInterface $tagRepo
     */
    public function __construct(TagRepositoryInterface $tagRepo)
    {
        $this->tagRepo = $tagRepo;
        $this->middleware('auth');
        $this->middleware('auth.correct');
    }

    /**
     * Get all tags associated with a user's tasks.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function index($userSlug)
    {
        $tags = $this->tagRepo->fetchAttachedTags($userSlug);

        return view('users.tags.index', compact('tags'));
    }

    /**
     * Get all tasks of a user that is associated with a given tag.
     *
     * @param $userSlug
     * @param $tagName
     * @return \Illuminate\View\View
     */
    public function show($userSlug, $tagName)
    {
        $tag = $this->tagRepo->findBySlug($tagName);
        $tasks = $this->tagRepo->fetchTasksAssociatedWithTag($userSlug, $tagName, 10);

        return view('users.tags.show', compact('tag', 'tasks'));
    }
}

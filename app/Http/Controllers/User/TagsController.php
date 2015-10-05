<?php

namespace Keep\Http\Controllers\User;

use Keep\Http\Controllers\Controller;
use Keep\Core\Repository\Contracts\TagRepository;

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
     * Get all tasks of a user that is associated with a given tag.
     *
     * @param $userSlug
     * @param $tagName
     * @return \Illuminate\View\View
     */
    public function show($userSlug, $tagName)
    {
        $tag = $this->tags->findBySlug($tagName);
        $tasks = $this->tags->associatedTasks($userSlug, $tagName, 10);

        return view('users.tags.show', compact('tag', 'tasks'));
    }
}

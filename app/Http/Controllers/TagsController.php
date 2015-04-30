<?php namespace Keep\Http\Controllers;

use Keep\Repositories\Tag\TagRepositoryInterface;

class TagsController extends Controller {

    protected $tagRepo;

    /**
     * Create new tags controller instance.
     *
     * @param TagRepositoryInterface $tagRepo
     */
    public function __construct(TagRepositoryInterface $tagRepo)
    {
        $this->tagRepo = $tagRepo;
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
        $tags = $this->tagRepo->getAssociatedTags($userSlug);

        return view('tags.index', compact('tags'));
    }

}

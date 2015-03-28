<?php  namespace Keep\Http\Composers; 

use Illuminate\Contracts\View\View;
use Keep\Repositories\Tag\TagRepositoryInterface;

class TaskFormComposer {

    protected $tags;

    public function __construct(TagRepositoryInterface $tags)
    {
        $this->tags = $tags;
    }

    /**
     * Composer task form view partial.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with('tags', $this->tags->lists());
    }

}
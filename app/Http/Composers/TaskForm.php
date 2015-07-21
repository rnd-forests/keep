<?php

namespace Keep\Http\Composers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\Tag\TagRepositoryInterface as TagRepo;
use Keep\Repositories\Priority\PriorityRepositoryInterface as PriorityRepo;

class TaskForm
{
    protected $tags;
    protected $priorities;

    public function __construct(TagRepo $tags, PriorityRepo $priorities)
    {
        $this->tags = $tags;
        $this->priorities = $priorities;
    }
    
    public function compose(View $view)
    {
        $view->with('tags', $this->tags->lists());
        $view->with('priorities', $this->priorities->lists());
    }
}

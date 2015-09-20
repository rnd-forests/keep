<?php

namespace Keep\Core\Composers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\Contracts\TagRepository;
use Keep\Repositories\Contracts\PriorityRepository;

class TaskForm
{
    protected $tags;
    protected $priorities;

    public function __construct(TagRepository $tags, PriorityRepository $priorities)
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

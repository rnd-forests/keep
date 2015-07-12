<?php

namespace Keep\Http\Composers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\Tag\TagRepositoryInterface;
use Keep\Repositories\Priority\PriorityRepositoryInterface;

class TaskForm
{
    public function compose(View $view)
    {
        $tags = app(TagRepositoryInterface::class);
        $view->with('tags', $tags->lists());

        $priorities = app(PriorityRepositoryInterface::class);
        $view->with('priorities', $priorities->lists());
    }
}

<?php

namespace Keep\Http\Composers;

use Illuminate\Contracts\View\View;

class TaskForm
{
    public function compose(View $view)
    {
        $tags = app(\Keep\Repositories\Tag\TagRepositoryInterface::class);
        $view->with('tags', $tags->lists());

        $priorities = app(\Keep\Repositories\Priority\PriorityRepositoryInterface::class);
        $view->with('priorities', $priorities->lists());
    }
}

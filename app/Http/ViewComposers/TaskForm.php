<?php
namespace Keep\Http\ViewComposers;

use App;
use Illuminate\Contracts\View\View;
use Keep\Repositories\Tag\TagRepositoryInterface;
use Keep\Repositories\Priority\PriorityRepositoryInterface;

class TaskForm
{
    public function compose(View $view)
    {
        $tags = App::make(TagRepositoryInterface::class);
        $view->with('tags', $tags->lists());

        $priorities = App::make(PriorityRepositoryInterface::class);
        $view->with('priorities', $priorities->lists());
    }
}
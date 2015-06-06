<?php
namespace Keep\Http\Composers;

use App;
use Illuminate\Contracts\View\View;
use Keep\Repositories\Tag\TagRepositoryInterface;
use Keep\Repositories\Priority\PriorityRepositoryInterface;

class TaskFormComposer
{
    public function compose(View $view)
    {
        $tags = App::make(TagRepositoryInterface::class);
        $view->with('tags', $tags->lists());

        $priorities = App::make(PriorityRepositoryInterface::class);
        $view->with('priorities', $priorities->lists());
    }
}
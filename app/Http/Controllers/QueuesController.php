<?php

namespace Keep\Http\Controllers;

class QueuesController extends Controller
{
    /**
     * Subscribe for all queued jobs.
     *
     * @return mixed
     */
    public function subscribe()
    {
        return app('queue')->marshal();
    }
}

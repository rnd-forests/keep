<?php

namespace Keep\Http\Controllers;

class QueuesController extends Controller
{
    public function subscribe()
    {
        return app('queue')->marshal();
    }
}

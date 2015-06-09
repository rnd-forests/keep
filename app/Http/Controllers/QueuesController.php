<?php
namespace Keep\Http\Controllers;

use Queue;

class QueuesController extends Controller
{
    public function subscribe()
    {
        return Queue::marshal();
    }
}

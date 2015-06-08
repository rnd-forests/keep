<?php
namespace Keep\Http\Controllers;

use Queue;

class QueuesController extends Controller
{
    public function receive()
    {
        return Queue::marshal();
    }
}

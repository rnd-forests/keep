<?php

namespace Keep\Http\Controllers\Pages;

use Keep\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * The homepage.
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return view('pages.home');
    }
}

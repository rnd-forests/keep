<?php namespace Keep\Http\Controllers;

use Keep\Http\Requests;

class HomeController extends Controller {

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

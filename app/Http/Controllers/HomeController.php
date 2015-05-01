<?php namespace Keep\Http\Controllers;

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

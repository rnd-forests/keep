<?php namespace Keep\Http\Composers;

use Illuminate\Contracts\View\View;

class NotificationFormComposer {

    /**
     * Composer notification form view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $types = [
            'default' => 'General notification',
            'info' => 'Informative notification',
            'success' => 'Successful notification',
            'warning' => 'Warning notification',
            'danger' => 'Danger notification'
        ];

        $view->with('types', $types);
    }

}
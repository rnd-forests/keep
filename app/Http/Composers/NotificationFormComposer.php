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
            'default' => 'General',
            'info' => 'Informative',
            'success' => 'Successful',
            'warning' => 'Warning',
            'danger' => 'Danger'
        ];

        $view->with('types', $types);
    }

}
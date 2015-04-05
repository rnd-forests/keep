<?php  namespace Keep\Presenters; 

use Carbon\Carbon;
use Laracasts\Presenter\Presenter;

/**
 * @property mixed email
 */
class UserPresenter extends Presenter {

    /**
     * Get user gravatar picture.
     *
     * @param int $size
     *
     * @return string
     */
    public function gravatar($size = 35)
    {
        $email = md5($this->email);

        return "//www.gravatar.com/avatar/$email?s=$size";
    }

    /**
     * Format user timestamp.
     *
     * @param $timestamp
     *
     * @return string
     */
    public function formatUserTime($timestamp)
    {
        return Carbon::parse($timestamp)->format('Y-m-d');
    }

    /**
     * Format user full timestamp.
     *
     * @param $timestamp
     *
     * @return string
     */
    public function formatUserTimeFull($timestamp)
    {
        return Carbon::parse($timestamp)->format('Y-m-d, H:i:s');
    }

    /**
     * Print user model attributes.
     *
     * @param $attribute
     *
     * @return string
     */
    public function printAttribute($attribute)
    {
        if (empty($attribute))
        {
            return '-';
        }

        return $attribute;
    }
    
}
<?php

namespace Keep\Entities\Presenters\Traits;

use Keep\Exceptions\PresenterException;

trait PresentableTrait
{
    protected $presenterInstance;

    /**
     * Prepare a new or retrieve old presenter instance.
     *
     * @return mixed
     * @throws PresenterException
     */
    public function present()
    {
        if (!$this->presenter || !class_exists($this->presenter)) {
            throw new PresenterException('Please set the $presenter property to your presenter path.');
        }
        if (!$this->presenterInstance) {
            $this->presenterInstance = new $this->presenter($this);
        }

        return $this->presenterInstance;
    }
}
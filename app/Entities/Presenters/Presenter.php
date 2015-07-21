<?php

namespace Keep\Entities\Presenters;

class Presenter
{
    protected $entity;

    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    public function __get($prop)
    {
        if (method_exists($this, $prop)) {
            return $this->{$prop}();
        }

        return $this->entity->{$prop};
    }
}
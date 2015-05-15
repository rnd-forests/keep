<?php namespace Keep\Notifications;

interface NotifiableInterface {

    public function withSubject($subject);
    public function withBody($body);
    public function withType($type);
    public function regarding($object);
    public function from($sender);
    public function to($receiver);
    public function deliver();

}
<?php

trait AdditionalAssertionsTrait
{
    public function assertViewIs($name)
    {
        $this->assertEquals($name, $this->response->original->getName());
    }

    public function assertFlashedMessage($key)
    {
        $this->assertTrue(Lang::has($key), "Oops! The language key '$key' doesn't exist");
        $this->assertSessionHas('flash_notification.message', trans($key));
    }
}

<?php

trait AdditionalAssertionsTrait
{
    /**
     * Assert the view name.
     *
     * @param $name
     */
    public function assertViewIs($name)
    {
        $this->assertEquals($name, $this->response->original->getName());
    }

    /**
     * Assert the session flashed message.
     *
     * @param $key
     */
    public function assertFlashedMessage($key)
    {
        $this->assertTrue(Lang::has($key), "Oops! The language key '$key' doesn't exist");
        $this->assertSessionHas('flash_notification.message', trans($key));
    }
}

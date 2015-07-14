<?php

trait AdditionalAssertionsTrait
{
    public function assertViewIs($name)
    {
        $this->assertEquals($name, $this->response->original->getName());
    }

    public function assertKeyTranslated($key)
    {
        $this->assertSessionHas('flash_notification.message', trans($key));
    }

    public function assertFlashedMessage()
    {
        $this->assertSessionHas('flash_notification.message');
    }
}
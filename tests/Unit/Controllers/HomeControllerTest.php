<?php

class HomeControllerTest extends TestCase
{
    public function testHome()
    {
        $this->route('GET', 'home');
        $this->assertResponseOk();
        $this->assertViewIs('pages.home');
    }
}

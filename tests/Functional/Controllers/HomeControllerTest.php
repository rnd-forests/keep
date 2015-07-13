<?php

class HomeControllerTest extends TestCase
{
    /** @test */
    public function it_shows_the_homepage()
    {
        $this->route('GET', 'home');
        $this->assertResponseOk();
        $this->assertViewIs('pages.home');
    }
}

<?php

class ProfileTest extends TestCase
{
    /** @test */
    public function it_belongs_to_only_one_user()
    {
        $this->assertBelongsTo('user', 'Keep\Entities\Profile');
    }
}

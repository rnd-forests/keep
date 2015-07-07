<?php

class ProfileTest extends EntityTestCase
{
    /** @test */
    public function it_belongs_to_only_one_user()
    {
        $this->assertBelongsTo('user', 'Keep\Entities\Profile');
    }
}

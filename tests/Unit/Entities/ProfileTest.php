<?php

class ProfileTest extends EntityTestCase
{
    public function testBelongsToUser()
    {
        $this->assertBelongsTo('user', 'Keep\Entities\Profile');
    }
}

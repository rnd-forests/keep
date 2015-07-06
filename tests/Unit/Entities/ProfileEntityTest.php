<?php

use Keep\Entities\Profile;

class ProfileEntityTest extends EntityTestCase
{
    public function testBelongsToUser()
    {
        $this->assertBelongsTo('user', Profile::class);
    }
}

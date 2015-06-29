<?php

use Keep\Entities\Profile;

class ProfileEntityTest extends ModelTestCase
{
    public function testBelongsToUser()
    {
        $this->assertBelongsTo('user', Profile::class);
    }
}
